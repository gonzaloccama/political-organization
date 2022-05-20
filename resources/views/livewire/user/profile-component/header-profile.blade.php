<div class="iq-card">
    <div class="iq-card-body profile-page p-0">
        <div class="profile-header" id="post-modal-data">
            <div class="cover-container"
                 style="background-image:linear-gradient(rgba(0,15,57,0.45), rgba(0,15,57,0.45)), url('{{ asset('assets/images/users/').'/'.$bg_profile }}'); background-size: cover;height: 200px ">
                {{--                <img src="{{ asset('assets/images/users/').'/'.$bg_profile }}"--}}
                {{--                     alt="profile-bg" class="rounded-0 img-fluid" style="background-image: linear-gradient(rgb(8,44,79), rgb(8,44,79));">--}}
                @if($profile_id == auth()->user()->id)
                    <ul class="header-nav d-flex flex-wrap justify-end p-0 m-0">
                        <li>
                            <a href="#" data-toggle="modal" data-target="#profile-picture"
                               wire:click.prevent="open_modal('profile')">
                                <i class="ri-pencil-line"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('settings.profile') }}">
                                <i class="ri-settings-4-line"></i>
                            </a>
                        </li>
                    </ul>
                @endif
            </div>
            <div class="user-detail text-center mb-3">
                <div class="profile-img cover-container">
                    <img src="{{ asset('assets/images/users/').'/'.$profile }}" alt="profile-img"
                         class="avatar-130 img-fluid"/>
                </div>
                <div class="profile-detail">
                    <h3 class="profile-user">{{ $user->fullname }}</h3>
                </div>
            </div>
            <div
                class="profile-info p-4 d-flex align-items-center justify-content-between position-relative">
                <div class="social-links">
                    <ul class="social-data-block d-flex align-items-center justify-content-between list-inline p-0 m-0">
                        <?php
                        $medias = [
                            (object)['media' => 'facebook', 'url' => $user->user_social_facebook],
                            (object)['media' => 'twitter', 'url' => $user->user_social_twitter],
                            (object)['media' => 'instagram', 'url' => $user->user_social_instagram],
                            (object)['media' => 'linkedin', 'url' => $user->user_social_linkedin],
                            (object)['media' => 'youtube', 'url' => $user->user_social_youtube],
                            (object)['media' => 'whatsapp', 'url' => $user->user_social_whatsapp],
                        ];
                        ?>
                        @foreach($medias as $m)
                            @if($m->url)
                                <li class="text-center pr-3">
                                    <a href="{{ $m->media=='whatsapp'?'https://api.whatsapp.com/send?phone=51'.$m->url.'&text=':$m->url }}"
                                       target="_blank">
                                        <img
                                            src="{{ asset('assets/images/users/media-social/').'/'.$m->media.'.png' }}"
                                            class="img-fluid rounded" alt="{{ $m->media }}" width="25">
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="social-info">
                    <ul class="social-data-block d-flex align-items-center justify-content-between list-inline p-0 m-0">
                        <li class="text-center pl-3">
                            <h6 class="info-social-user">Publicaciones</h6>
                            <p class="mb-0">{{ \App\Models\Post::where('user_id', $user->id)->get()->count() }}</p>
                        </li>
                        {{--                        <li class="text-center pl-3">--}}
                        {{--                            <h6 class="info-social-user">Seguidores</h6>--}}
                        {{--                            <p class="mb-0">206</p>--}}
                        {{--                        </li>--}}
                        {{--                        <li class="text-center pl-3">--}}
                        {{--                            <h6 class="info-social-user">Seguidores</h6>--}}
                        {{--                            <p class="mb-0">100</p>--}}
                        {{--                        </li>--}}
                    </ul>
                </div>
            </div>
            @if($profile_id == auth()->user()->id)
                <div class="modal fade" id="profile-picture" wire:ignore.self tabindex="-1" role="dialog"
                     aria-labelledby="post-modalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            @include('livewire.user.profile-component.modal-user-'.$modal)
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </div>
</div>


