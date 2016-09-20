<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            
            $table->decimal('subtotal', 19, 4);
            $table->decimal('propina', 19, 4);
            $table->decimal('total', 19, 4);
            
            $table->integer('id_cliente');
            
            $table->integer('id_tipo'); 
            $table->integer('id_estado');
            
            $table->text('observaciones');
            
            $table->string('despacho_direccion', 200);
            $table->string('despacho_comuna', 200);
            $table->string('despacho_telefono', 200);
            
            $table->string('nombre_persona_retira', 200);
            
            $table->integer('id_mesa');
            
            //pagos
            $table->decimal('pago_efectivo');
            $table->decimal('pago_credito');
            $table->decimal('pago_debito');
            $table->decimal('pago_cheque');
            
            $table->integer('upflag');
        });
        
        DB::table('pedidos')->insert(array(
            //Sushi
            array(
                'subtotal' => 0, 
                'propina' => 0, 
                'total' => 0, 
                'id_cliente'=>1,
                'id_tipo'=>1,
                'id_tipo'=>1,
                'id_estado'=>1,
                'id_mesa'=>1,
                
                'pago_efectivo'=>0,
                'pago_credito'=>0,
                'pago_debito'=>0,
                'pago_cheque'=>0
            )
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pedidos');
    }
}
