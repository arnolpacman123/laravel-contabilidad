@extends('admin.master')
@section('container')
    <h2>Registrar Pedido Venta</h2>

    <form action="{{route('pedidoventa.crear')}}" method="post">
    {{csrf_field()}}
        <div class="row">
            <div class="col-lg-8">
                <div class="form-group">
                    <label for="cliente_id">Cliente</label>
                    <select name="cliente_id" id="cliente_id" class="form-control selectpicker"
                        data-live-search="true" data-size="3" data-dropup-auto="false">
                        <option value="0" selected disabled>Seleccione:</option>
                        @foreach (getCliente() as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                    @error('cliente_id')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input name="descripcion" type="text" class="form-control" id="descripcion" value="{{ old('descripcion') }}" aria-describedby="emailHelp" placeholder="Ingresar la descripción...">
                    @error('descripcion')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="producto_id">Producto:</label>
                    <select name="producto_id" id="producto_id" class="form-control selectpicker" data-live-search="true" data-size="3" data-dropup-auto="false">
                        <option value="0">Seleccione:</option>
                        @foreach (getProducto() as $producto)
                            <option value="{{$producto->id}}_{{ $producto->stock }}_{{ $producto->precio_unitario }}">{{$producto->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="form-group">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" name="cantidad" id="cantidad" class="form-control " placeholder="cantidad...">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label for="stock">Stock:</label>
                    <input type="number" disabled name="stock" id="stock" class="form-control " placeholder="stock...">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label for="precio_venta">Precio Venta</label>
                    <input type="number" disabled name="precio_venta_unitario" id="precio_venta" class="form-control " placeholder="Precio venta...">
                </div>
            </div>

            <div class="col-lg-2">
                <div class="form-group">
                    <button type="button" id="agregar" class="btn btn-primary" style="margin-top: 30px"><i class="fa fa-plus"></i> Agregar</button>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="table table-responsive table-bordered table-hover">
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color: #A9D0F5">
                            <th>Opciones</th>
                            <th>Producto</th>
                            <th>Precio Venta</th>
                            <th>Cantidad</th>
                            <th>Sub Total</th>
                        </thead>
                        <tfoot>
                            <th>Total</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>
                                <h4 id="total">00Bs</h4>
                                <input type="hidden" name="monto_total" id="monto_total">
                            </th>
                        </tfoot>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-1 col-sm-6 col-md-6 col-xl-12" id="guardar">
            <div class="form-group">
                <input name="_token" {{-- value="{{crsf_token()}}" --}} type="hidden">
                @csrf
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Registrar Pedido Venta</button>
            </div>
        </div>
        <div class="col-lg-1 col-sm-6 col-md-6 col-xl-12">
            <div class="form-group">
                <a href="{{ route('pedidoventa.index') }}"><button type="button" class="btn btn-primary" ><i class="fas fa-arrow-left"></i> Volver</button></a>
            </div>
        </div>
    </form>
    @push('scripts')
        <script>
        $(document).ready(function(){
            $("#agregar").click(function(){
                agregar();
            })
        })
        var cont = 0;
        var total = 0;
        var subtotal = [];
        $("#guardar").hide();
        $("#producto_id").change(mostrarValores);
        function mostrarValores(){
            datosProducto = document.getElementById('producto_id').value.split('_');
            $("#precio_venta").val(datosProducto[2]);
            $("#stock").val(datosProducto[1]);
        }

        function agregar(){
            datosProducto = document.getElementById('producto_id').value.split('_');

            producto_id= datosProducto[0];
            producto= $("#producto_id option:selected").text();
            cantidad= $("#cantidad").val();
            precio_venta= $("#precio_venta").val();
            stock= $("#stock").val();

            if (producto_id != "" && cantidad != "" && precio_venta !="") {
                if (cantidad > 0 && precio_venta >= 0) {
                    if (parseInt(stock) >= parseInt(cantidad)) {
                        subtotal[cont] = (cantidad * precio_venta);
                        total = total + subtotal[cont];
                        var fila = '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="producto_id[]" value="'+producto_id+'">'+producto+'</td><td><input type="text" name="precio_venta[]" readonly value="'+precio_venta+'"> </td><td><input type="text" name="cantidad[]" readonly value="'+cantidad+'"></td> <td>'+(subtotal[cont].toFixed(2))+'</td></tr>';
                        cont++;
                        limpiar();
                        totales();
                        evaluar();
                        $('#detalles').append(fila);
                    }
                    else {
                        alert("La cantidad a vender supera el stock");
                    }
                }
                else{
                    alert("Ingresar cantidad mayor a 0");
                }
            }
            else{
                alert('Error al ingresar los datos');
            }

        }
        function totales(){
            $("#total").html(total.toFixed(2) + "Bs.");
            $("#monto_total").val(total);
        }


        function limpiar(){
            $("#cantidad").val("");
            $("#stock").val("");
            $("#precio_venta").val("");
        }
        function evaluar(){
            if(total > 0){
                $("#guardar").show();
            }else{
                $("#guardar").hide();
            }
        }
        function eliminar(index) {
            total= total - subtotal[index];
            $("#total").html(total.toFixed(2) +"Bs." );
            $("#monto_total").val(total);
            $("#fila" + index).remove();
            evaluar();
        }
    </script>
@endpush


@endsection
