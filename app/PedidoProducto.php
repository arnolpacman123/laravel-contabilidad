<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoProducto extends Model
{
    protected $table = 'pedido_productos';
    protected $primaryKey = 'id';
    protected $fillable = [ 'cantidad','precio','producto_id','pedido_venta_id' ];
    protected $timestamp = true;

    public function producto(){
        return $this->belongsTo(Producto::class,'producto_id');
    }
    public function pedidoVenta(){
        return $this->belongsTo(PedidoVenta::class,'pedido_venta_id');
    }
}
