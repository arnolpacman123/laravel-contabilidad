<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresupuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuestos', function (Blueprint $table) {
            $table->id();
            $table->date('vencimiento');
            $table->string('descripcion');
            $table->float('total');
            $table->boolean('estado')->default('0');

            // Relación con cliente
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->on('clientes')->references('id')->onDelete('cascade');

            // Relación con empresa
            $table->unsignedBigInteger('empresaId');
            $table->foreign('empresaId')->references('id')->on('empresas');
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
        Schema::dropIfExists('presupuestos');
    }
}
