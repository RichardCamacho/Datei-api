<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Archivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable(false);//primary key
            $table->string('nombre', 100)->nullable(false);
            $table->string('path')->nullable(false);
            $table->string('tipo')->nullable(false);
            $table->unsignedBigInteger('seccion')->nullable(false);//a que curso pertenece el registro

            $table->timestamps();

            //foreign key
            $table  ->foreign('seccion')
                    ->references('id')
                    ->on('secciones')
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
        Schema::dropIfExists('archivos');
    }
}
