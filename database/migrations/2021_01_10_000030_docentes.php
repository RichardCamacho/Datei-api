<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Docentes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docentes', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable(false);//primary key
            $table->string('nombre', 100)->nullable(false);
            $table->unsignedBigInteger('grupo')->nullable(false);
            $table->unsignedBigInteger('curso')->nullable(false);
            $table->unsignedBigInteger('infCurso')->nullable(true);

            $table->timestamps();

            //foreigns keys
            $table  ->foreign('grupo')
                    ->references('id')
                    ->on('detalles_referencia')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');

            $table  ->foreign('curso')
                    ->references('id')
                    ->on('cursos')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');

            $table  ->foreign('infCurso')
                    ->references('id')
                    ->on('informacion_curso')
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
        Schema::dropIfExists('docentes');
    }
}
