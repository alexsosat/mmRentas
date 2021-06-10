@extends('layouts.app')

@section('custom_js')
    <script src="{{ asset('js/dropdowns.js') }}"></script>
@endsection

@section('content')


    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-3"><strong>Buscar Departamento</strong></h1>
                <h4 class="text-center">Encuentra el departamento ideal conforme a tus necesidades</h4>
            </div>
        </div>
    </div>
    <section class="search-section mb-5">
        <div class="container">
            <form role="form" action="{{ route('results') }}" method="GET">
                <div class="row mb-4">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="d-flex w-100 align-items-center justify-content-center flex-column flex-sm-row">

                            <input class="form-control rounded w-100 form-control" type="text" placeholder="Palabras clave"
                                name="key_words" value="{{ old('key_words') }}">
                            <input class="d-none" type="text" name="rooms" id="dropdown-room-input"
                                value="{{ old('rooms') }}">
                            <input class="d-none" type="text" name="bathrooms" id="dropdown-bathroom-input"
                                value="{{ old('bathrooms') }}">
                            <div class="my-2 d-block d-sm-none"></div>
                            <div class="mx-3 d-none d-sm-block"></div><button
                                class="btn btn-primary search-button btn-block" type="submit">Buscar</button>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex mb-3">
                        <span class="w-100 text-center text-grey">Ajustes avanzados</span>
                    </div>
                    <div class="col-3">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle btn-block text-left dropdown-button-filter"
                                aria-expanded="false" data-toggle="dropdown" id="dropdown-room-val" type="button">
                                @if (old('rooms') != null)
                                    {{ old('rooms') }}

                                @else
                                    Cantidad de habitaciones
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
                    <div class="col-3">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle btn-block text-left dropdown-button-filter"
                                aria-expanded="false" data-toggle="dropdown" id="dropdown-bathroom-val" type="button">
                                @if (old('bathroom') != null)
                                    {{ old('bathroom') }}

                                @else
                                    Cantidad de baños
                                @endif
                            </button>
                            <div class="dropdown-menu" id="dropdown-bathroom">
                                @foreach (range(0, 8) as $i)
                                    <a class="dropdown-item" href="#"
                                        onclick="event.preventDefault();changeDropdownText('dropdown-bathroom-val','{{ $i }}','dropdown-bathroom-input',{{ $i }})">{{ $i }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <input class="form-control rounded w-100 form-control filter-input" type="text"
                            placeholder="Precio mímimo" name="min_price" value="{{ old('min_price') }}">
                    </div>
                    <div class="col-3">
                        <input class="form-control rounded w-100 form-control filter-input" type="text"
                            placeholder="Precio máximo" name="max_price" value="{{ old('max_price') }}">
                    </div>
                </div>
            </form>
        </div>
    </section>


    <!--foreach-->

    @foreach ($Publications as $Publication)

        @if ($loop->index % 3 === 0)
            <div class="container mb-3">
                <div class="row">
        @endif

        <div class="col-md-4 mb-3">
            <div class="recent-item"><a class="search-item" href="{{ route('publication.details', $Publication->id) }}">
                    <div class="recent-item-img"
                        style="background: url(/publication/{{ $Publication->id }}/thumbnail) center / cover no-repeat;">
                    </div>
                    <h4 class="p-3 font-weight-bold text-center">{{ $Publication->title }}</h4>
                    <div class="d-flex pb-2 justify-content-center">
                        <div class="result-card-item-filter d-flex align-items-center">
                            <i class="las la-bed icon mr-3"></i>
                            <span>{{ $Publication->rooms }}</span>
                        </div>
                        <div class="result-card-item-filter d-flex align-items-center">
                            <i class="las la-toilet icon"></i>
                            <span>{{ $Publication->bathrooms }}</span>
                        </div>
                    </div>
                </a></div>
        </div>

        @if ($loop->index === 2 || $loop->index === 5 || $loop->index === 8 || $loop->index === 11)
            </div>
            </div>
        @endif

    @endforeach
    <!--endforeach-->


@endsection
