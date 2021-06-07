<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Secciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secciones', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable(false);//primary key
            $table->string('nombre', 100)->nullable(false);
            $table->unsignedBigInteger('idCarpeta')->nullable(false);

            $table->timestamps();

            //foreign key
            $table  ->foreign('idCarpeta')
                    ->references('id')
                    ->on('carpeta_asignatura')
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
        Schema::dropIfExists('secciones');
    }
}
