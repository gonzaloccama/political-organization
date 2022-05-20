<div class="container mt-2">
    <p class="text-justify"
       style="overflow-wrap: break-word !important; word-wrap: break-word !important; hyphens: auto !important;">
        {!! $data->text ? $this->regex_url($data->text, 'urls') : '' !!}
    </p>
</div>
<div class="col-md-12 mb-3 text-center">
    @if(isset($data->post_type) && !empty($data->post_type))
        @if($data->post_type == 'photo' && filled($data->postsPhoto))
            <div class="baguetteBoxThree gallery">
                <a href="{{ asset('assets/uploads/users/posts-photos/').'/'.$data->postsPhoto->source }}">
                    <img src="{{ asset('assets/uploads/users/posts-photos/').'/'.$data->postsPhoto->source }}" alt=""
                         class="img-fluid w-100 shadow-sm rounded">
                </a>
            </div>
        @elseif($data->post_type == 'profile_picture' && filled($data->postsPhoto))
            <div class="baguetteBoxThree gallery">
                <a href="{{ asset('assets/images/users/').'/'.$data->postsPhoto->source }}">
                    <img src="{{ asset('assets/images/users/').'/'.$data->postsPhoto->source }}" alt=""
                         class="img-fluid w-100 shadow-sm">
                </a>
            </div>
        @elseif($data->post_type == 'profile_cover' && filled($data->postsPhoto))
            <div class="profile-header">
                <div class="cover-container"
                     style="background-image:linear-gradient(
                         rgba(0,15,57,0.45), rgba(0,15,57,0.45)),
                         url('{{ asset('assets/images/users/').'/'.$post->user->user_picture }}');
                         background-size: cover;height: 200px ">
                </div>
                <div class="user-detail text-center mb-3">
                    <div class="profile-img cover-container">
                        <div class="baguetteBoxThree gallery">
                            <a href="{{ asset('assets/images/users/').'/'.$data->postsPhoto->source }}">
                                <img src="{{ asset('assets/images/users/').'/'.$data->postsPhoto->source }}" alt=""
                                     class="avatar-130 img-fluid">
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        @elseif($data->post_type == 'video' && filled($data->postsVideo))
            <video class="video-container img-fluid w-100 shadow-sm rounded" id="{{ $data->postsVideo->source }}" playsinline controls>
                <source src="{{ asset('assets/uploads/users/posts-videos/') . '/' . $data->postsVideo->source }}"
                        type="video/mp4">
                Your browser does not support HTML video.
            </video>
        @elseif($data->post_type == 'file' && filled($data->postsFile))
            <a href="{{ asset('assets/uploads/users/posts-files/').'/'.$data->postsFile->source }}"
               target="_blank" class="font-italic">
                <img src="{{ asset('assets/images/icon/pdf-page.svg') }}"
                     class="img-fluid shadow-sm" alt="" width="60"><br>{{ $data->postsFile->source }}
            </a>
        @endif
    @elseif($youtube = $this->regex_url($data->text))
        <div class="video-container img-fluid shadow-sm rounded">
            <iframe src="https://www.youtube.com/embed/{{ $youtube }}" frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen class="w-100 h-100"></iframe>
        </div>
    @elseif($drive = $this->regex_url($data->text, 'drivePDF'))
        <iframe src="https://drive.google.com/{{ $drive }}preview?usp=sharing&embedded=true"
                style="width:100%; height:200px;" frameborder="0"></iframe>

    @endif
</div>
