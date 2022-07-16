<div class="form-side">

    <div class="border text-center pt-3 pb-3">
        <h4 class="mb-4 ">Iniciar sesión</h4>
        <div class="mt-5">
            <a href="{{ route('auth.google') }}"
               class="btn btn-icon-google align-middle icon-google btn-block m-auto">
                                        <span>
                                            <img src="{{ asset('assets/images/icon/google.svg') }}"
                                                 class="img-fluid" width="18">
                                        </span>
                <span class="align-middle">Inicar sesion con Google</span>
            </a>
        </div>
        <div class="pt-5">
            <a href="javascript:;" wire:click.prevent="updatePanel('admin')">Iniciar como administrador</a>
        </div>

        @if($message = Session::get('error'))
            <div class="alert alert-danger mt-3">
                {{ $message }}
            </div>
        @endif
    </div>

</div>
