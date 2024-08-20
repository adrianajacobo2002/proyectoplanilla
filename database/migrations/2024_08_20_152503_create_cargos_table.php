<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargosTable extends Migration
{
    public function up()
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->id('cargo_id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->decimal('bonificacion', 8, 2);
            $table->unsignedBigInteger('empleado_id');
            $table->timestamps();

            // Clave foránea
            $table->foreign('empleado_id')->references('empleado_id')->on('empleados')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cargos');
    }
}
