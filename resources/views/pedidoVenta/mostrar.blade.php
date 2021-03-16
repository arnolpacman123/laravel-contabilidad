@extends('admin.master')
@section('container')
    <h2 class="text-center">Detalle Pedido de Venta</h2><br>
    <div class="row">
        {{-- <div class="form-group"> --}}
            <div class="col-lg-4">
                <label class="form-control-label text-black-50" for="nombre">Cliente:</label>
                <p>{{$pedidoventa->cliente->nombre}}</p>
            </div>
            <div class="col-lg-4">
                <label class="form-control-label text-black-50" for="num_compra">Número de Pedido Venta:</label>
                <p>{{$pedidoventa->id}}</p>
            </div>
            <div class="col-lg-4">
                <label class="form-control-label text-black-50" for="num_compra">Fecha:</label>
                <p>{{$pedidoventa->created_at}}</p>
            </div>
            <div class="col-lg-4">
                <label class="form-control-label text-black-50" for="nombre">Descripción:</label>
                <p>{{$pedidoventa->descripcion}}</p>
            </div>
        {{-- </div> --}}
    </div>

    <div class="row form-group border">
        <div class="col-md-12">
            <table id="detalles" class="table table-bordered table-striped table-sm">
            <thead>
                <tr class="bg-success">
                    <th class="info">Producto</th>
                    <th class="info">Precio (Bs.)</th>
                    <th class="info">Cantidad</th>
                    <th class="info">SubTotal (Bs)</th>
                </tr>
            </thead>

            <tbody>
                @foreach($detalles as $det)
                    <tr>
                        <td>{{$det->producto->nombre}}</td>
                        <td>{{$det->precio}}</td>
                        <td>{{$det->cantidad}}</td>
                        <td>{{$det->cantidad*$det->precio}}</td>
                    </tr>
                @endforeach
            </tbody>

            </table>
            <div style="display: flex;justify-content: flex-end;margin-right:22%">
                <h4>Total: {{ $pedidoventa->monto_total }}</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-xl-12 col-md-6" style="margin-top: 20px">
        <div class="form-group">
            <a href="{{ route('pedidoventa.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Atras</a>
        </div>
    </div>

@endsection
