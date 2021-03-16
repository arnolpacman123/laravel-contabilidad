<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';
    protected $fillable = [ 'nombre','stock','descripcion','precio_unitario','empresaId' ];
    protected $timestamp = true;

    // Relación con producto
    public function pedidoProducto(){
        return $this->hasMany(PedidoProducto::class,'producto_id');
    }

    // Relación con empresa
    public function empresa()
    {
        return $this->belongsTo(Empresa::class,'empresaId');
    }

    // Relación con presupuestoProducto
    public function presupuestoProducto() {
        return $this->hasMany(PresupuestoProducto::class,'producto_id');
    }
}
