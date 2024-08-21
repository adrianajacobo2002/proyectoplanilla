<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';
    protected $primaryKey = 'empleado_id';

    // Los campos que se pueden asignar en masa
    protected $fillable = [
        'facultad_id',
        'unidad_id',
        'contrato',
        'DUI',
        'titulo',
        'salario',
        'estado',
    ];

    // Relación con la unidad
    public function unidad()
    {
        return $this->belongsTo(Unidad::class, 'unidad_id');
    }

    // Relación con la facultad
    public function facultad()
    {
        return $this->belongsTo(Facultad::class, 'facultad_id');
    }

    // Relación con Usuario
    public function usuario()
    {
        return $this->hasOne(User::class, 'empleado_id', 'empleado_id');
    }

    public function cargos()
    {
        return $this->hasMany(Cargo::class, 'empleado_id');
    }
}
