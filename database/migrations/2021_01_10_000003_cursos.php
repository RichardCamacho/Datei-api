<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cursos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable(false);//primary key
            $table->string('codigo', 100)->nullable(false);
            $table->string('nombreEspaniol', 100)->nullable(false);
            $table->string('nombreIngles', 100)->nullable(false);
            $table->integer('numeroCreditos')->nullable(false);
            $table->integer('horasSemestre')->nullable(false);
            $table->unsignedBigInteger('tipoCurso')->nullable(false);
            $table->string('informacion', 200)->nullable(true);

            $table->timestamps();

            //foreigns keys
            $table  ->foreign('tipoCurso')
                    ->references('id')
                    ->on('detalles_referencia')
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
        Schema::dropIfExists('cursos');
    }
}
