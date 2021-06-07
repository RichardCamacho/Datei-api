<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Asistentes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistentes', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable(false);//primary key
            $table->string('nombre', 200)->nullable(false);
            $table->string('posicion', 200)->nullable(false);
            $table->boolean('asistencia')->nullable(false);
            $table->boolean('excusa')->nullable(true);
            $table->unsignedBigInteger('idActa')->nullable(false);

            $table->timestamps();

            //foreign keys
            $table  ->foreign('idActa')
                    ->references('id')
                    ->on('actas_so')
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
        Schema::dropIfExists('asistentes');
    }
}
