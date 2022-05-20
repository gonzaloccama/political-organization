@if($post->post_type == 'shared' && filled($post->parent))

    <div class="container mt-2">
        <p class="text-justify">{!! $post->text !!}</p>
    </div>

    <div class="border mt-3 pl-2 pr-2" style="border-radius: 5px;">

        @if(filled($post->parent))
            <?php
            $_profile = $this->image_user($post->parent->user->user_gender, $post->parent->user->user_cover);
            ?>
            <div class="user-post-data pt-3 p-2 text-left">
                <div class="d-flex flex-wrap">
                    <div class="media-support-user-img mr-3">
                        <img class="rounded-circle img-fluid"
                             src="{{ asset('assets/images/users/').'/'.$_profile }}" alt="">
                    </div>
                    <div class="media-support-info mt-2">
                        <h5 class="mb-0 d-inline-block">
                            <a href="{{ route('profile', ['id' => base64_encode($post->parent->user_id)]) }}"
                               class="font-weight-medium roboto weight-300">{{ $post->parent->user->fullname }}</a>
                        </h5>
                        <p class="mb-0 text-primary">{{ $this->timeElapsedString($post->parent->created_at) }}</p>
                    </div>
                </div>
            </div>
            @include('livewire.user.posts-component.posts-type', ['data' => $post->parent])
        @else
            <div class="pt-3 pb-1 pl-2 pr-2 col-md-12">
                <div class="alert alert-danger rounded-0" role="alert">
                    <div class="iq-alert-text pl-3 weight-500">
                        <i class="simple-icon-trash mt-1"></i> ¡Publicación eliminada!
                    </div>
                </div>
            </div>
        @endif
    </div>

@else
    @include('livewire.user.posts-component.posts-type', ['data' => $post])
@endif

