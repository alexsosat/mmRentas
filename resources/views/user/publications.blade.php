@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <x-user-dashboard user="{{ $User->id }}"> </x-user-dashboard>
            <div class="col col-md-8">
                <div class="user-pub-pane">
                    <div class="mb-3">
                        <h2 class="text-grey">Tus publicaciones</h2>
                        <div class="horizontal-separator w-100"></div>
                    </div>
                    <div class="d-flex justify-content-end mb-3">
                        <a class="btn btn-primary add-button" role="button"
                            href="{{ route('user.publication.create', $User->id) }}">
                            <i class="fas fa-plus mr-1"></i> Añadir publicación
                        </a>
                    </div>
                    <!-- de aqui -->
                    @forelse ($User->Publications as $Publication)
                        <div class="result-card-item text-left d-sm-flex mb-4">
                            <div class="result-img"
                                style="background: url(/publications/images/{{ $Publication->id }}) center / cover no-repeat;">
                            </div>
                            <div class="result-card-content d-flex flex-column">
                                <div class="d-sm-flex">
                                    <div class="mb-3 mb-sm-0 w-100">
                                        <p class="result-item-title">{{ $Publication->title }}<br></p>
                                        <div class="d-flex">
                                            <div class="result-card-item-filter"><i
                                                    class="fas fa-cubes icon"></i><span>{{ $Publication->dimensionId }}</span>
                                            </div>
                                            <div class="result-card-item-filter"><i
                                                    class="far fa-file icon"></i><span>{{ $Publication->formatId }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <p class="limited-text">{{ $Publication->desc }}<br>
                                    </p>
                                </div>
                                <div class="horizontal-separator"></div>
                                <div class="d-flex justify-content-around flex-column flex-sm-row">
                                    <a class="btn-ver mb-2"
                                        href="{{ route('publications.detailPage', $Publication->id) }}">
                                        <i class="fas fa-eye mr-1"></i>
                                        <span>Ver</span>
                                    </a>
                                    <a class="btn-editar mb-2" href="{{ route('publications.edit', $Publication->id) }}">
                                        <i class="fas fa-edit mr-1"></i>
                                        <span>Editar</span>
                                    </a>
                                    <a class="btn-borrar mb-2" href="#"
                                        onclick="event.preventDefault();if(confirm('¿Estas seguro de eliminar esta publicación?\nEsta acción no se podrá deshacer')){document.getElementById('delete-pub-{{ $Publication->id }}').submit();}">
                                        <i class=" fas fa-trash mr-1"></i>
                                        <span>Eliminar</span>

                                        <form id="delete-pub-{{ $Publication->id }}"
                                            action="{{ route('publications.delete', $Publication->id) }}" method="POST"
                                            class="d-none">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="container empty-pubs">
                            <div class="row mb-3 h-100">
                                <div class="col-md-12 my-auto">
                                    <h3 class="text-center font-weight-bolder"> Vaya parece que no tienes recursos
                                        publicados,
                                        comienza creando
                                        tu primera publicación dando click al botón de arriba
                                    </h3>
                                </div>
                            </div>
                        </div>
                </div>

                @endforelse
                <!-- hasta aqui -->

                <div class="d-flex justify-content-end">
                    <nav>
                        <!-- aqui van la paginacion -->
                    </nav>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
