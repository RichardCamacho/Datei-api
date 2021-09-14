<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Publicaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicaciones', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable(false);//primary key
            $table->timestamp('fechaPublicacion')->nullable(false);
            $table->string('lugarPublicacion', 100)->nullable(false);
            $table->string('titulo', 100)->nullable(false);
            $table->unsignedBigInteger('hoja_vida')->nullable(false);

            $table->timestamps();

            //foreign key
            $table  ->foreign('hoja_vida')
                    ->references('id')
                    ->on('hojas_vida')
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
        Schema::dropIfExists('publicaciones');
    }
}
