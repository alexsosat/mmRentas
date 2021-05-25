@extends('layouts.app')
@section('content')
    <div class="container mb-3">
        <div class="row">
            <div class="col-md-12">
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

                <div class="d-flex mx-3 justify-content-center mb-5">
                    <div class="d-flex align-items-center mr-3"><i class="las la-bed icon icon-blue"></i><span
                            class="font-weight-bolder">{{ $Publication->rooms }}</span></div>
                    <div class="d-flex align-items-center"><i class="las la-toilet icon icon-blue"></i><span
                            class="font-weight-bolder">{{ $Publication->bathrooms }}</span></div>
                </div>
                <div>
                    <p>{{ $Publication->description }}<br></p>
                </div>
            </div>
            <div class="col col-12 col-md-4">
                <div class="user-detail-banner rounded d-flex flex-column align-items-center p-3 mb-3">
                    <div class="rounded-circle big-user-circle mb-3"
                        style="background: url({{ route('user.profile_image', $Publication->user->id) }}) center/ cover no-repeat;">
                    </div>
                    <h4 class="mb-1">{{ $Publication->user->full_name }}<br></h4>
                    <span>{{ $Publication->user->email }}</span>
                </div>
                <div><a class="btn btn-primary btn-lg btn-download w-100 btn-big" href="#" target="_blank"
                        role="button">Contactar</a></div>
            </div>
        </div>
    </div>
@endsection
