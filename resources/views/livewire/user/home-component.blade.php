@push('title') {{ $_title }} @endpush
<?php
$img = auth()->user()->user_gender == 2 ? 'woman.svg' : 'man.svg';
$profile = auth()->user()->user_cover ? auth()->user()->user_cover : $img;
?>
<div class="container">
    <div class="row">
        <div class="col-lg-8 m-0 p-0">
            @livewire('user.posts-component', ['is_profile' => false])
        </div>

        @include('livewire.user.posts-component.home-activities')

    </div>
</div>


@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/plyr/plyr.css') }}"/>
    <style>
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
    <script src="{{ asset('assets/plugins/plyr/plyr.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            window.livewire.on('closeModalPost', () => {
                $('#post-modal').modal('hide');
            });

            window.livewire.on('closeModalPostShared', () => {
                $('.post-modal-shared').modal('hide');
                notificationSwal('¡Compartido extisomente!', 'rgba(47,122,67,0.89)');
            });

            window.livewire.on('refreshContent', () => {
                lightbox('.baguetteBoxThree');

                const players = {};
                Array.from(document.querySelectorAll('.player')).forEach(video => {
                    players[video.id] = new Plyr(video, {});
                });
            });
            lightbox('.baguetteBoxThree');

            const players = {};

            Array.from(document.querySelectorAll('.player')).forEach(video => {
                players[video.id] = new Plyr(video, {});
            });
        });

        $(document).ready(function () {
            window.livewire.on('deleteAlert', () => {
                deleteSwal()
            });

            window.livewire.on('alertSaved', () => {
                notificationSwal('¡Publicación Guadada extisomente!', 'rgba(47,122,67,0.89)');
            });

            window.livewire.on('errorException', (mssg) => {
                notificationSwal(`${mssg}`, 'rgba(253,30,47,0.93)');
            });

            window.addEventListener('livewire-upload-progress', event => {
                // console.log(`${event.detail.progress}%`);
                $('.progress-bar').css(`width`, `${event.detail.progress}%`);
                $('.progress-value').text(`${event.detail.progress}%`);
            });

            window.onscroll = function(ev) {
                if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                    window.livewire.emit('load-more');
                }
            };
        });
    </script>
@endpush
