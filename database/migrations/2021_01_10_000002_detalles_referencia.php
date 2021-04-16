<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DetallesReferencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_referencia', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable(false);//primary key
            $table->string('nombre', 100)->nullable(false);
            $table->unsignedBigInteger('tipoReferencia')->nullable(false);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable(true);
            
            //foreign key
            $table  ->foreign('tipoReferencia')
                    ->references('id')
                    ->on('tipos_referencia')
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
        Schema::dropIfExists('detalles_referencia');
    }
}
