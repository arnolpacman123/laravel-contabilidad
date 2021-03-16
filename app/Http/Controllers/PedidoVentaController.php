<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\PedidoProducto;
use App\PedidoVenta;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoVentaController extends Controller
{
    public function index()
    {
        return view('pedidoVenta.lista');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'descripcion' => 'required',
            'cliente_id' => 'required'
        ]);
        $request['empresaId'] = Auth::user()->empresaId;
        $pedidoventa = PedidoVenta::create($request->all());
        $pedidoventa->save();

        //detalle Pedido
        $producto_id=$request->producto_id;
        $cantidad=$request->cantidad;
        $precio=$request->precio_venta;
        $cont=0;

        while($cont < count($producto_id)){
            $detalle = new PedidoProducto();
            $detalle->pedido_venta_id = $pedidoventa->id;
            $detalle->producto_id = $producto_id[$cont];
            $detalle->cantidad = $cantidad[$cont];
            $detalle->precio = $precio[$cont];
            $detalle->save();
            $cont=$cont+1;
        }
        Bitacora::create([
            'user_id' => Auth::id(),
            'accion' => "Registró un nuevo pedido de venta: $pedidoventa->descripcion",
            'empresaId' => Auth::user()->empresaId,
        ]);
        return redirect()->back()->with('info','Creado con éxito');
    }

    public function registrar()
    {
        return view('pedidoVenta.crear');
    }

    // public function update(Request $request, $id)
    // {
    //     $pedidoventa = PedidoVenta::findOrFail($id);
    //     $descripcion = $pedidoventa->descripcion;
    //     $pedidoventa->update($request->all());
    //     Bitacora::create([
    //         'user_id' => Auth::id(),
    //         'accion' => "Actualizó el pedido de venta: $descripcion"
    //     ]);
    //     return redirect()->back()->with('act','Actualizado con éxito');
    // }
    public function mostrar($id)
    {
        $pedidoventa = PedidoVenta::findOrFail($id);
        $pedidoventa->load('cliente');
        $detalles = PedidoProducto::with('producto')->where('pedido_venta_id','=',$id)->get();
        return view('pedidoVenta.mostrar',['pedidoventa' => $pedidoventa, 'detalles' => $detalles]);
    }


    public function delete($id)
    {
        $pedidoventa = PedidoVenta::findOrfail($id);
        $pedidoventa->estado = 1;
        $pedidoventa->update();
        Bitacora::create([
            'user_id' => Auth::id(),
            'accion' => "Eliminó el pedido de compra: $pedidoventa->descripcion ($pedidoventa->id)",
            'empresaId' => Auth::user()->empresaId,
        ]);
        return redirect()->back()->with('delete','Eliminado con éxito');
    }

    public function pdf()
    {
        $pdf = PDF::loadView('pedidoVenta.pdf', ['pedidosventas' => PedidoVenta::all()]);
        return $pdf->stream();
    }
}
