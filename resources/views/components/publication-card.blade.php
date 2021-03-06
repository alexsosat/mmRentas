 @if ($editable == 'false')
     <div class="result-link" onclick="window.location='{{ route('publication.details', $Publication->id) }}'">
 @endif


 <div class="result-card-item text-left d-sm-flex mb-4">
     <div class="result-img"
         style="background: url(/publication/{{ $Publication->id }}/thumbnail) center / cover no-repeat;">
     </div>
     <div class="result-card-content d-flex flex-column">
         <div class="d-md-flex">
             <div class="mb-3 mb-md-0">
                 <p class="result-item-title">{{ $Publication->title }}</p>
                 <div class="d-flex">
                     <div class="d-flex justify-content-center  result-card-item-filter">
                         <i class="las la-bed icon"></i>
                         <span>{{ $Publication->rooms }}</span>
                     </div>
                     <div class="d-flex justify-content-center result-card-item-filter">
                         <i class="las la-toilet icon"></i>
                         <span>{{ $Publication->bathrooms }}</span>
                     </div>
                 </div>
             </div>
             <div class="vertical-separator d-none d-md-block"></div>
             <div>
                 <p class="result-card-pago-title">Pago Aproximado</p>
                 <p class="result-card-item-cost">${{ $Publication->price }}</p>
             </div>
         </div>
         <div>
             <p class="limited-text">{{ $Publication->description }}<br>
             </p>
         </div>
         <div class="horizontal-separator"></div>

         @if ($editable == 'true')
             <div class="d-flex justify-content-around flex-column flex-sm-row">
                 <a class="btn-ver mb-2" href="{{ route('publication.details', $Publication->id) }}">
                     <i class="fas fa-eye mr-1"></i>
                     <span>Ver</span>
                 </a>
                 <a class="btn-editar mb-2" href="{{ route('publication.edit', $Publication->id) }}">
                     <i class="fas fa-edit mr-1"></i>
                     <span>Editar</span>
                 </a>
                 <a class="btn-pausar mb-2" href="#"
                     onclick="event.preventDefault();if(confirm('??Estas seguro de realizar esta acci??n?')){document.getElementById('pause-pub-{{ $Publication->id }}').submit();}">

                     @if ($Publication->isActive)
                         <i class="fas fa-pause mr-1"></i>
                         <span>Pausar</span>
                     @else
                         <i class="fas fa-play mr-1"></i>
                         <span>Reanudar</span>
                     @endif


                     <form id="pause-pub-{{ $Publication->id }}"
                         action="{{ route('publication.pause', $Publication->id) }}" method="POST" class="d-none">
                         @csrf
                         @method('patch')
                     </form>
                 </a>
                 <a class="btn-borrar mb-2" href="#"
                     onclick="event.preventDefault();if(confirm('??Estas seguro de eliminar esta publicaci??n?\nEsta acci??n no se podr?? deshacer')){document.getElementById('delete-pub-{{ $Publication->id }}').submit();}">
                     <i class=" fas fa-trash mr-1"></i>
                     <span>Eliminar</span>

                     <form id="delete-pub-{{ $Publication->id }}"
                         action="{{ route('publication.destroy', $Publication->id) }}" method="POST" class="d-none">
                         @csrf
                         @method('delete')
                     </form>
                 </a>
             </div>

         @else
             <div class="d-flex align-items-center">
                 <span class="result-card-item-published">Publicado por:</span>
                 <div class="d-flex align-items-center pub-user">
                     <div class="rounded-circle circle-image"
                         style="background:url({{ route('user.profile_image', $Publication->user->id) }}) center / cover no-repeat;">
                     </div>
                     <span>{{ $Publication->user->full_name }}</span>
                 </div>
             </div>
         @endif


     </div>
 </div>

 @if ($editable == 'false')
     </div>
 @endif
