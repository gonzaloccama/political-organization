<div class="iq-top-navbar bg-primary shadow">
    <div class="iq-navbar-custom">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
            <div class="iq-navbar-logo d-flex justify-content-between">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/logos/') . '/' . $sttngs->logo }}" class="img-fluid" alt="Accion-regional"
                         style="box-shadow: 0 0 2px 2px rgba(255,255,255,0.69); background-color: #fff;">
                    <span class="text-white font-rajdhani-18 text-uppercase" style="letter-spacing: -1px;">
                        {{ $sttngs->name }} {{ $sttngs->campus }}
                    </span>
                </a>
                <div class="iq-menu-bt align-self-center">
                    <div class="wrapper-menu text-white">
                        <div class="main-circle"><i class="simple-icon-menu"></i></div>
                    </div>
                </div>
            </div>
            @livewire('user.search-header-component')
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
                <i class="ri-menu-3-line"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent"
                 style="background-color: rgba(8,64,131,0.96);">
                <ul class="navbar-nav ml-auto navbar-list">
                    <li>
                        <a href="{{ route('profile') }}" class="iq-waves-effect d-flex align-items-center">
                            <?php
                            $img = auth()->user()->user_gender == 2 ? 'woman.svg' : 'man.svg';
                            $profile = auth()->user()->user_cover ? auth()->user()->user_cover : $img;
                            ?>
                            <img class="img-fluid rounded-circle mr-3" alt="user"
                                 src="{{ asset('assets/images/users/').'/'.$profile }}">
                            <div class="caption">
                                <h6 class="mb-0 line-height text-white font-rajdhani-18">{{ auth()->user()->fullname }}</h6>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}" class="iq-waves-effect text-white d-flex align-items-center">
                            <i class="simple-icon-grid" style="font-weight: 500;"></i>
                            {{--                            <i class="ri-home-line"></i>--}}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="search-toggle iq-waves-effect text-white d-flex align-items-center">
                            <i class="simple-icon-bell" style="font-weight: 500;"></i>
                            {{--                            <i class="simple-icon-bell"></i>--}}
                            {{--                            <div id="lottie-beil"></div>--}}
                            <span class="bg-danger dots"></span>
                        </a>
                        <div class="iq-sub-dropdown" style="margin-top: 5px !important;">
                            <div class="iq-card shadow-none m-0">
                                <div class="iq-card-body p-0 ">
                                    <div class="bg-primary p-3">
                                        <h5 class="mb-0 text-white">Notificaciones
{{--                                            <small class="badge badge-light float-right pt-1">4</small>--}}
                                        </h5>
                                    </div>

                                    {{--                                    <a href="#" class="iq-sub-card">--}}
                                    {{--                                        <div class="media align-items-center">--}}
                                    {{--                                            <div class="">--}}
                                    {{--                                                <img class="avatar-40 rounded"--}}
                                    {{--                                                     src="{{ asset('assets/user/images/user/01.jpg') }}" alt="">--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <div class="media-body ml-3">--}}
                                    {{--                                                <h6 class="mb-0 ">Emma Watson Bni</h6>--}}
                                    {{--                                                <small class="float-right font-size-12">Just Now</small>--}}
                                    {{--                                                <p class="mb-0">95 MB</p>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </a>--}}

                                </div>
                            </div>
                        </div>
                    </li>

                </ul>
                <ul class="navbar-list">
                    <?php
                    $mSections = [
                        (object)['route' => route('profile', ['id' => base64_encode(auth()->user()->id)]), 'icon' => 'ri-file-user-line', 'text' => 'Mi perfil'],
                        (object)['route' => route('settings.profile'), 'icon' => 'ri-profile-line', 'text' => 'Editar Perfil'],
                        (object)['route' => route('settings.profile') . '?tab_pane=chang-pwd', 'icon' => 'ri-lock-password-line', 'text' => 'Cambiar contraseña'],
                        (object)['route' => route('settings.profile') . '?tab_pane=privacy', 'icon' => 'ri-lock-line', 'text' => 'Privacidad'],
                    ];
                    ?>
                    <li>
                        <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                            <i class="simple-icon-user text-white"
                               style="border: 1px solid #fff; padding: 5px; border-radius: 50%;"></i>
                        </a>
                        <div class="iq-sub-dropdown iq-user-dropdown" style="margin-top: 5px !important;">
                            <div class="iq-card shadow-none m-0">
                                <div class="iq-card-body p-0 ">
                                    <div class="bg-primary p-3 line-height">
                                        <h5 class="mb-0 text-white line-height">Hola <span
                                                class="font-rajdhani">{{ auth()->user()->fullname }}</span></h5>
                                        <span class="text-white font-size-12">disponible</span>
                                    </div>
                                    @foreach($mSections as $m)
                                        <a href="{{ $m->route }}" class="iq-sub-card iq-bg-primary-hover">
                                            <div class="media align-items-center">
                                                <div class="rounded iq-card-icon iq-bg-primary">
                                                    <i class="{{ $m->icon }}"></i>
                                                </div>
                                                <div class="media-body ml-3">
                                                    <h6 class="mb-0 ">{{ $m->text }}</h6>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                    <div class="d-inline-block w-100 text-center p-3">
                                        <a class="bg-primary iq-sign-btn" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                           role="button">
                                            Cerrar sesión<i class="ri-login-box-line ml-2"></i>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  class="d-none">
                                                @csrf
                                            </form>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
