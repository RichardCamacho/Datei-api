<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HojasVida extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hojas_vida', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable(false);//primary key
            $table->string('primerNombre', 200)->nullable(false);
            $table->string('segundoNombre', 200)->nullable(true);
            $table->string('primerApellido', 200)->nullable(false);
            $table->string('segundoApellido', 200)->nullable(false);
            $table->unsignedBigInteger('rango')->nullable(false);
            $table->unsignedBigInteger('rol')->nullable(false);
            $table->unsignedBigInteger('programa')->nullable(false);
            $table->unsignedBigInteger('idUsuario')->nullable(false);

            $table->timestamps();

            //foreigns keys
            $table  ->foreign('rango')
                    ->references('id')
                    ->on('detalles_referencia')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');

            $table  ->foreign('rol')
                    ->references('id')
                    ->on('detalles_referencia')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');

            $table  ->foreign('programa')
                    ->references('id')
                    ->on('detalles_referencia')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');
            
            $table  ->foreign('idUsuario')
                    ->references('id')
                    ->on('users')
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
        Schema::dropIfExists('hojas_vida');
    }
}
