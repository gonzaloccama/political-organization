<div class="col-md-3">
    <ul class="nav nav-pills basic-info-items list-inline d-block p-0 m-0">
        <li>
            <a class="nav-link active" data-toggle="pill" href="#basicinfo">Información básica</a>
        </li>

        <li>
            <a class="nav-link" data-toggle="pill" href="#details">Detalles</a>
        </li>
    </ul>
</div>
<div class="col-md-9 pl-4">
    <div class="tab-content">
        <div class="tab-pane fade active show" id="basicinfo" role="tabpanel">
            <h4>Información del contacto</h4>
            <hr>
            <div class="row">
                <div class="col-3">
                    <h6>Email</h6>
                </div>
                <div class="col-9">
                    <p class="mb-0">
                        <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                    </p>
                </div>

                <div class="col-3">
                    <h6>Celular</h6>
                </div>
                <div class="col-9">
                    @if(!$user->user_privacy_basic || $profile_id == auth()->user()->id)
                        <p class="mb-0">
                            <a href="tel:{{ $user->phone }}">{{ $user->phone }}</a>
                            {!! $user->user_privacy_basic ? '<i class="iconsminds-security-block text-warning"></i>' : '' !!}
                        </p>
                    @else
                        <p class="mb-0"><i class="iconsminds-security-block"></i></p>
                    @endif
                </div>

                <div class="col-3">
                    <h6>Username</h6>
                </div>
                <div class="col-9">
                    @if(!$user->user_privacy_basic || $profile_id == auth()->user()->id)
                        <p class="mb-0">
                            {{ $user->username }}
                            {!! $user->user_privacy_basic ? '<i class="iconsminds-security-block text-warning"></i>' : '' !!}
                        </p>
                    @else
                        <p class="mb-0"><i class="iconsminds-security-block"></i></p>
                    @endif
                </div>


                <div class="col-3">
                    <h6>Dirección</h6>
                </div>
                <div class="col-9">
                    @if(!$user->user_privacy_basic || $profile_id == auth()->user()->id)
                        <p class="mb-0">
                            {{ $user->user_address }}
                            {!! $user->user_privacy_basic ? '<i class="iconsminds-security-block text-warning"></i>' : '' !!}
                        </p>
                    @else
                        <p class="mb-0"><i class="iconsminds-security-block"></i></p>
                    @endif
                </div>


                <div class="col-3">
                    <h6>Región</h6>
                </div>
                <div class="col-9">
                    @if(isset($user->u_region->region) && !empty($user->u_region->region))
                        <p class="mb-0">{{ $user->u_region->region }}</p>
                    @endif
                </div>

                <div class="col-3">
                    <h6>Provincia</h6>
                </div>
                <div class="col-9">
                    <p class="mb-0">{{ $user->user_province }}</p>
                </div>
            </div>
            <h4 class="mt-3">Sitios web y enlaces sociales</h4>
            <hr>
            <div class="row">

                <div class="col-3">
                    <h6>Facebook</h6>
                </div>
                <div class="col-9">
                    <p class="mb-0">
                        <i class="la la-facebook-official text-primary"></i>
                        <a href="{{ $user->user_social_facebook }}">{{ $user->user_social_facebook }}</a>
                    </p>
                </div>

                <div class="col-3">
                    <h6>WhatsApp</h6>
                </div>
                <div class="col-9">
                    <p class="mb-0">
                        <i class="la la-whatsapp text-primary"></i>
                        <a href="https://api.whatsapp.com/send?phone=51{{ $user->user_social_whatsapp }}">{{ $user->user_social_whatsapp }}</a>
                    </p>
                </div>

            </div>
            <h4 class="mt-3">Información básica</h4>
            <hr>
            <div class="row">
                <div class="col-3">
                    <h6>Fecha de nacimiento</h6>
                </div>
                <div class="col-9">
                    @if(!$user->user_privacy_birthdate || $profile_id == auth()->user()->id)
                        @if($user->user_birthdate != null)
                            <p class="mb-0">
                                {{ ucfirst(Carbon\Carbon::parse($user->user_birthdate)->locale('es')->translatedFormat('l, d \d\e F \d\e Y')) }}
                                {!! $user->user_privacy_birthdate ? '<i class="iconsminds-security-block text-warning"></i>' : '' !!}
                            </p>
                        @else
                            <p class="mb-0">
                                {{ __('No definido') }}
                            </p>
                        @endif
                    @else
                        <p class="mb-0"><i class="iconsminds-security-block"></i></p>
                    @endif

                </div>


                <div class="col-3">
                    <h6>Genero</h6>
                </div>
                <div class="col-9">
                    @if(!$user->user_privacy_gender || $profile_id == auth()->user()->id)
                        <p class="mb-0">
                            @if(isset($user->u_gender->gender) && !empty($user->u_gender->gender))
                                {{ $user->u_gender->gender }}
                            @endif
                            {!! $user->user_privacy_gender ? '<i class="iconsminds-security-block text-warning"></i>' : '' !!}
                        </p>
                    @else
                        <p class="mb-0"><i class="iconsminds-security-block"></i></p>
                    @endif
                </div>

                <div class="col-3">
                    <h6>Estado civil</h6>
                </div>
                <div class="col-9">
                    @if(!$user->user_privacy_relationship || $profile_id == auth()->user()->id)
                        <p class="mb-0">
                            @if(isset($user->u_relationship->relationship) && !empty($user->u_relationship->relationship))
                                {{ $user->u_relationship->relationship }}
                            @endif
                            {!! $user->user_privacy_relationship ? '<i class="iconsminds-security-block text-warning"></i>' : '' !!}
                        </p>
                    @else
                        <p class="mb-0"><i class="iconsminds-security-block"></i></p>
                    @endif
                </div>

                {{--                <div class="col-3">--}}
                {{--                    <h6>interested in</h6>--}}
                {{--                </div>--}}
                {{--                <div class="col-9">--}}
                {{--                    <p class="mb-0">Designing</p>--}}
                {{--                </div>--}}

                {{--                <div class="col-3">--}}
                {{--                    <h6>language</h6>--}}
                {{--                </div>--}}
                {{--                <div class="col-9">--}}
                {{--                    <p class="mb-0">English, French</p>--}}
                {{--                </div>--}}
            </div>
        </div>

        <div class="tab-pane fade" id="details" role="tabpanel">
            <h4 class="mb-3">Biografia</h4>
            {{ $user->user_biography }}
        </div>
    </div>
</div>
