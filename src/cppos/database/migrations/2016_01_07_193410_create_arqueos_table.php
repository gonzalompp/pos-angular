<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArqueosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arqueos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            
            $table->integer('id_user');
            $table->integer('id_garzon');
            
            $table->dateTime('fecha_desde');
            $table->dateTime('fecha_hasta');
            
            //registrado previamente por el sistema
            $table->decimal('sistema_efectivo');
            $table->decimal('sistema_credito');
            $table->decimal('sistema_debito');
            $table->decimal('sistema_cheque');
            
            //contado manualmente por usuario
            $table->decimal('registrado_efectivo');
            $table->decimal('registrado_credito');
            $table->decimal('registrado_debito');
            $table->decimal('registrado_cheque');
            
            $table->integer('upflag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('arqueos');
    }
}
