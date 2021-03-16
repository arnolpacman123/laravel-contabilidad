@extends('admin.master')
@section('container')
    <h1 style="display: inline-block">Productos</h1>
    @can('productos.registrar')
        <a href="{{route('productos.registrar')}}">
            <button class="btn bg-success text-white" style="margin-bottom: 12px"><i class="fa fa-plus"></i> Nuevo</button>
        </a>
    @endcan

    <table class="table table-condensed table-hover">
        <thead>
            <tr class="table-primary">
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Stock</th>
                <th scope="col">Precio</th>
                <th scope="col">Fecha</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach (getProducto() as $producto)
                <tr>
                    <th scope="row">{{ $producto->id }}</th>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->descripcion }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td>{{ $producto->precio_unitario }}</td>
                    <td>{{ $producto->created_at }}</td>
                    <td>
                        @can('productos.actualizar')
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#act-{{ $producto->id }}">
                                <i class="fa fa-edit"></i> Actualizar
                            </button>
                        @endcan

                        <!-- Modal -->
                        <div class="modal fade" id="act-{{ $producto->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                {{ csrf_field() }}

                                <form action="{{ url('/productoactualizar', $producto->id) }}" method="PUT">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Actualizar </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="nombre">Nombre</label>
                                                <input name="nombre" type="text" class="form-control" id="nombre" value="{{ $producto->nombre }}"aria-describedby="emailHelp" placeholder="Ingresar el nombre">
                                            </div>

                                            <div class="form-group">
                                                <label for="descripcion">Descripción</label>
                                                <input name="descripcion" type="text" class="form-control" id="descripcion" value="{{ $producto->descripcion }}"aria-describedby="emailHelp" placeholder="Ingresar el Descripción">
                                            </div>
                                            <div class="form-group">
                                                <label for="stock">Stock</label>
                                                <input name="stock" type="text" class="form-control" id="stock" value="{{ $producto->stock }}"aria-describedby="emailHelp" placeholder="Ingresar el Stock">
                                            </div>
                                            <div class="form-group">
                                                <label for="precio_unitario">Precio:</label>
                                                <input name="precio_unitario" type="text" class="form-control" id="precio_unitario" value="{{ $producto->precio_unitario }}"aria-describedby="emailHelp" placeholder="Ingresar el precio">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Actualizar</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Eliminar-->
                        @can('productos.eliminar')
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-{{ $producto->id }}">
                                <i class="far fa-trash-alt"></i> Eliminar
                            </button>
                        @endcan

                        <!-- Modal -->
                        <div class="modal fade" id="delete-{{ $producto->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">Eliminar Producto</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ url('/productoeliminar', $producto->id) }}" method="put">

                                        <div class="modal-body">

                                            <label for="">Esta seguro que desea eliminar el producto({{ $producto->nombre }})</label>
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
