<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable(false);//primary key
            $table->string('email',100)->unique()->nullable(false);
            $table->string('password', 100);
            $table->string('primerNombre', 200)->nullable(false);
            $table->string('segundoNombre', 200)->nullable(true);
            $table->string('primerApellido', 200)->nullable(false);
            $table->string('segundoApellido', 200)->nullable(false);
            $table->unsignedBigInteger('rango')->nullable(true);
            $table->unsignedBigInteger('rol')->nullable(true);
            $table->unsignedBigInteger('programa')->nullable(true);
            $table->string('token')->nullable(true);
            $table->rememberToken();//remember_token
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable(true);

            //foreign key
            $table  ->foreign('rango')
                    ->references('id')
                    ->on('detalles_referencia')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');

            $table  ->foreign('rol')
                    ->references('id')
                    ->on('detalles_referencia')
                    ->onDelete('restrict')
                    ->onUpdate('cascade');

            $table  ->foreign('programa')
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
        Schema::dropIfExists('users');
    }
}
