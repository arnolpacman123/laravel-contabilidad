@extends('admin.master')
@section('container')
    <h1>Registrar Proveedor</h1>

    <form action="{{url('/proveedorcrear')}}" method="post">
    {{csrf_field()}}
    {{-- protected $fillable=['direccion','email','celular']; --}}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="exampleInputPassword1">Carnet de Identidad:</label>
                <input name="ci" type="number" class="form-control" id="exampleInputPassword1" value="{{ old('ci') }}" placeholder="Ingresa el carnet de identidad...">
                @error('ci')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre:</label>
                <input name="nombre" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ old('nombre') }}" placeholder="Ingresar el nombre...">
                @error('nombre')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input name="direccion" type="text" class="form-control" id="direccion" aria-describedby="emailHelp" value="{{ old('direccion') }}" placeholder="Ingresar el direccion...">
                @error('direccion')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="email">Correo Electronico:</label>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{ old('email') }}" placeholder="Ingresar el email...">
                @error('email')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="exampleInputPassword1">Empresa:</label>
                <input name="empresa" type="text" class="form-control" id="exampleInputPassword1" value="{{ old('empresa') }}" placeholder="Ingresa el nombre de la empresa...">
                @error('empresa')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input name="telefono" type="text" class="form-control" id="telefono" aria-describedby="emailHelp" value="{{ old('telefono') }}" placeholder="Ingresar el teléfono...">
                @error('telefono')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="celular">Celular:</label>
                <input name="celular" type="text" class="form-control" id="celular" aria-describedby="emailHelp" value="{{ old('celular') }}" placeholder="Ingresar el celular...">
                @error('celular')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
        <a href="{{ route('proveedor.index') }}" class="btn btn-info text-white"><i class="fas fa-arrow-left"></i> Retornar</a>
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Registrar Proveedor</button>
    </form>


@endsection
