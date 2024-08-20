<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanillasTable extends Migration
{
    public function up()
    {
        Schema::create('planillas', function (Blueprint $table) {
            $table->id('planilla_id');
            $table->unsignedBigInteger('empleado_id');
            $table->integer('anio');
            $table->enum('mes', [
                'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
            ]);
            $table->decimal('isss', 8, 2);
            $table->decimal('afp', 8, 2);
            $table->decimal('isr', 8, 2);
            $table->decimal('bono', 8, 2);
            $table->integer('dias_laborados');
            $table->integer('horas_extras');
            $table->decimal('descuentos_extra', 8, 2);
            $table->decimal('salario_proporcional', 8, 2);
            $table->decimal('salario_liquido', 8, 2);
            $table->timestamps();

            // Clave foránea
            $table->foreign('empleado_id')->references('empleado_id')->on('empleados')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('planillas');
    }
};

