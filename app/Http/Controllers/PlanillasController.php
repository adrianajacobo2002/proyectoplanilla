<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planilla;
use App\Models\Empleado;
use Illuminate\Support\Facades\DB; 

class PlanillasController extends Controller
{
    public function showPlanillas($id)
    {
        // Obtener el empleado con sus planillas
        $empleado = Empleado::with('planillas')->findOrFail($id);
        $planillas = $empleado->planillas;

        
        $currentYear = date('Y');
        $years = range($currentYear, 2000);

        // Obtener los valores del enum 'mes' desde la base de datos
        $type = DB::select("SHOW COLUMNS FROM planillas WHERE Field = 'mes'")[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $meses = array_map(function($value) {
            return trim($value, "'");
        }, explode(',', $matches[1]));


        return view('contador.empleados.planillas', compact('empleado', 'planillas', 'years', 'meses'));
    }

    public function create($id)
    {
        $empleado = Empleado::findOrFail($id);
        $mesActual = date('F'); // Nombre del mes actual
        $anioActual = date('Y');

        return view('contador.empleados.create_planilla', compact('empleado', 'mesActual', 'anioActual'));
    }

    public function calculate(Request $request)
    {
        // Obtener la información del empleado
        $empleado = Empleado::findOrFail($request->empleado_id);

        // Validar que no exista otra planilla para el mismo mes y año
        $existingPlanilla = Planilla::where('empleado_id', $request->empleado_id)
            ->where('mes', $request->mes)
            ->where('anio', $request->anio)
            ->first();

        if ($existingPlanilla) {
            return response()->json(['error' => 'Ya existe una planilla para este mes y año.'], 422);
        }

        // Cálculo de horas extras y otros ingresos
        $ingresosExtraPorHorasExtras = $this->calcularHorasExtras(
            $request->input('horas_extras_am'),
            $request->input('horas_extras_pm'),
            $sueldoBase
        );

        $descuentosExtra = $request->descuentos_extra ?? 0;

        // Calcular los ingresos extras
        $sueldoBase = $empleado->salario;
        $salarioProporcional = ($sueldoBase / 30) * $request->dias_laborados;
        $ingresosExtras = ($request->bono ?? 0) + $empleado->cargos->sum('bonificacion') + $ingresosExtraPorHorasExtras;
        $sueldoPor = ($ingresosExtras + $salarioProporcional) - $descuentosExtra;
        
        // Calcular ISSS, AFP, ISR con las tasas de El Salvador
        $isss = min(30, $sueldoPor * 0.03); // Máximo $30
        $afp = $sueldoPor * 0.0725; // 7.25% de AFP
        $isr = $this->calcularISR($sueldoPor - $isss - $afp);

        $salarioLiquido = $salarioProporcional + $ingresosExtras - ($request->descuentos_extra + $isss + $afp + $isr);

        return response()->json([
            'isss' => $isss,
            'afp' => $afp,
            'isr' => $isr,
            'salario_liquido' => $salarioLiquido,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required|exists:empleados,empleado_id',
            'mes' => 'required|string',
            'anio' => 'required|integer',
            'bono' => 'nullable|numeric|min:0',
            'dias_laborados' => 'required|integer|min:0|max:30',
            'horas_extras_am' => 'nullable|numeric|min:0',
            'horas_extras_pm' => 'nullable|numeric|min:0',
            'descuentos_extra' => 'nullable|numeric|min:0',
        ]);

        // Evitar duplicados por mes y año
        $existingPlanilla = Planilla::where('empleado_id', $request->empleado_id)
            ->where('mes', $request->mes)
            ->where('anio', $request->anio)
            ->first();

        if ($existingPlanilla) {
            return redirect()->back()->withErrors(['error' => 'Ya existe una planilla para este mes y año.']);
        }

        // Cálculos de horas extras y descuentos
        $sueldoBase = $empleado->salario;
        $ingresosExtras = ($request->bono ?? 0) + $empleado->cargos->sum('bonificacion');
        $descuentosExtra = $request->descuentos_extra ?? 0;

        $isss = min(30, $sueldoBase * 0.03); 
        $afp = $sueldoBase * 0.0725; 
        $isr = $this->calcularISR($sueldoBase - $isss - $afp);

        $salarioProporcional = ($sueldoBase / 30) * $request->dias_laborados;
        $salarioLiquido = $salarioProporcional + $ingresosExtras - ($descuentosExtra + $isss + $afp + $isr);

        Planilla::create([
            'empleado_id' => $request->empleado_id,
            'anio' => $request->anio,
            'mes' => $request->mes,
            'isss' => $isss,
            'afp' => $afp,
            'isr' => $isr,
            'bono' => $request->bono ?? 0,
            'dias_laborados' => $request->dias_laborados,
            'horas_extras' => ($request->horas_extras_am + $request->horas_extras_pm),
            'descuentos_extra' => $descuentosExtra,
            'salario_proporcional' => $salarioProporcional,
            'salario_liquido' => $salarioLiquido,
        ]);

        return redirect()->route('empleado.planillas', $request->empleado_id)->with('success', 'Planilla creada correctamente.');
    }

    public function calcularISR($salarioSujeto)
    {
        if ($salarioSujeto <= 472) {
            return 0;
        } elseif ($salarioSujeto <= 895.24) {
            return ($salarioSujeto - 472) * 0.10;
        } elseif ($salarioSujeto <= 2038.10) {
            return 42 + (($salarioSujeto - 895.24) * 0.20);
        } else {
            return 288.57 + (($salarioSujeto - 2038.10) * 0.30);
        }
    }

    public function calcularHorasExtras($horasExtrasAM, $horasExtrasPM, $sueldoBase)
    {
        // Calcular el salario por hora
        $salarioPorHora = $sueldoBase / 30 / 8; // Suponiendo 30 días y 8 horas por día

        // Calcular el pago por horas extras AM (1.5 veces el salario por hora)
        $pagoHorasExtrasAM = $horasExtrasAM * 1.5 * $salarioPorHora;

        // Calcular el pago por horas extras PM (2 veces el salario por hora)
        $pagoHorasExtrasPM = $horasExtrasPM * 2 * $salarioPorHora;

        // Calcular el total de ingresos extra por horas extras
        $ingresosExtraPorHorasExtras = $pagoHorasExtrasAM + $pagoHorasExtrasPM;

        return $ingresosExtraPorHorasExtras;
    }

}
