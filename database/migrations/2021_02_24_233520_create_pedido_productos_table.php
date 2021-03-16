<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_productos', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->float('precio');
            // relación con productos
            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->on('productos')->references('id')->onDelete('cascade');

            // Relación con pedido Venta
            $table->unsignedBigInteger('pedido_venta_id');
            $table->foreign('pedido_venta_id')->on('pedido_venta')->references('id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedido_productos');
    }
}
