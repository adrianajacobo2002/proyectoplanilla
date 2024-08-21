<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planilla extends Model
{
    use HasFactory;

    protected $table = 'planillas';
    protected $primaryKey = 'planilla_id';

    protected $fillable = [
        'empleado_id',
        'anio',
        'mes',
        'isss',
        'afp',
        'isr',
        'bono',
        'dias_laborados',
        'horas_extras',
        'descuentos_extra',
        'salario_proporcional',
        'salario_liquido'
    ];

    // Relación con el modelo Empleado
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'empleado_id');
    }
}
