<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ActividadServicio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividad_servicio', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable(false);//primary key
            $table->timestamp('fechaFinalizacion')->nullable(false);
            $table->timestamp('fechaInicio')->nullable(false);
            $table->string('nombre', 200)->nullable(false);
            $table->string('entidad', 200)->nullable(false);
            $table->unsignedBigInteger('hoja_vida')->nullable(false);

            $table->timestamps();

            //foreign key
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
        Schema::dropIfExists('actividad_servicio');
    }
}
