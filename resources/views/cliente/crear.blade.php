@extends('admin.master')
@section('container')
    <h2>Registrar Cliente</h2>

    <form action="{{route('cliente.crear')}}" method="post">
    {{csrf_field()}}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input name="nombre" type="text" class="form-control" id="nombre" value="{{ old('nombre') }}" aria-describedby="emailHelp" placeholder="Ingresar el nombre">
                @error('nombre')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="email">Correo Electronico</label>
                <input name="email" type="text" class="form-control" id="email" value="{{ old('email') }}" aria-describedby="emailHelp" placeholder="Ingresar el email...">
                @error('email')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="tipo_documento">Tipo Documento</label>
                <select name="tipo_documento" id="tipo_documento"  class="form-control selectpicker" data-live-search="true" data-size="3" data-dropup-auto="false">
                    <option value="0" disabled selected>Seleccione Documento:</option>
                    <option value="carnet_identidad">Carnet Identidad</option>
                    <option value="nit">Nit</option>
                </select>
                @error('tipo_documento')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="num_documento">Número Documento</label>
                <input name="num_documento" type="text" class="form-control" id="num_documento" aria-describedby="emailHelp" value="{{ old('num_documento') }}" placeholder="Ingresar número documento...">
                @error('num_documento')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input name="telefono" type="text" class="form-control" id="telefono" aria-describedby="emailHelp" value="{{ old('telefono') }}" placeholder="Ingresar teléfono...">
                @error('telefono')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input name="direccion" type="text" class="form-control" value="{{ old('direccion') }}" id="direccion" aria-describedby="emailHelp" placeholder="Ingresar la dirección...">
                @error('direccion')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <a href="{{ route('cliente.index') }}" class="btn btn-info text-white"><i class="fas fa-arrow-left"></i> Retornar</a>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Registrar Cliente</button>
        </div>
    </form>


@endsection
