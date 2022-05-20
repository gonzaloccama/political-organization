@push('title') {{ $_title }} @endpush
<?php
$user = \App\Models\User::find($profile_id);
$img = $user->user_gender == 2 ? 'woman.svg' : 'man.svg';
$profile = $user->user_cover ? $user->user_cover : $img;
//$bg_profile = auth()->user()->user_cover ? auth()->user()->user_cover : 'profiles-bg.jpg';

$bg_profile = 'profiles-bg.jpg';

if (File::exists('assets/images/users/' . $user->user_picture) && $user->user_picture) {
    $bg_profile = $user->user_picture;
}

?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            @include('livewire.user.profile-component.header-profile')
            <div class="iq-card">
                <div class="iq-card-body p-0 container-fluid">
                    <div class="user-tabing">
                        <ul class="nav nav-pills d-flex align-items-center justify-content profile-feed-items p-0 m-0">
                            <li class="col-sm-3 p-0">
                                <a class="nav-link rounded-0 {{ $tab_pane == 'timeline'?'active':'' }}"
                                   data-toggle="pill" wire:click.prevent="active_tab('timeline')"
                                   href="#timeline">
                                    {{ ($profile_id == auth()->user()->id) ? 'Mis Publicaciones' : 'Publicaciones'  }}
                                </a>
                            </li>

                            <li class="col-sm-3 p-0">
                                <a class="nav-link rounded-0 {{ $tab_pane == 'about'?'active':'' }}"
                                   data-toggle="pill" wire:click.prevent="active_tab('about')"
                                   href="#about">
                                    {{ ($profile_id == auth()->user()->id) ? 'Mi Información' : 'Información'  }}
                                </a>
                            </li>

                            <li class="col-sm-3 p-0">
                                <a class="nav-link rounded-0 {{ $tab_pane == 'photos'?'active':'' }}"
                                   data-toggle="pill" wire:click.prevent="active_tab('photos')"
                                   href="#photos">
                                    {{ ($profile_id == auth()->user()->id) ? 'Mis Fotos' : 'Fotos'  }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="tab-content">
                @include('livewire.user.profile-component.tab-pane-'.$tab_pane)
            </div>
        </div>

    </div>
</div>

@push('styles')

    <style>
        .reactions img:hover {
            animation: shake 1s;
            animation-iteration-count: infinite;
        }

        @keyframes shake {
            0% {
                transform: translate(1px, 1px) rotate(0deg);
            }
            10% {
                transform: translate(-1px, -2px) rotate(-1deg);
            }
            20% {
                transform: translate(-3px, 0px) rotate(1deg);
            }
            30% {
                transform: translate(3px, 2px) rotate(0deg);
            }
            40% {
                transform: translate(1px, -1px) rotate(1deg);
            }
            50% {
                transform: translate(-1px, 2px) rotate(-1deg);
            }
            60% {
                transform: translate(-3px, 1px) rotate(0deg);
            }
            70% {
                transform: translate(3px, 1px) rotate(-1deg);
            }
            80% {
                transform: translate(-1px, -1px) rotate(1deg);
            }
            90% {
                transform: translate(1px, 2px) rotate(0deg);
            }
            100% {
                transform: translate(1px, -2px) rotate(-1deg);
            }
        }

        .upload label {
            cursor: pointer;
        }

        .video-container {
            overflow: hidden;
            position: relative;
            width: 100%;
        }

        .video-container::after {
            padding-top: 56.25%;
            display: block;
            content: '';
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .header-nav li a {
            position: relative;
            z-index: 1 !important;
        }

        .x-image {
            background-image: linear-gradient(rgba(13, 42, 65, 0.78), rgba(13, 42, 65, 0.78));
            position: relative;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-color: #eee;
            width: 96px;
            height: 96px;
            overflow: hidden;
            display: block;
            border-radius: 2px;
        }
    </style>
@endpush

@push('scripts')

    <script type="text/javascript">
        $(document).ready(function () {
            window.livewire.on('closeModalPost', () => {
                $('#post-modal').modal('hide');
            });

            window.livewire.on('closeModalPostShared', () => {
                $('#post-modal-shared').modal('hide');
                notificationSwal('¡Compartido extisomente!', 'rgba(47,122,67,0.89)');
            });

            window.livewire.on('profile_picture', () => {
                $('#profile-picture').modal('hide');
            });

            window.livewire.on('refreshContent', () => {
                lightbox('.baguetteBoxThree');
                lightbox('.baguetteBoxPhotos');
            });
            lightbox('.baguetteBoxThree');
            lightbox('.baguetteBoxPhotos');
        });

        $(document).ready(function () {
            window.livewire.on('deleteAlert', () => {
                deleteSwal()
            });

            window.livewire.on('alertSaved', () => {
                notificationSwal('¡Publicación Guadada extisomente!', 'rgba(47,122,67,0.89)');
            });

            window.addEventListener('livewire-upload-progress', event => {
                // console.log(`${event.detail.progress}%`);
                $('.progress-bar').css(`width`, `${event.detail.progress}%`);
                $('.progress-value').text(`${event.detail.progress}%`);
            });
        });


    </script>
@endpush
