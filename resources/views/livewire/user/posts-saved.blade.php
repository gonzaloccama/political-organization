@push('title') {{ $_title }} @endpush
<?php
$img = auth()->user()->user_gender == 2 ? 'woman.svg' : 'man.svg';
$profile = auth()->user()->user_cover ? auth()->user()->user_cover : $img;
?>
<div class="container">
    <div class="row">
        <div class="col-lg-8 m-0 p-0">
            @livewire('user.posts-component', ['is_profile' => false, 'id' => null, 'saved' => true], key(1))
        </div>

        @include('livewire.user.posts-component.home-activities')

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

            window.livewire.on('refreshContent', () => {
                lightbox('.baguetteBoxThree');
            });
            lightbox('.baguetteBoxThree');
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



