@extends('admin.master')
@section('container')
    <h2>Registrar Producto</h2>

    <form action="{{route('productos.crear')}}" method="post">
    {{csrf_field()}}
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input name="nombre" type="text" class="form-control" id="nombre" value="{{ old('nombre') }}" aria-describedby="emailHelp" placeholder="Ingresar la descripción...">
                    @error('nombre')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
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
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input name="stock" type="number" class="form-control" id="stock" value="{{ old('stock') }}" aria-describedby="emailHelp" placeholder="Ingresar stock...">
                    @error('stock')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="precio_unitario">Precio</label>
                    <input name="precio_unitario" type="text" class="form-control" id="precio_unitario" value="{{ old('precio_unitario') }}" aria-describedby="emailHelp" placeholder="Ingresar precio_unitario...">
                    @error('precio_unitario')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <a href="{{ route('productos.index') }}" class="btn btn-info text-white"><i class="fas fa-arrow-left"></i> Retornar</a>
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Registrar Producto</button>
    </form>


@endsection
