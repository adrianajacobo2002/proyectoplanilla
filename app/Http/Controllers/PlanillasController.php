<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planilla;
use App\Models\Empleado;
use Illuminate\Support\Facades\DB; 

class PlanillasController extends Controller
{
    public function showPlanillas(Request $request, $id)
    {

        // Obtener el empleado con sus planillas
        $empleado = Empleado::with('planillas')->findOrFail($id);
        $planillas = $empleado->planillas;
        
        $query = $empleado->planillas();
        
        if ($request->filled('mes')) {
            $query->where('mes', $request->input('mes'));
        }
    
        if ($request->filled('anio')) {  // Cambia 'año' por 'anio'
            $query->where('anio', $request->input('anio'));
        }

        $planillas = $query->get();

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

        // Paso 1: Calcular el salario proporcional
        $sueldoBase = $empleado->salario; 
        $diasLaborados = $request->input('dias_laborados', 30); // Días trabajados en el mes
        $salarioProporcional = ($sueldoBase / 30) * $diasLaborados;

        // Ingresos adicionales que no son parte del salario proporcional
        $bono = $request->input('bono', 0); 
        $bonificacionesCargos = $empleado->cargos->sum('bonificacion');

        // Paso 2: Calcular las horas extras
        $ingresosExtraPorHorasExtras = $this->calcularHorasExtras(
            $request->input('horas_extras_am', 0),
            $request->input('horas_extras_pm', 0),
            $sueldoBase
        );

        // Sumar todos los ingresos
        $totalIngresos = $salarioProporcional + $bono + $bonificacionesCargos + $ingresosExtraPorHorasExtras;

        // Aplicar cualquier descuento extra proporcionado
        $descuentosExtra = $request->input('descuentos_extra', 0);
        $totalConDescuentos = $totalIngresos - $descuentosExtra;

        // Paso 3: Calcular ISSS, AFP e ISR
        $isss = min(30, $totalConDescuentos * 0.03); // 3% del total, con un máximo de $30
        $afp = $totalConDescuentos * 0.0725; // 7.25% del total
        $isrBase = $totalConDescuentos - $isss - $afp;
        $isr = $this->calcularISR($isrBase);

        // Calcular el salario líquido
        $salarioLiquido = $totalConDescuentos - ($isss + $afp + $isr);

        // Devolver los valores calculados como respuesta JSON
        return response()->json([
            'isss' => number_format($isss, 2),
            'afp' => number_format($afp, 2),
            'isr' => number_format($isr, 2),
            'salario_liquido' => number_format($salarioLiquido, 2),
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

        // Obtener la información del empleado
        $empleado = Empleado::findOrFail($request->empleado_id);

        // Paso 1: Calcular el salario proporcional
        $sueldoBase = $empleado->salario; 
        $diasLaborados = $request->input('dias_laborados', 30); // Días trabajados en el mes
        $salarioProporcional = ($sueldoBase / 30) * $diasLaborados;

        // Ingresos adicionales que no son parte del salario proporcional
        $bono = $request->input('bono', 0); 
        $bonificacionesCargos = $empleado->cargos->sum('bonificacion');

        // Paso 2: Calcular las horas extras AM y PM
        $ingresosExtraPorHorasExtras = $this->calcularHorasExtras(
            $request->input('horas_extras_am', 0),
            $request->input('horas_extras_pm', 0),
            $sueldoBase
        );

        // Sumar todos los ingresos
        $totalIngresos = $salarioProporcional + $bono + $bonificacionesCargos + $ingresosExtraPorHorasExtras;

        // Aplicar cualquier descuento extra proporcionado
        $descuentosExtra = $request->input('descuentos_extra', 0);
        $totalConDescuentos = $totalIngresos - $descuentosExtra;

        // Paso 3: Calcular ISSS, AFP e ISR
        $isss = min(30, $totalConDescuentos * 0.03); // 3% del total, con un máximo de $30
        $afp = $totalConDescuentos * 0.0725; // 7.25% del total
        $isrBase = $totalConDescuentos - $isss - $afp;
        $isr = $this->calcularISR($isrBase);

        // Calcular el salario líquido
        $salarioLiquido = $totalConDescuentos - ($isss + $afp + $isr);

        // Crear la nueva planilla en la base de datos
        Planilla::create([
            'empleado_id' => $request->empleado_id,
            'anio' => $request->anio,
            'mes' => $request->mes,
            'isss' => number_format($isss, 2),
            'afp' => number_format($afp, 2),
            'isr' => number_format($isr, 2),
            'bono' => $request->input('bono', 0),
            'dias_laborados' => $request->dias_laborados,
            'horas_extras' => ($request->input('horas_extras_am', 0) + $request->input('horas_extras_pm', 0)),
            'descuentos_extra' => number_format($descuentosExtra, 2),
            'salario_proporcional' => number_format($salarioProporcional, 2),
            'salario_liquido' => number_format($salarioLiquido, 2),
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
        return $pagoHorasExtrasAM + $pagoHorasExtrasPM;
    }

    public function show($empleado_id, $planilla_id)
    {
        // Obtener al empleado y la planilla específica
        $empleado = Empleado::with('usuario', 'cargos')->findOrFail($empleado_id);
        $planilla = Planilla::findOrFail($planilla_id);

        // Retornar la vista con los datos del empleado y la planilla
        return view('contador.empleados.show_planilla', compact('empleado', 'planilla'));
    }
}
