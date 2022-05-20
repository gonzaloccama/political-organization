<div class="row h-100">
    @push('title')
        {{ $_title }}
    @endpush
    <div class="col-12 col-md-10 mx-auto my-auto">
        <div class="card auth-card">
            <div class="position-relative image-side">

                <div class="text-white p-3"
                     style="background-color: rgba(6,8,24,0.51) !important; font-weight: 700; border: 1px solid rgba(255,255,255,0.18);"
                >

                    <div class='text-center'>
                        <img src='{{ asset('assets/logos/logo.svg') }}'
                             style='width: 80px !important; box-shadow: 0 0 15px 0 rgba(255,255,255,0.28);'
                             alt=""/>
                        <div class="separator pt-2" style="border-color: rgba(255,255,255,0.18);"></div>
                        <div class="pt-2 pl-2">
                            <p class="h5">MOVIMIENTO</p>

                            <span class="h3">ACCIÓN REGIONAL</span>
                        </div>
                    </div>
                    <p class="white mb-0 pt-3 text-right">
                        <a href="#" class="btn btn-link white">Registrarme</a>
                    </p>
                </div>

                {{--                <p class="white mb-0 p-3 text-right" style="background-color: rgba(6,8,24,0.51) !important;; border: 1px solid rgba(255,255,255,0.18);">--}}
                {{--                    --}}
                {{--                </p>--}}
            </div>
            <div class="form-side">

                <h6 class="mb-4">Iniciar sesión</h6>
                <form>
                    <?php
                    $dt = [
                        'name' => 'email',
                        'text' => 'Correo Electrónico',
                        'type' => 'text',
                        'required' => 1,
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.input-float', $dt)

                    <?php
                    $dt = [
                        'name' => 'password',
                        'text' => 'Contraseña',
                        'type' => 'password',
                        'required' => 1,
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.input-float', $dt)

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="#">¿Contraseña olvidada?</a>
                        <button class="btn btn-primary btn-lg btn-shadow" wire:click.prevent="login" type="submit">
                            Iniciar sesión
                        </button>
                    </div>
                </form>

                @if($message = Session::get('error'))
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
