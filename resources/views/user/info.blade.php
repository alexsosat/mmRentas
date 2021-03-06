@extends('layouts.app')

@section('custom_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js" defer></script>
    <script src="{{ asset('js/phone_mask.js') }}" defer></script>
    <script src="{{ asset('js/phone_input.js') }}" defer></script>
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <x-user-dashboard user="{{ $User->id }}"> </x-user-dashboard>
            <div class="col col-12 col-lg-8">
                @if (\Session::has('success'))
                    <div class="alert alert-success">

                        {!! \Session::get('success') !!}

                    </div>
                @endif
                <div class="user-info-pane">
                    <div class="mb-3">
                        <h2 class="text-grey">Información General</h2>
                        <div class="horizontal-separator w-100"></div>
                        <form method="post" action="{{ route('user.info.update', $User->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class=" form-group">
                                <label for="name">Nombre(s):</label>
                                <input id="name" class="form-control form-control @error('name') is-invalid @enderror"
                                    type="text" name="name" value="{{ $User->name }}" required autocomplete="name"
                                    autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="surname">Apellido(s):</label>
                                <input id="surname" class="form-control form-control @error('surname') is-invalid @enderror"
                                    type="text" name="surname" value="{{ $User->surname }}" required
                                    autocomplete="surname" autofocus>
                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Correo Electrónico:</label>
                                <input id="email" class="form-control form-control @error('email') is-invalid @enderror"
                                    type="email" name="email" value={{ $User->email }} required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="mr-3" for="user_image">Imagen de perfil:</label>
                                <div class="user-img-thumb mb-3"
                                    style="background: url({{ route('user.profile_image', $User->id) }}) center / cover no-repeat;">
                                </div>
                                <input class="form-control-file" type="file" name="user_image">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary search-button" type="submit">Guardar cambios</button>
                            </div>
                        </form>

                    </div>

                    <div class="mb-5">
                        <h2 class="text-grey">Información de contacto</h2>
                        <div class="horizontal-separator w-100"></div>
                        @if (\Session::has('bad_url'))
                            <div class="alert alert-danger">

                                {!! \Session::get('bad_url') !!}

                            </div>
                        @endif
                        <form method="post" onsubmit="process(event)" id="contact-form"
                            action="{{ route('user.contact.update', $User->id) }}">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="phone">Teléfono</label>
                                <input class="form-control form-control @error('phone') is-invalid @enderror" type="tel"
                                    name="phone" autocomplete="phone" id="phone" value="{{ $User->phone }}">

                                <input class="d-none" type="text" name="phone_international" id="phone_international">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="facebook_url">Liga de facebook</label>
                                <input class="form-control form-control @error('facebook_url') is-invalid @enderror"
                                    type="text" name="facebook_url" value="{{$User->facebook_url}}" autocomplete="facebook_url">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary search-button" type="submit">Guardar cambios</button>
                            </div>
                        </form>
                    </div>
                    <div class="mb-5">
                        <h2 class="text-grey">Seguridad</h2>
                        <div class="horizontal-separator w-100"></div>
                        @if ($errors->any())
                            <div class="alert alert-danger">

                                {{ $errors->first() }}

                            </div>
                        @endif
                        <form method="post" action="{{ route('user.password.update', $User->id) }}">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="old_password">Antigua contraseña</label>
                                <input class="form-control form-control @error('old_password') is-invalid @enderror"
                                    type="password" name="old_password" required autocomplete="old_password">
                            </div>
                            <div class="form-group">
                                <label for="password">Nueva contraseña</label>
                                <input class="form-control form-control @error('password') is-invalid @enderror"
                                    type="password" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password-confirm">Repetir contraseña</label>
                                <input class="form-control " id="password-confirm" type="password"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary search-button" type="submit">Guardar cambios</button>
                            </div>
                        </form>
                    </div>

                    <div>
                        <h2 class="text-grey">Zona de Peligro</h2>
                        <div class="horizontal-separator w-100"></div>
                        <span class="mr-3">
                            Eliminar Usuario:
                        </span>
                        <a class="btn-borrar mb-2" href="#"
                            onclick="event.preventDefault();if(confirm('¿Estas seguro de eliminar el usuario?\nEsta acción es permanente')){document.getElementById('delete-pub-{{ $User->id }}').submit();}">
                            <i class=" fas fa-trash mr-1"></i>
                            <span>Eliminar</span>

                            <form id="delete-pub-{{ $User->id }}" action="{{ route('user.destroy', $User->id) }}"
                                method="POST" class="d-none">
                                @csrf
                                @method('delete')
                            </form>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
