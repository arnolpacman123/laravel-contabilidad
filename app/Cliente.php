<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id';
    protected $fillable = [ 'nombre','tipo_documento','num_documento','direccion','telefono','email','empresaId' ];
    protected $timestamp = true;
    // Relación con empresa
    public function empresa()
    {
        return $this->belongsTo(Empresa::class,'empresaId');
    }

    // Relación con pedido venta
    public function pedidoVenta()
    {
        return $this->hasMany(PedidoVenta::class,'cliente_id');
    }
    public function presupuesto()
    {
        return $this->hasMany(Presupuesto::class,'cliente_id');
    }
}
