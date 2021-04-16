<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ActasSo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actas_so', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable(false);//primary key
            $table->string('nombre', 100)->nullable(false);
            $table->timestamp('fechaReunion')->nullable(false);
            $table->string('lugarReunion', 100)->nullable(false);
            $table->time('horaInicio')->nullable(false);
            $table->time('horaFinalizacion')->nullable(false);
            $table->string('convocadoPor', 100)->nullable(false);
            $table->string('departamento', 100)->nullable(false);
            $table->string('objetivo', 200)->nullable(false);
            $table->string('agenda', 10000)->nullable(false);
            $table->string('acciones', 10000)->nullable(false);
            $table->timestamp('fechaProxReunion')->nullable(true);
            $table->string('lugarProxReunion', 100)->nullable(true);
            $table->time('horaProxReunion')->nullable(true);
            $table->unsignedBigInteger('carpeta')->nullable(false);
            
            $table->timestamps();

            //foreign keys
            $table  ->foreign('carpeta')
                    ->references('id')
                    ->on('carpeta_so')
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
        Schema::dropIfExists('actas_so');
    }
}
