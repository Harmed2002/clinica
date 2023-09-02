@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
            @if(session('status'))
                <div class="card">
                    <div class="card-header">
                        Aviso Importante!
                    </div>

                    <div class="card-body">
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    </div>
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success" id="success-message">
                    {{ session('success') }}
                </div>
            @endif
            <div>TABLA DE POKEMONS</div>
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearModal">Crear Nuevo</button>
                </div>
                <div class="card-body">
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Ataque</th>
                                <th scope="col">Defensa</th>
                                <th scope="col">Velocidad</th>
                                <th scope="col">Imagen</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($poks as $pok)
                                <tr>
                                    <td>{{ $pok['id'] }}</td>
                                    <td>{{ $pok['name'] }}</td>
                                    <td>{{ $pok['attack'] }}</td>
                                    <td>{{ $pok['defense'] }}</td>
                                    <td>{{ $pok['speed'] }}</td>
                                    {{-- <td><img src="{{ Storage::get($pok['image']) }}" width="100" name="photo" id="photo" alt = "{{ $pok['image'] }}"></td> --}}
                                    <td><img src="{{ asset('storage/' . $pok['image']) }}" width="100" name="photo" id="photo" alt = "{{ $pok['image'] }}"></td>
                                    <td>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editarModal{{ $pok['id'] }}">Editar</button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarModal{{ $pok['id'] }}">Eliminar</button>
                                    </td>
                                </tr>

                                <!-- Modal para edición -->
                                <div class="modal fade" id="editarModal{{ $pok['id'] }}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edición de Pókemon # {{ $pok['id'] }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <form id="frmEdicion" action="{{ route('update', $pok['id']) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-12 col-sm-12 mb-3">
                                                            <label for="name" class="form-label">Nombre</label>
                                                            <input type="text" class="form-control" id="name" name="name" value="{{ $pok['name'] }}">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 col-sm-4 mb-3">
                                                            <label for="attack" class="form-label">Ataque</label>
                                                            <input type="number" class="form-control" id="attack" name="attack" value="{{ $pok['attack'] }}" >
                                                        </div>
                                                        <div class="col-12 col-sm-4 mb-3">
                                                            <label for="defense" class="form-label">Defensa</label>
                                                            <input type="number" class="form-control" id="defense" name="defense" value="{{ $pok['defense'] }}" >
                                                        </div>
                                                        <div class="col-12 col-sm-4 mb-3">
                                                            <label for="speed" class="form-label">Velocidad</label>
                                                            <input type="number" class="form-control" id="speed" name="speed" value="{{ $pok['speed'] }}" >
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 col-sm-12 mb-3">
                                                            <label for="imagen" class="form-label">Imagen</label>
                                                            <input type="text" class="form-control" id="imagen" name="imagen">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        {{-- <a href="{{ route('update', ['id' => $pok['id']]) }}" class="btn btn-primary">Guardar Cambios</a> --}}
                                                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Guardar Cambios</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal para confirmar la eliminación -->
                                <div class="modal fade" id="eliminarModal{{ $pok['id'] }}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmar Eliminación de Pókemon # {{ $pok['id'] }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Estás seguro de que deseas eliminar este registro?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <a href="{{ route('delete', ['id' => $pok['id']]) }}" class="btn btn-danger">Eliminar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Modal para creación -->
                    <div class="modal fade" id="crearModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Creación de Pókemon</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <form id="frmCreacion" action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12 col-sm-12 mb-3">
                                                <label for="name" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="name" name="name">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-4 mb-3">
                                                <label for="attack" class="form-label">Ataque</label>
                                                <input type="number" class="form-control" id="attack" name="attack" >
                                            </div>
                                            <div class="col-12 col-sm-4 mb-3">
                                                <label for="defense" class="form-label">Defensa</label>
                                                <input type="number" class="form-control" id="defense" name="defense" >
                                            </div>
                                            <div class="col-12 col-sm-4 mb-3">
                                                <label for="speed" class="form-label">Velocidad</label>
                                                <input type="number" class="form-control" id="speed" name="speed" >
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-12 mb-3">
                                                <label for="image" class="form-label">Imagen</label>
                                                <input type="file" class="form-control" name="image" id="image" accept="image/*" >
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Guardar Cambios</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
@endsection
