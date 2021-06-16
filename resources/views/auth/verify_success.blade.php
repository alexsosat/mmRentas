@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dirección de correo confirmada') }}</div>

                    <div class="card-body">

                        {{ __('Tu cuenta de correo electrónico ha sido validada, ahora ya puedes publicar tus departamentos para rentar') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
