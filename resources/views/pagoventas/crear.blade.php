@extends('admin.master')
@section('container')
    <h2>Registrar Pago Venta</h2>

    <form action="{{route('pagoventa.crear')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="facturaVenta">Factura Venta</label>
                    <select name="facturaVenta" id="facturaVenta" class="form-control"
                        data-live-search="true" data-size="3" data-dropup-auto="false">
                        <option value="0" selected disabled>Seleccione:</option>
                        @foreach (getFacturaVenta() as $facturaventa)
                            <option value="{{ $facturaventa->id }}_{{ $facturaventa->monto }}">{{ $facturaventa->descripcion }}</option>
                        @endforeach
                    </select>
                    @error('facturaVenta_id')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <input name="facturaVenta_id" id="facturaVenta_id" type="hidden" value="" aria-describedby="emailHelp">

            <div class="col-lg-6">
                <div class="form-group">
                    <label for="monto">Monto</label>
                    <input type="text" readonly name="monto" value="" id="monto" class="form-control" placeholder="Monto...">
                </div>
            </div>
        </div>
        <a href="{{ route('pagoventa.index') }}" class="btn btn-info text-white"><i class="fas fa-arrow-left"></i> Retornar</a>
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Registrar Pago Venta</button>
    </form>
    @push('scripts')
        <script>
            const facturaVenta = document.getElementById('facturaVenta');
            facturaVenta.addEventListener("change", function(e) {
                mostrarlistadoVenta();
            });
            function mostrarlistadoVenta() {
                datosFactura = document.getElementById('facturaVenta').value.split('_');
                document.getElementById('monto').setAttribute("placeholder", datosFactura[1]);//
                document.getElementById('monto').setAttribute("value", datosFactura[1]);//
                document.getElementById('facturaVenta_id').setAttribute("value", datosFactura[0]);
            }
        </script>
    @endpush

@endsection
