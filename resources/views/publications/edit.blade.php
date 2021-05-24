@extends('layouts.app')
@section('content')
    <div class="container mb-4">
        <div class="row">
            <div class="col-md-12">
                <h1><strong>Editar Publicación</strong></h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="login-clean">
                    <form method="post" action="{{ route('publication.update', $Publication->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <input type="hidden" name="user_id" value='{{ Auth::user()->id }}'>

                        <div class="form-group">
                            <label class="font-weight-bold" for="title">Título de la publicación<br></label>
                            <input class="form-control rounded-lg @error('title') is-invalid @enderror" type="text"
                                name="title" required value="{{ $Publication->title }}" autofocus>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="address">Dirección<br></label>
                            <input class="form-control rounded-lg @error('address') is-invalid @enderror" type="text"
                                name="address" required value="{{ $Publication->address }}" autofocus>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="price">Precio</label>
                            <input class="form-control rounded-lg @error('price') is-invalid @enderror" type="text"
                                name="price" value="{{ $Publication->price }}" autofocus>
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
                                    value="{{ $Publication->rooms }}">
                                @error('rooms')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="dropdown">
                                    <button
                                        class="btn btn-primary dropdown-toggle btn-block text-left dropdown-button-filter"
                                        aria-expanded="false" data-toggle="dropdown" id="dropdown-room-val" type="button">
                                        {{ $Publication->rooms }}
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
                                    value="{{ $Publication->bathrooms }}" autofocus>
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
                                        {{ $Publication->bathrooms }}
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
                                name="description" autofocus>{{ $Publication->description }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>



                        <div class="form-group files-edit color mb-4">
                            <div>
                                <label class="font-weight-bold" for="files[]">Imágenes (máximo 5 imágenes)</label>
                                <div class="d-flex">
                                    @foreach ($Publication->images as $Image)
                                        <div class="publication-img-thumb mb-3 mr-3"
                                            onclick="event.preventDefault();if(confirm('¿Estas seguro de eliminar esta imagen?\nEsta acción es permanente')){document.getElementById('delete-img-{{ $Image->id }}').submit();}"
                                            style="background: url({{ route('publication.image', ['image' => $Image->id, 'publication' => $Publication->id]) }}) center / cover no-repeat;">
                                        </div>
                                    @endforeach
                                    <div class="d-flex flex-column justify-content-center align-items-center delete-all-img"
                                        onclick="event.preventDefault();if(confirm('¿Estas seguro de eliminar todas las imágenes?\nEsta acción es permanente')){document.getElementById('delete-all-img').submit();}">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                        <span class="text-center">Eliminar todas</span>
                                    </div>
                                </div>
                                <input class="form-control-file @error('files.*') is-invalid @enderror" type="file" multiple
                                    name="files[]" autofocus>
                                @error('files.*')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block search-button mb-3" type="submit">Actualizar
                            publicación</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($Publication->images as $Image)
        <form id="delete-img-{{ $Image->id }}"
            action="{{ route('publication.image.destroy', ['image' => $Image->id, 'publication' => $Publication->id]) }}"
            method="post" class="d-none">
            @csrf
            @method('delete')
        </form>

    @endforeach

    <form id="delete-all-img" action="{{ route('publication.images.all.destroy', $Publication->id) }}" method="post"
        class="d-none">
        @csrf
        @method('delete')
    </form>



@endsection
