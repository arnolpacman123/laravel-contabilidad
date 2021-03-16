<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    protected $table = 'presupuestos';
    protected $primaryKey = 'id';
    protected $fillable = [ 'vencimiento','descripcion','total','cliente_id','empresaId' ];
    protected $timestamp = true;

    // Relación con cliente
    public function cliente(){
        return $this->belongsTo(Cliente::class,'cliente_id');
    }

    // Relación con empresa
    public function empresa()
    {
        return $this->belongsTo(Empresa::class,'empresaId');
    }

    // Relación con presupuesto producto
    public function presupuestoProducto()
    {
        return $this->hasMany(PresupuestoProducto::class,'presupuesto_id');
    }
}
