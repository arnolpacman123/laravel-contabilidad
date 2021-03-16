<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoVenta extends Model
{
    protected $table='pedido_venta';
    protected $primaryKey='id';
    protected $fillable=[ 'descripcion','cliente_id','monto_total','empresaId' ];
    protected $timestamp = true;

    // Relación con pedido Venta
    public function pedidoProducto(){
        return $this->hasMany(PedidoProducto::class,'pedido_venta_id');
    }

    // Relación con cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class,'cliente_id');
    }
    // Relación con factura venta
    public function facturaVenta()
    {
        return $this->hasOne(FacturaVenta::class,'pedidoVenta_id');
    }
    public function empresa(){
        return $this->belongsTo(Empresa::class,'empresaId');
    }
}
