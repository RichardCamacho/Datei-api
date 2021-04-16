<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Portadas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portadas', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable(false);//primary key
            $table->string('nombre', 100)->nullable(false);
            $table->string('path')->nullable(false);
            $table->string('tipo')->nullable(false);
            $table->unsignedBigInteger('curso')->nullable(false);//a que curso pertenece el registro

            $table->timestamps();

            //foreign key
            $table  ->foreign('curso')
                    ->references('id')
                    ->on('informacion_curso')
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
        Schema::dropIfExists('portadas');
    }
}
