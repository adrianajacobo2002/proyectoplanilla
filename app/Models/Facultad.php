<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    use HasFactory;

    protected $table = 'facultades';

    protected $primaryKey = 'facultad_id';

    protected $fillable = [
        'nombre', 
        'descripcion'
    ];
}
