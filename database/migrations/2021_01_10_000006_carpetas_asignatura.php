<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CarpetasAsignatura extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carpeta_asignatura', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable(false);//primary key
            $table->string('nombre', 100)->nullable(false);
            $table->string('codigo', 100)->nullable(false);
            $table->unsignedBigInteger('curriculum')->nullable(false);
            $table->unsignedBigInteger('curso')->nullable(false);
            $table->unsignedBigInteger('idUsuario')->nullable(false);
            
            $table->timestamps();

            //foreign keys
            $table  ->foreign('curriculum')
                    ->references('id')
                    ->on('hojas_vida')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');

            $table  ->foreign('curso')
                    ->references('id')
                    ->on('informacion_curso')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');

            $table  ->foreign('idUsuario')
                    ->references('id')
                    ->on('users')
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
        Schema::dropIfExists('carpeta_asignatura');
    }
}
