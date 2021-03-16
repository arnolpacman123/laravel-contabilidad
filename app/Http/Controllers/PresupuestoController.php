<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\Presupuesto;
use App\PresupuestoProducto;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresupuestoController extends Controller
{
    public function index()
    {
        return view('presupuesto.lista');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'vencimiento' => 'required',
            'descripcion' => 'required',
            'total' => 'required',
            'cliente_id' => 'required'
        ]);
        $request['empresaId'] = Auth::user()->empresaId;
        $presupuesto = Presupuesto::create($request->all());
        $presupuesto->save();

        //detalle Pedido
        $producto_id=$request->producto_id;
        $cantidad=$request->cantidad;
        $precio=$request->precio;
        $cont=0;

        while($cont < count($producto_id)){
            $detalle = new PresupuestoProducto();
            $detalle->presupuesto_id = $presupuesto->id;
            $detalle->producto_id = $producto_id[$cont];
            $detalle->cantidad = $cantidad[$cont];
            $detalle->precio = $precio[$cont];
            $detalle->save();
            $cont=$cont+1;
        }

        Bitacora::create([
            'user_id' => Auth::id(),
            'accion' => "Registró un nuevo producto: $presupuesto->descripcon",
            'empresaId' => Auth::user()->empresaId,
        ]);
        return redirect()->back()->with('info','Creado con éxito');
    }

    public function registrar()
    {
        return view('presupuesto.crear');
    }

    // public function update(Request $request, $id)
    // {
    //     $presupuesto = Presupuesto::findOrFail($id);
    //     $descripcion = $presupuesto->descripcion;
    //     $presupuesto->update($request->all());
    //     Bitacora::create([
    //         'user_id' => Auth::id(),
    //         'accion' => "Actualizó el pedido de venta: $descripcion"
    //     ]);
    //     return redirect()->back()->with('act','Actualizado con éxito');
    // }
    public function mostrar($id)
    {
        $presupuesto = Presupuesto::findOrFail($id);
        $presupuesto->load('cliente');
        $detalles = PresupuestoProducto::with('producto')->where('presupuesto_id','=',$id)->get();
        return view('presupuesto.mostrar',['presupuesto' => $presupuesto, 'detalles' => $detalles]);
    }
    public function delete($id)
    {
        $presupuesto = Presupuesto::findOrfail($id);
        $presupuesto->estado = 1;
        $presupuesto->update();
        Bitacora::create([
            'user_id' => Auth::id(),
            'accion' => "Eliminó el pedido de compra: $presupuesto->descripcion ($presupuesto->id)",
            'empresaId' => Auth::user()->empresaId,
        ]);
        return redirect()->back()->with('delete','Eliminado con éxito');
    }

    public function pdf(Presupuesto $presupuesto)
    {
        $detalles = PresupuestoProducto::with('producto')->where('presupuesto_id','=',$presupuesto->id)->get();
        $pdf = PDF::loadView('presupuesto.pdf', ['presupuesto' => $presupuesto, 'detalles' => $detalles]);
        return $pdf->stream();
    }
}
