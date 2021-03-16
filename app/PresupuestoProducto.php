<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PresupuestoProducto extends Model
{
    protected $table = 'presupuesto_productos';
    protected $primaryKey = 'id';
    protected $fillable = [ 'cantidad','precio','producto_id','presupuesto_id' ];
    protected $timestamp = true;

    public function producto(){
        return $this->belongsTo(Producto::class,'producto_id');
    }
    public function presupuesto(){
        return $this->belongsTo(Presupuesto::class,'presupuesto_id');
    }
}
