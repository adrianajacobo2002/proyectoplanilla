<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id('empleado_id');
            $table->unsignedBigInteger('facultad_id');
            $table->unsignedBigInteger('unidad_id');
            $table->string('contrato');
            $table->string('DUI')->unique();
            $table->string('titulo');
            $table->decimal('salario', 8, 2);
            $table->string('estado');
            $table->timestamps();

            // Claves foráneas
            $table->foreign('facultad_id')->references('facultad_id')->on('facultades')->onDelete('cascade');
            $table->foreign('unidad_id')->references('unidad_id')->on('unidades')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('empleados');
    }
};
