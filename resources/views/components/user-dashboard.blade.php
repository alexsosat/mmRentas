<div class="col-12 col-lg-4 mb-5 mb-lg-0">
    <div class="d-flex flex-column align-items-center">
        <div class="rounded-circle big-user-circle mb-3"
            style="background: url({{ route('user.profile_image', $User->id) }}) center / cover no-repeat;">
        </div>
        <h2>{{ $User->name . ' ' . $User->surname }}</h2>
        <div class="horizontal-separator w-100"></div>
    </div>
    <div class="mb-4">
        <a class="user-link" href="{{ route('user.info', $User->id) }}">
            <p>Información</p>
        </a>
        <a class="user-link" href="{{ route('user.publications', $User->id) }}">
            <p>Publicaciones</p>
        </a>
    </div>
    <a class="d-flex justify-content-between text-blue user-logout align-items-center"
        onclick='event.preventDefault();document.getElementById("logout-form").submit();'
        href="{{ route('logout') }}">
        <form id=" logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        <span class="cerrar">Cerrar Sesión</span><i class="fas fa-sign-out-alt"></i>
    </a>
</div>
