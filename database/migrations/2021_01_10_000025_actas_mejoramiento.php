<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ActasMejoramiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actas_mejoramiento', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable(false);//primary key
            $table->string('accionesPropuestas', 10000)->nullable(false);//
            $table->string('accionesControl', 10000)->nullable(false);//
            $table->string('otrasAcciones', 10000)->nullable(false);//
            $table->string('accionId', 100)->nullable(false);//
            $table->string('motivacion', 10000)->nullable(false);//
            $table->string('objetivoEstr', 200)->nullable(false);//
            $table->string('responsable', 200)->nullable(false);//
            $table->string('resultadoEvaluacion', 10000)->nullable(false);//
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
        Schema::dropIfExists('actas_mejoramiento');
    }
}
