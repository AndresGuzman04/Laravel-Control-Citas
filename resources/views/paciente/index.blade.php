@extends('template')

@section('title', 'Pacientes')

@push('styles')    

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

@endpush

@section('content')

@if (session('success'))
<script>
    Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
}).fire({
  icon: "success",
  title: message = "{{ session('success') }}"
});
</script>
@endif

<div class="container-fluid">
     <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <!-- <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> -->
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Panel</a></li>
                            <li class="breadcrumb-item active">Paciente</li>
                        </ol>
                    </div>
                    <div class="mb-4"> 
                        <a href="{{ route('pacientes.create') }}" class="btn btn-primary">Registrar Paciente</a>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="datatablesSimple" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Direccion</th>
                                            <th>Telefono</th>
                                            <th>Email</th>
                                            <th>N Documento</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    @foreach ($pacientes as $paciente)
                                    <tr>
                                        <td>{{ $paciente->nombre }}</td>
                                        <td>{{ $paciente->apellido }}</td>
                                        <td>{{ $paciente->direccion }}</td>
                                        <td>{{ $paciente->telefono }}</td>
                                        <td>{{ $paciente->email }}</td>
                                        <td>{{ $paciente->numero_documento }}</td>
                                        <td>
                                            @if ($paciente->estado == 1)
                                                <span class="badge bg-success" style="color: aliceblue">Activo</span>
                                            @else
                                                <span class="badge bg-danger" style="color: aliceblue">Inactivo</span>
                                            @endif
                                        </td>
                                        <td>
                                            
                                            <form action="{{ route('pacientes.edit', ['paciente' => $paciente]) }}" method="get" style="display: inline-block;">
                                                <button type="submit" class="btn btn-secondary btn-sm " onclick="">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </form>
                                                @if ($paciente->estado == 1)
                                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirnModal-{{ $paciente->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#confirnModal-{{ $paciente->id }}">
                                                        <i class="fas fa-undo"></i>
                                                    </button>
                                                @endif
                                            
                                        </td>
                                    </tr>

                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="confirnModal-{{ $paciente->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Mensaje de confirmación</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{ $paciente->estado == 1 ? '¿Está seguro de que desea eliminar este paciente?' : '¿Está seguro de que desea activar este paciente?' }}
                                        
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            
                                            @if ($paciente->estado == 1)
                                                <form action="{{ route('pacientes.destroy', ['paciente' => $paciente]) }}" method="post" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                                </form>
                                            @else
                                                <form action="{{ route('pacientes.destroy', ['paciente' => $paciente]) }}" method="post" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-success">Confirmar</button>
                                                </form>
                                            @endif
                                        </div>
                                        </div>
                                    </div>
                                    </div>

                                    @endforeach
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
</div>
@endsection

@push('js')

<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script src="{{ asset('js/demo/datatables-simple-demo.js') }}" type="text/javascript"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

@endpush