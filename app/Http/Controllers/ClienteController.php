<?php

namespace App\Http\Controllers;

use App\Bitacora;
use App\Cliente;
use Barryvdh\DomPDF\Facade as  PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    public function index()
    {
        return view('cliente.lista');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'tipo_documento'    => 'required',
            'num_documento'     => 'required',
            'nombre'            => 'required',
            'direccion'         => 'required',
            'telefono'          => 'required',
            'email'             => 'required'
        ]);
        $request['empresaId'] = Auth::user()->empresaId;
        $cliente = Cliente::create($request->all());
        $cliente->save();
        Bitacora::create([
            'user_id' => Auth::id(),
            'accion' => "Registró al cliente: $cliente->nombre",
            'empresaId' => Auth::user()->empresaId,
        ]);
        return redirect()->back()->with('info','Creado con éxito');
    }

    public function registrar()
    {
        return view('cliente.crear');
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
        $nombre = $cliente->nombre;
        $cliente->update($request->all());
        Bitacora::create([
            'user_id' => Auth::id(),
            'accion' => "Actualizó los datos del cliente: $nombre",
            'empresaId' => Auth::user()->empresaId
        ]);
        return redirect()->back()->with('act','Actualizado con éxito');
    }

    public function delete($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->estado = 1;
        $cliente->update();
        Bitacora::create([
            'user_id' => Auth::id(),
            'accion' => "Eliminó al cliente: $cliente->nombre"
        ]);
        return redirect()->back()->with('delete','Eliminado con éxito');
    }

    public function pdf()
    {
        $pdf = PDF::loadView('cliente.pdf', ['clientes' => Cliente::all()]);
        return $pdf->stream();
    }
}
