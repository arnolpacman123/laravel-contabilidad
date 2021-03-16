<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    public function index()
    {
        return view('producto.lista');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'stock' => 'required',
            'descripcion' => 'required',
            // 'precio_unitario' => 'required'
        ]);

        $request['empresaId'] = Auth::user()->empresaId;
        $producto = Producto::create($request->all());
        $producto->save();
        Bitacora::create([
            'user_id' => Auth::id(),
            'accion' => "Registró un nuevo producto: $producto->nombre",
            'empresaId' => Auth::user()->empresaId,
        ]);
        return redirect()->back()->with('info','Creado con éxito');
    }

    public function registrar()
    {
        return view('producto.crear');
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $nombre = $producto->nombre;
        $producto->update($request->all());
        Bitacora::create([
            'user_id' => Auth::id(),
            'accion' => "Actualizó el pedido de venta: $nombre",
            'empresaId' => Auth::user()->empresaId,
        ]);
        return redirect()->back()->with('act','Actualizado con éxito');
    }
    public function mostrar($id)
    {
        $producto = Producto::findOrFail($id);
        return view('producto.mostrar',['producto' => $producto]);
    }
    public function delete($id)
    {
        $producto = Producto::findOrfail($id);
        $producto->estado = 1;
        $producto->update();
        Bitacora::create([
            'user_id' => Auth::id(),
            'accion' => "Eliminó el pedido de compra: $producto->nombre ($producto->id)",
            'empresaId' => Auth::user()->empresaId,
        ]);
        return redirect()->back()->with('delete','Eliminado con éxito');
    }
}
