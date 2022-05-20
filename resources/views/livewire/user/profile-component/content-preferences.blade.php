<div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title">
            <h4 class="card-title font-rajdhani uppercase weight-500">Fotos</h4>
        </div>
        <div class="iq-card-header-toolbar d-flex align-items-center">
            {{--            <p class="m-0"><a href="javacsript:;">Añadir foto </a></p>--}}
        </div>
    </div>
    <div class="iq-card-body">
        <ul class="profile-img-gallary d-flex flex-wrap p-0 m-0">
            <?php
            $photos = \App\Models\PostsPhoto::orderBy('created_at', 'desc')
                ->where('posts.user_id', $user->id)
                ->join('posts', 'posts_photos.post_id', '=', "posts.id")
                ->select('posts_photos.*')
                ->selectRaw('posts.user_id')
                ->selectRaw('posts.post_type')
                ->take(9)->get();
            ?>
            @foreach($photos as $photo)
                <?php
                $path_photo = 'assets/uploads/users/posts-photos/';
                if (in_array($photo->post_type, ['profile_picture', 'profile_cover'])) {
                    $path_photo = 'assets/images/users/';
                }
                ?>
                <li class="col-md-4 col-6 pl-2 pr-0 pb-3">
                    <div class="baguetteBoxPhotos gallery">
                        <a href="{{ asset($path_photo).'/'.$photo->source }}">
                            <div
                                style="background-image: url('{{ asset($path_photo).'/'.$photo->source }}'); background-size: cover; height: 50px"
                                class="img-fluid rounded-0 w-100" alt="Responsive image"></div>
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>

