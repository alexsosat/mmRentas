@extends('layouts.app')
@section('content')

    @if (!$Publication->isActive)
        <div class="container mb-3">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger">

                        Esta publicación ha sido pausada por el rentero, vuelva a revisar más tarde

                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container mb-3">
        <div class="row">
            <div class="col-12">
                <h1 class="font-weight-bold">{{ $Publication->title }}<br></h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-12">


                <!-- prueba de carousel -->

                <div id="slider">
                    <div id="myCarousel" class="carousel slide">
                        <!-- main slider carousel items -->
                        <div class="carousel-inner">

                            @forelse ($Publication->images as $Image)
                                <div class="carousel-item @if ($loop->index == 0) active @endif" data-slide-number="{{ $loop->index }}">
                                    <div class="d-block slide-image"
                                        style="background:url('{{ route('publication.image', ['image' => $Image->id, 'publication' => $Publication->id]) }}')center / contain no-repeat, #F3F3FA;">
                                    </div>
                                </div>
                            @empty
                                <div class="carousel-item active">
                                    <div class="d-block slide-image"
                                        style="background:url('{{ asset('img/defaults/publication.png') }}')center / contain no-repeat, #F3F3FA;">
                                    </div>
                                </div>
                            @endforelse



                            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>

                        </div>
                        <!-- main slider carousel nav controls -->
                        <ul class="carousel-indicators list-inline mx-auto border px-2">
                            @forelse ($Publication->images as $Image)
                                <li class="list-inline-item @if ($loop->index == 0) active @endif">
                                    <a id="carousel-selector-{{ $loop->index }}" class="@if ($loop->index == 0) selected @endif"
                                        data-slide-to="{{ $loop->index }}"
                                        data-target="#myCarousel">
                                        <div class="d-block slide-control"
                                            style="background:url('{{ route('publication.image', ['image' => $Image->id, 'publication' => $Publication->id]) }}') center / cover no-repeat;">
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li data-target="#myCarousel" data-slide-to="0" class="active  mb-3 mr-3">
                                    <div class="d-block slide-control"
                                        style="background:url('{{ asset('img/defaults/publication.png') }}') center / cover no-repeat;">
                                    </div>
                                </li>
                            @endforelse


                        </ul>
                    </div>

                    <!--/main slider carousel-->
                </div>

                <!-- fin de prueba -->

                <div class="d-flex mx-3 rounded  mb-5 justify-content-between secondary-color-background">
                    <div class="d-flex flex-column p-3">
                        <h3>Precio</h3>
                        <span class="h4 font-weight-bold">${{ $Publication->price }}</span>
                    </div>
                    <div class="d-flex align-items-center p-3 ">
                        <div class="d-flex align-items-center mr-3">
                            <i class="las la-bed icon icon-blue"></i>
                            <span class="font-weight-bolder">{{ $Publication->rooms }}</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="las la-toilet icon icon-blue"></i>
                            <span class="font-weight-bolder">{{ $Publication->bathrooms }}</span>
                        </div>
                    </div>


                    <!-- this is invisible do not touch or think in a better way for design -->
                    <div class="d-none d-flex align-items-center p-3 invisible">
                        <div class="d-flex align-items-center mr-3">

                            <span class="font-weight-bolder">Hola</span>
                        </div>
                        <div class="d-flex align-items-center">

                            <span class="font-weight-bolder">Mundo</span>
                        </div>
                    </div>

                    <!-- Here ends the invisible section -->

                </div>
                <div>
                    <p>{{ $Publication->description }}<br></p>
                </div>
            </div>



            <div class="col col-12 col-md-4">
                <div class="secondary-color-background rounded d-flex flex-column align-items-center p-3 mb-3">
                    <div class="rounded-circle big-user-circle mb-3"
                        style="background: url({{ route('user.profile_image', $Publication->user->id) }}) center/ cover no-repeat;">
                    </div>
                    <h4 class="mb-1">{{ $Publication->user->full_name }}<br></h4>
                </div>
                <div>
                    <a class="btn btn-primary btn-lg btn-download w-100 btn-big @if (!$Publication->isActive) disabled @endif " data-toggle="modal"
                        data-target="#UserContactModal"
                        role="button">Contactar</a>

                    <!-- Modal -->
                    <div class="modal fade" id="UserContactModal" tabindex="-1" role="dialog"
                        aria-labelledby="UserContactModalTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="UserContactModalTitle">Contacta al rentero</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="las la-envelope icon icon-blue"></i>
                                            <span>{{ $Publication->user->email }}</span>
                                            <a href="mailto:{{ $Publication->user->email }}" target="_blank"
                                                class="btn btn-primary ml-auto">Enviar correo</a>
                                        </div>
                                        @if ($Publication->user->phone != null)
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="las la-phone icon icon-blue"></i>
                                                <span>{{ $Publication->user->phone }}</span>
                                                <a href="tel:{{ $Publication->user->phone }}" target="_blank"
                                                    class="btn btn-primary ml-auto">Llamar</a>
                                            </div>

                                            <div class="d-flex align-items-center mb-3">
                                                <i class="lab la-whatsapp icon icon-blue"></i>
                                                <span>{{ $Publication->user->phone }}</span>
                                                <a href="https://wa.me/521{{ $Publication->user->whatsapp_phone }}"
                                                    target="_blank" class="btn btn-primary ml-auto">Mandar mensaje</a>
                                            </div>
                                        @endif

                                        @if ($Publication->user->facebook != null)
                                            <div class="d-flex align-items-center mb-3">
                                                <i class="lab la-facebook-messenger icon icon-blue"></i>
                                                <span>{{ $Publication->user->facebook }}</span>
                                                <a href="https://m.me/{{ $Publication->user->facebook_id }}"
                                                    target="_blank" class="btn btn-primary ml-auto">Mandar mensaje</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar
                                        ventana</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
