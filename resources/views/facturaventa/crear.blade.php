@extends('admin.master')
@section('container')
    <h2>Registrar Factura Venta</h2>

    <form action="{{route('facturaventa.crear')}}" method="post">
    {{csrf_field()}}
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="pedidoVenta">Pedido Venta:</label>
                    <select name="pedidoVenta" id="pedidoVenta" class="form-control selectpicker"
                        data-live-search="true">
                        <option value="0" selected disabled>Seleccione:</option>
                        @foreach (getPedidoVenta() as $pedido)
                            <option value="{{ $pedido->id }}_{{ $pedido->monto_total }}">{{ $pedido->descripcion }}</option>
                        @endforeach
                    </select>
                    @error('pedidoVenta_id')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <input name="pedidoVenta_id" id="pedidoVenta_id" type="hidden" value="" aria-describedby="emailHelp">

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="monto">Monto:</label>
                    <input type="text" readonly name="monto" value="" id="monto" class="form-control" placeholder="Monto...">
                    @error('monto')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="asiento_id">Asiento:</label>
                    <select name="asiento_id" id="asiento_id" class="form-control"
                        data-live-search="true" data-size="3" data-dropup-auto="false">
                        <option value="0" selected disabled>Seleccione:</option>
                        @foreach (getAsiento() as $asiento)
                            <option value="{{ $asiento->id }}">{{ $asiento->moneda }}</option>
                        @endforeach
                    </select>
                    @error('asiento_id')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <input name="descripcion" type="text" class="form-control" value="{{ old('descripcion') }}" id="descripcion" aria-describedby="emailHelp" placeholder="Ingresar la descripción...">
                    @error('descripcion')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <a href="{{ route('facturaventa.index') }}" class="btn btn-info text-white"><i class="fas fa-arrow-left"></i> Retornar</a>
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Registrar Factura Venta</button>
    </form>
    @push('scripts')
        <script>
            const facturaVenta = document.getElementById('pedidoVenta');
            facturaVenta.addEventListener("change", function(e) {
                mostrarlistadoVenta();
            });
            function mostrarlistadoVenta() {
                datosFactura = document.getElementById('pedidoVenta').value.split('_');
                document.getElementById('monto').setAttribute("placeholder", datosFactura[1]);//
                document.getElementById('monto').setAttribute("value", datosFactura[1]);//
                document.getElementById('pedidoVenta_id').setAttribute("value", datosFactura[0]);
            }
        </script>
    @endpush

@endsection
