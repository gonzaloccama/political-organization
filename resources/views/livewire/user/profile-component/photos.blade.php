<h2>Fotos</h2>


<div class="friend-list-tab mt-2">
    <ul class="nav nav-pills d-flex align-items-center justify-content-left friend-list-items p-0 mb-2">
        <li>
            <a class="nav-link active" data-toggle="pill"
               href="#photosofyou">{{ $profile_id == auth()->user()->id ? 'Tus publicaciones': 'Sus publicaciones' }}</a>
        </li>
        <li>
            <a class="nav-link" data-toggle="pill"
               href="#your-photos">{{ $profile_id == auth()->user()->id ? 'Tus fotos': 'Sus fotos' }}</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="photosofyou" role="tabpanel">
            <div class="iq-card-body p-0">
                <div class="row">

                    <?php
                    $photos = \App\Models\PostsPhoto::orderBy('created_at', 'desc')
                        ->where('posts.user_id', $user->id)
                        ->where('posts.post_type', '!=', 'profile_picture')
                        ->where('posts.post_type', '!=', 'profile_cover')
                        ->join('posts', 'posts_photos.post_id', '=', "posts.id")
                        ->select('posts_photos.*')
                        ->selectRaw('posts.user_id')
                        ->take(9)->get();
                    ?>

                    @foreach($photos as $photo)
                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="user-images position-relative overflow-hidden">
                                <div class="baguetteBoxPhotos gallery">
                                    <a href="{{ asset('assets/uploads/users/posts-photos/').'/'.$photo->source }}">
                                        <div
                                            style="background-image: url('{{ asset('assets/uploads/users/posts-photos/').'/'.$photo->source }}'); background-size: cover; height: 150px"
                                            class="img-fluid rounded-0 w-100" alt="Responsive image"></div>
                                    </a>
                                </div>
                                <div class="image-hover-data">
                                    <div class="product-elements-icon">
                                        <ul class="d-flex align-items-center m-0 p-0 list-inline">
                                            <li><a href="#" class="pr-3 text-white"> 0 <i
                                                        class="ri-thumb-up-line"></i> </a>
                                            </li>
                                            <li><a href="#" class="pr-3 text-white"> 0 <i
                                                        class="ri-chat-3-line"></i> </a>
                                            </li>
                                            <li><a href="#" class="pr-3 text-white"> 0 <i
                                                        class="ri-share-forward-line"></i>
                                                </a></li>
                                        </ul>
                                    </div>
                                </div>
                                <a href="#" class="image-edit-btn" data-toggle="tooltip"
                                   data-placement="top" title=""
                                   data-original-title="Edit or Remove"><i
                                        class="ri-edit-2-fill"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="your-photos" role="tabpanel">
            <div class="iq-card-body p-0">
                <div class="row">

                    <?php
                    $photos = \App\Models\PostsPhoto::orderBy('created_at', 'desc')
                        ->where(function ($query) {
                            $query->orWhere('posts.post_type', 'profile_picture');
                            $query->orWhere('posts.post_type', 'profile_cover');
                        })
                        ->where('posts.user_id', $user->id)
                        ->join('posts', 'posts_photos.post_id', '=', "posts.id")
                        ->select('posts_photos.*')
                        ->selectRaw('posts.user_id')
                        ->take(9)->get();
                    ?>

                    @foreach($photos as $photo)
                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="user-images position-relative overflow-hidden">
                                <div class="baguetteBoxPhotos gallery">
                                    <a href="{{ asset('assets/images/users/').'/'.$photo->source }}">
                                        <div
                                            style="background-image: url('{{ asset('assets/images/users/').'/'.$photo->source }}'); background-size: cover; height: 150px"
                                            class="img-fluid rounded-0 w-100" alt="Responsive image"></div>
                                    </a>
                                </div>
                                <div class="image-hover-data">
                                    <div class="product-elements-icon">
                                        <ul class="d-flex align-items-center m-0 p-0 list-inline">
                                            <li><a href="#" class="pr-3 text-white"> 0 <i
                                                        class="ri-thumb-up-line"></i> </a>
                                            </li>
                                            <li><a href="#" class="pr-3 text-white"> 0 <i
                                                        class="ri-chat-3-line"></i> </a>
                                            </li>
                                            <li><a href="#" class="pr-3 text-white"> 0 <i
                                                        class="ri-share-forward-line"></i>
                                                </a></li>
                                        </ul>
                                    </div>
                                </div>
                                <a href="#" class="image-edit-btn" data-toggle="tooltip"
                                   data-placement="top" title=""
                                   data-original-title="Edit or Remove"><i
                                        class="ri-edit-2-fill"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
