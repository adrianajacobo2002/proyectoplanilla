<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('rol', ['Contador', 'Empleado']);
            $table->unsignedBigInteger('empleado_id');
            $table->boolean('active')->default(1);
            $table->timestamps();

            // Clave foránea
            $table->foreign('empleado_id')->references('empleado_id')->on('empleados')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
