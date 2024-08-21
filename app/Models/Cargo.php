<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla
    protected $table = 'cargos';

    // Especifica la clave primaria
    protected $primaryKey = 'cargo_id';

    // Especifica los campos que se pueden asignar en masa
    protected $fillable = [
        'nombre',
        'descripcion',
        'bonificacion',
        'empleado_id',
    ];

    
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }
}

