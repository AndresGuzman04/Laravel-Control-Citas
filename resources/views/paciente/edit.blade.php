@extends('template')

@section('title', 'Editar Paciente')

@push('styles')    
@endpush

@section('content')
<div class="container-fluid">
     <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <!-- <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Panel</a></li>
            <li class="breadcrumb-item "><a href="{{ route('pacientes.index') }}">Paciente</a></li>
            <li class="breadcrumb-item active">Editar Paciente</li>
        </ol>
    </div>


    <div class="card text-bg-light">
        <form action="{{ route('pacientes.update', [ 'paciente'=> $paciente ]) }}" method="POST" id="formPaciente">
            @method('PATCH')
            @csrf
            <div class="card-body">
                <div class="row g-4">
                    <!-- Nombre -->
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $paciente->nombre) }}" >
                        @error('nombre')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Apellido -->
                    <div class="col-md-6">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" name="apellido" id="apellido" class="form-control" value="{{ old('apellido', $paciente->apellido) }}" >
                        @error('apellido')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Dirección -->
                    <div class="col-md-6">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion', $paciente->direccion) }}" >
                        @error('direccion')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Teléfono -->
                    <div class="col-md-6">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono', $paciente->telefono) }}" >
                        @error('telefono')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{ old('email', $paciente->email) }}" >
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>

                    <!-- Número de documento -->
                    <div class="col-md-6">
                        <label for="numero_documento" class="form-label">DUI</label>
                        <input type="text" name="numero_documento" id="numero_documento" class="form-control" value="{{ old('numero_documento', $paciente->numero_documento) }}" >
                        @error('numero_documento')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary">Actualizar Paciente</button>
                <button type="reset" class="btn btn-secondary">Reiniciar</button>
            </div>
        </form>
    </div>

</div>
@endsection

@push('js')
@endpush