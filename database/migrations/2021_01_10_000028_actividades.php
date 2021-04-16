<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Actividades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable(false);//primary key
            $table->string('descripcion', 200)->nullable(false);
            $table->timestamp('fecha')->nullable(false);
            $table->string('responsable', 100)->nullable(false);
            $table->unsignedBigInteger('idActa')->nullable(false);

            $table->timestamps();

            //foreign keys
            $table  ->foreign('idActa')
                    ->references('id')
                    ->on('actas_so')
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
        Schema::dropIfExists('actividades');
    }
}
