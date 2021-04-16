<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Prerequisitos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prerequisitos', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable(false);//primary key
            $table->string('nombre', 200)->nullable(false);
            $table->unsignedBigInteger('curso')->nullable(false);//a que curso pertenece el registro
            $table->unsignedBigInteger('tipo')->nullable(false);//a que curso pertenece el registro

            $table->timestamps();

            //foreign key
            $table  ->foreign('curso')
                    ->references('id')
                    ->on('informacion_curso')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            
            $table  ->foreign('tipo')
                    ->references('id')
                    ->on('detalles_referencia')
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
        Schema::dropIfExists('prerequisitos');
    }
}
