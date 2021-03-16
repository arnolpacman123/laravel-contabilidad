@extends('admin.master')
@section('container')
    <h1 style="display: inline-block">Presupuesto</h1>
    @can('presupuesto.registrar')
        <a href="{{route('presupuestos.registrar')}}">
            <button class="btn bg-success text-white" style="margin-bottom: 12px"><i class="fa fa-plus"></i> Nuevo</button>
        </a>
    @endcan

    <table class="table table-condensed table-hover">
        <thead>
            <tr class="table-primary">
                <th scope="col">Id</th>
                <th scope="col">Vencimiento</th>
                <th scope="col">Total</th>
                <th scope="col">Descripción</th>
                <th scope="col">Cliente</th>
                <th scope="col">Fecha</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach (getPresupuesto() as $presupuesto)
                <tr>
                    <th scope="row">{{ $presupuesto->id }}</th>
                    <td>{{ $presupuesto->vencimiento }}</td>
                    <td>{{ $presupuesto->total }}</td>
                    <td>{{ $presupuesto->descripcion }}</td>
                    <td>{{ $presupuesto->cliente->nombre }}</td>
                    <td>{{ $presupuesto->created_at }}</td>
                    <td>
                        @can('presupuestos.mostrar')
                            <a href="{{ route('presupuestos.mostrar',['id' => $presupuesto->id])}}">
                                <button class="btn btn-info text-white"><i class="far fa-file-alt"></i> Detalles</button>
                            </a>
                        @endcan
                        {{--
                        @can('pedidoventa.actualizar')
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#act-{{ $pedido->id }}">
                                <i class="fa fa-edit"></i> Actualizar
                            </button>
                        @endcan --}}

                        <!-- Modal -->
                        {{-- <div class="modal fade" id="act-{{ $pedido->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                {{ csrf_field() }}

                                <form action="{{ url('/pedidoventaactualizar', $pedido->id) }}" method="PUT">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Actualizar </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="descripcion">Descripción</label>
                                                <input name="descripcion" type="text" class="form-control" id="descripcion" value="{{ $pedido->descripcion }}"aria-describedby="emailHelp" placeholder="Ingresar el nombre">
                                            </div>
                                            <div class="form-group">
                                                <label for="cliente_id">Cliente</label>
                                                <select name="cliente_id" id="cliente_id" class="form-control"
                                                    data-live-search="true" data-size="3" data-dropup-auto="false">
                                                    <option value="0" selected disabled>Seleccione:</option>
                                                    @foreach (getCliente() as $cliente)
                                                        <option value="{{ $cliente->id }}" @if($cliente->nombre == $pedido->cliente->nombre) selected @endif>{{ $cliente->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Actualizar</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div> --}}

                        <!-- Eliminar-->
                        @can('presupuestos.eliminar')
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-{{ $presupuesto->id }}">
                                <i class="far fa-trash-alt"></i> Eliminar
                            </button>
                        @endcan

                        <!-- Modal -->
                        <div class="modal fade" id="delete-{{ $presupuesto->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">Eliminar Presupuesto</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ url('/presupuestoeliminar', $presupuesto->id) }}" method="put">

                                        <div class="modal-body">

                                            <label for="">Esta seguro que desea eliminar el pedido({{ $presupuesto->id }})</label>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i> Eliminar</button>
                                        </div>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
