@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <x-user-dashboard user="{{ $User->id }}"> </x-user-dashboard>
            <div class="col col-12 col-lg-8">
                <div class="user-pub-pane mb-4">
                    <div class="mb-3">
                        <h2 class="text-grey">Tus publicaciones</h2>
                        <div class="horizontal-separator w-100"></div>
                    </div>
                    <div class="d-flex justify-content-end mb-3">
                        <a class="btn btn-primary add-button" role="button" href="{{ route('publication.create') }}">
                            <i class="fas fa-plus mr-1"></i> Añadir publicación
                        </a>
                    </div>
                    <!-- de aqui -->
                    @forelse ($Publications as $Publication)
                        <x-publication-card pub="{{ $Publication->id }}" editable="true" />
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


            </div>
            <div class="d-flex justify-content-end">
                <nav>
                    {{ $Publications->links('pagination::bootstrap-4') }}
                </nav>
            </div>
        </div>
    </div>
    </div>

@endsection
