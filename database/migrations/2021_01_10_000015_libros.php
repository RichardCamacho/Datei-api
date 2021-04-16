<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Libros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable(false);//primary key
            $table->string('titulo', 200)->nullable(false);
            $table->string('autor', 200)->nullable(false);
            $table->string('editorial', 100)->nullable(false);
            $table->string('anio', 20)->nullable(false);
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
        Schema::dropIfExists('libros');
    }
}
