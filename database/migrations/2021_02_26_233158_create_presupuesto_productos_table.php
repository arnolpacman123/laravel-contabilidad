<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresupuestoProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuesto_productos', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->float('precio');
            // relación con productos
            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->on('productos')->references('id')->onDelete('cascade');

            // Relación con presupuesto
            $table->unsignedBigInteger('presupuesto_id');
            $table->foreign('presupuesto_id')->on('presupuestos')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('presupuesto_productos');
    }
}
