 @extends('layouts.app')

 @section('custom_js')
     <script src="{{ secure_asset('js/dropdowns.js') }}"></script>
     <script src="{{ secure_asset('js/clear_filters.js') }}"></script>
 @endsection

 @section('content')
     <div class="container">
         <div class="row">
             <div class="col col-lg-4 d-lg-block">
                 <div class="filters rounded-lg">
                     <form role="form" action="{{ route('results') }}" method="GET" id="filter-form">
                         <div class="filter-div">
                             <p class="filter-title">Palabras clave</p>
                             <input class="form-control rounded w-100 form-control" type="text" placeholder="Palabras clave"
                                 id="key_words" name="key_words" value="{{ $request->key_words }}">
                         </div>
                         <div class="filter-div">
                             <p class="filter-title">Habitaciones</p>
                             <div class="dropdown">
                                 <input class="d-none" type="text" name="rooms" id="dropdown-room-input"
                                     value="{{ $request->rooms }}">
                                 <button class="btn btn-primary dropdown-toggle dropdown-button-filter w-100"
                                     id="dropdown-room-val" aria-expanded="false" data-toggle="dropdown" type="button">
                                     @if ($request->rooms != null)
                                         {{ $request->rooms }}
                                     @else
                                         Elige el número de habitaciones
                                     @endif
                                 </button>
                                 <div class="dropdown-menu">
                                     @foreach (range(0, 8) as $i)
                                         <a class="dropdown-item" href="#"
                                             onclick="event.preventDefault();changeDropdownText('dropdown-room-val','{{ $i }}','dropdown-room-input',{{ $i }})">{{ $i }}</a>
                                     @endforeach
                                 </div>
                             </div>
                         </div>
                         <div class="filter-div">
                             <p class="filter-title">Baños</p>
                             <div class="dropdown">
                                 <input type="text" name="bathrooms" id="dropdown-bathroom-input" class="d-none"
                                     value="{{ $request->bathrooms }}">
                                 <button class="btn btn-primary dropdown-toggle dropdown-button-filter w-100"
                                     id="dropdown-bathroom-val" aria-expanded="false" data-toggle="dropdown" type="button">
                                     @if ($request->bathrooms != null)
                                         {{ $request->bathrooms }}
                                     @else
                                         Elige el número de baños
                                     @endif
                                 </button>
                                 <div class="dropdown-menu">
                                     @foreach (range(0, 8) as $i)
                                         <a class="dropdown-item" href="#"
                                             onclick="event.preventDefault();changeDropdownText('dropdown-bathroom-val','{{ $i }}','dropdown-bathroom-input',{{ $i }})">{{ $i }}</a>
                                     @endforeach
                                 </div>
                             </div>
                         </div>
                         <div class="filter-div">
                             <p class="filter-title">Precio mínimo</p>
                             <input class="form-control rounded w-100 form-control" type="text" placeholder="Precio mímimo"
                                 name="min_price" id="min_price" value="{{ $request->min_price }}">
                         </div>
                         <div class="filter-div">
                             <p class="filter-title">Precio máximo</p>
                             <input class="form-control rounded w-100 form-control" type="text" placeholder="Precio máximo"
                                 name="max_price" id="max_price" value="{{ $request->max_price }}">
                         </div>
                         <div class="text-right">
                             <button class="btn btn-secondary" onclick="clearForm()" type="button"> Quitar Filtros</button>
                             <button class="btn btn-primary" type="submit">Aplicar filtros</button>
                         </div>
                     </form>
                 </div>
             </div>
             <div class="col col-12 col-lg-8">
                 <div class="d-flex section"><span id="result-coinc" class="mr-auto">{{ $Publications->total() }}
                         Coincidencias con tu búsqueda.</span>
                     <div class="dropdown"><button class="btn btn-primary dropdown-toggle dropdown-button-filter d-none"
                             aria-expanded="false" data-toggle="dropdown" id="dropdown-sort-filter" type="button"
                             style="width: 125px;">Dropdown </button>
                         <div class="dropdown-menu"><a class="dropdown-item" href="#">Ascendiente</a><a
                                 class="dropdown-item" href="#">Descendiente</a></div>
                     </div>
                 </div>
                 <!-- Aqui -->
                 @forelse ($Publications as $Publication)
                     <x-publication-card pub="{{ $Publication->id }}" editable="false" />
                 @empty
                     <div class="container empty-pubs">
                         <div class="row mb-3 h-100">
                             <div class="col-md-12 my-auto">
                                 <h3 class="text-center font-weight-bolder"> Ningun departamento satisface tus requsitos,
                                     prueba intentando con otros parámetros
                                 </h3>
                             </div>
                         </div>
                     </div>
             </div>
             @endforelse

             <!-- Hasta Aqui -->

             <div class="d-flex justify-content-end mb-5">
                 <nav>
                     {{ $Publications->links('pagination::bootstrap-4') }}
                 </nav>
             </div>
         </div>
     </div>
     </div>
 @endsection
