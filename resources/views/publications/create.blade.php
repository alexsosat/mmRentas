@extends('layouts.app')
@section('content')
    <div class="container mb-4">
        <div class="row">
            <div class="col-md-12">
                <h1><strong>Crear Publicación</strong></h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="login-clean">
                    <form method="post" action="{{ route('publication.store') }}" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <input type="hidden" name="user_id" value='{{ Auth::user()->id }}'>

                        <div class="form-group">
                            <label class="font-weight-bold" for="title">Título de la publicación<br></label>
                            <input class="form-control rounded-lg @error('title') is-invalid @enderror" type="text"
                                name="title" required value="{{ old('title') }}" autofocus>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="address">Dirección<br></label>
                            <input class="form-control rounded-lg @error('address') is-invalid @enderror" type="text"
                                name="address" required value="{{ old('address') }}" autofocus>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="price">Precio</label>
                            <input class="form-control rounded-lg @error('price') is-invalid @enderror" type="text"
                                name="price" value="{{ old('price') }}" autofocus>
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class=" form-group row">
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold" for="rooms">Cantidad de Habitaciones</label>
                                <input class="d-none form-control rounded-lg @error('rooms') is-invalid @enderror"
                                    id="dropdown-room-input" type="text" name="rooms" required autofocus
                                    value="{{ old('rooms') }}">
                                @error('rooms')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="dropdown">
                                    <button
                                        class="btn btn-primary dropdown-toggle btn-block text-left dropdown-button-filter"
                                        aria-expanded="false" data-toggle="dropdown" id="dropdown-room-val" type="button">
                                        @if (old('rooms') != null)
                                            {{ old('rooms') }}

                                        @else
                                            Escoge el número de habitaciones
                                        @endif
                                    </button>
                                    <div class="dropdown-menu" id="dropdown-room">
                                        @foreach (range(0, 8) as $i)
                                            <a class="dropdown-item" href="#"
                                                onclick="event.preventDefault();changeDropdownText('dropdown-room-val','{{ $i }}','dropdown-room-input',{{ $i }})">{{ $i }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="font-weight-bold" label="restrooms">Cantidad de Baños</label>
                                <input class="d-none form-control rounded-lg @error('restrooms') is-invalid @enderror"
                                    id="dropdown-restrooms-input" type="text" name="restrooms" required
                                    value="{{ old('restrooms') }}" autofocus>
                                @error('restrooms')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="dropdown">
                                    <button
                                        class="btn btn-primary dropdown-toggle btn-block text-left dropdown-button-filter"
                                        aria-expanded="false" data-toggle="dropdown" id="dropdown-restrooms-val"
                                        type="button">
                                        @if (old('restrooms') != null)
                                            {{ old('restrooms') }}

                                        @else
                                            Escoge la cantidad de baños
                                        @endif
                                    </button>
                                    <div class="dropdown-menu dropdown-restrooms">
                                        @foreach (range(1, 8) as $i)
                                            <a class="dropdown-item" href="#"
                                                onclick="event.preventDefault();changeDropdownText('dropdown-restrooms-val','{{ $i }}','dropdown-restrooms-input',{{ $i }})">{{ $i }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="description">Descripción</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" rows="10"
                                name="description" value="{{ old('description') }}" autofocus></textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group files color mb-4">
                            <div>
                                <label class="font-weight-bold" for="files[]">Imágenes (máximo 5 imágenes)</label>
                                <input class="form-control-file @error('files.*') is-invalid @enderror" type="file" multiple
                                    name="files[]" value="{{ old('files') }}" autofocus>
                                @error('files.*')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block search-button mb-3" type="submit">Publicar recurso</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
