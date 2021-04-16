<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExperienciaNoAcademica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiencia_no_academica', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable(false);//primary key
            $table->timestamp('fechaFinalizacion')->nullable(false);
            $table->timestamp('fechaInicio')->nullable(false);
            $table->string('compania', 100)->nullable(false);
            $table->string('descripcion', 100)->nullable(false);
            $table->unsignedBigInteger('tiempo')->nullable(false);
            $table->string('titulo', 100)->nullable(false);
            $table->unsignedBigInteger('hoja_vida')->nullable(false);

            $table->timestamps();

            //foreign key
            $table  ->foreign('tiempo')
                    ->references('id')
                    ->on('detalles_referencia')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');

            $table  ->foreign('hoja_vida')
                    ->references('id')
                    ->on('hojas_vida')
                    ->onDelete('cascade')
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
        Schema::dropIfExists('experiencia_no_academica');
    }
}
