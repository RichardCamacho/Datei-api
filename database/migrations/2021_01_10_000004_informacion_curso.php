<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InformacionCurso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informacion_curso', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable(false);//primary key
            $table->string('codigo', 100)->nullable(false);
            $table->string('nombreEspaniol', 100)->nullable(false);
            $table->string('nombreIngles', 100)->nullable(false);
            $table->integer('numeroCreditos')->nullable(false);
            $table->integer('horasSemestre')->nullable(false);
            $table->unsignedBigInteger('tipoCurso')->nullable(false);
            $table->string('informacion', 200)->nullable(true);
            $table->string('titulo', 200)->nullable(true);
            $table->string('autor', 200)->nullable(true);
            $table->string('editorial', 100)->nullable(true);
            $table->string('anio', 20)->nullable(true);
            $table->string('filename')->nullable(true);
            $table->unsignedBigInteger('idUsuario')->nullable(false);
            $table->integer('idCurso')->nullable(false);

            $table->timestamps();

            //foreigns keys
            $table  ->foreign('tipoCurso')
                    ->references('id')
                    ->on('detalles_referencia')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
            
            $table  ->foreign('idUsuario')
                    ->references('id')
                    ->on('users')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');

            $table  ->foreign('idCurso')
                    ->references('id')
                    ->on('cursos')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('informacion_curso');
    }
}
