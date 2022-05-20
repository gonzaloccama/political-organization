@if(!$isProfile || $profile_id == auth()->user()->id)
    <div class="modal fade" id="post-modal" wire:ignore.self tabindex="-1" role="dialog"
         aria-labelledby="post-modalLabel" aria-hidden="true" style="display: none;">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title font-rajdhani uppercase weight-400" id="post-modalLabel">Crear Post</h4>
                    <button type="button" data-dismiss="modal" wire:click.prevent="cleanItems"
                            class="btn btn-outline-danger rounded-pill mr-1 pr-1 ml-2 pl-2 mt-1 pt-1 pb-1 mb-1">
                        <i class="ri-close-circle-line" style="font-size: 14px !important;"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center" wire:ignore.self>
                        <div class="user-img">
                            <img src="{{ asset('assets/images/users/').'/'.$profile }}"
                                 alt="userimg" class="avatar-60 rounded-circle">
                        </div>
                        <form class="post-text ml-3 w-100">
                        <textarea type="text" class="form-control iq-bg-primary" wire:model="text" autofocus
                                  style="line-height: 180%" placeholder="Escribe algo aquí..."></textarea>

                        </form>
                    </div>

                    <hr>

                    @if($photo_source)
                        <div class="col-md-12 mb-1">
                            <button type="button" class="close" aria-label="Close" style="color: #961d2b"
                                    wire:click.prevent="deleteFilePost">
                                <span aria-hidden="true"><i class="simple-icon-close"></i></span>
                            </button>
                            <img src="{{ $photo_source->temporaryUrl() }}"
                                 class="img-fluid w-100 shadow-sm rounded"
                                 alt="" width="120">
                        </div>
                        @php
                            $this->updatePostType('photo');
                        @endphp
                    @elseif($video_source)
                        <div class="col-md-12 mb-1">
                            <button type="button" class="close" aria-label="Close" style="color: #961d2b"
                                    wire:click.prevent="deleteFilePost">
                                <span aria-hidden="true"><i class="simple-icon-close"></i></span>
                            </button>
                            {{--                        <img src="{{ $video_source->temporaryUrl() }}"--}}
                            {{--                             class="img-fluid rounded w-100 shadow-sm"--}}
                            {{--                             alt="" width="120">--}}
                            <video controls class="img-fluid w-100 shadow-sm rounded" playsinline>
                                <source src="{{ $video_source->temporaryUrl() }}" type="video/mp4">
                                Your browser does not support HTML video.
                            </video>
                        </div>
                        @php
                            $this->updatePostType('video');
                        @endphp
                    @elseif($file_source)
                        <div class="col-md-12 text-center mb-1">
                            <button type="button" class="close" aria-label="Close" style="color: #961d2b"
                                    wire:click.prevent="deleteFilePost">
                                <span aria-hidden="true"><i class="simple-icon-close"></i></span>
                            </button>
                            <img src="{{ asset('assets/images/icon/pdf-page.svg') }}"
                                 class="img-fluid shadow-sm"
                                 alt="" width="60">
                            <span>{{ substr($file_source->getClientOriginalName(), 0, strlen($file_source->getClientOriginalName())-4).'.'.$file_source->extension() }}</span>
                        </div>
                        @php
                            $this->updatePostType('file');
                        @endphp
                    @elseif(isset($text) && !empty($text))
                        @if($youtube = $this->regex_url($text, 'youtube'))
                            <div class="col-md-12 mb-3 text-center">
                                <div class="video-container rounded">
                                    <iframe src="https://www.youtube.com/embed/{{ $youtube }}" frameborder="0"
                                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen></iframe>
                                </div>
                            </div>
                        @elseif($drive = $this->regex_url($text, 'drivePDF'))
                            <div class="col-md-12 mb-3 text-center rounded">
                                {{--                            <b>{{ str_replace('view', 'preview', $findUrl[0]) }}</b>--}}
                                <iframe src="https://drive.google.com/{{ $drive }}preview?usp=sharing&embedded=true"
                                        style="width:100%; height:200px;" frameborder="0"></iframe>
                            </div>
                        @endif
                    @else
                        <ul class="d-flex flex-wrap align-items-center list-inline m-0 p-0">
                            <li class="col-md-6 mb-3 text-center upload">
                                <input hidden type="file" id="upload" wire:model="photo_source"
                                       accept="image/jpeg, image/png">
                                <label
                                    class="iq-bg-primary text-left col-md-12 p-2 pointer mr-3 weight-500"
                                    for="upload">
                                    <img src="{{ asset('assets/images/icon/photo.png') }}"
                                         alt="icon" class="img-fluid"> Cargar foto
                                </label>

                            </li>

                            <li class="col-md-6 mb-3 text-center upload">
                                {{--                            <input hidden type="file" id="album" wire:model=""--}}
                                {{--                                   accept="image/jpeg, image/png" multiple="multiple">--}}
                                <label class="iq-bg-primary text-left col-md-12 p-2 pointer mr-3  weight-500"
                                       for="album">
                                    <img src="{{ asset('assets/images/icon/album-photo.png') }}"
                                         alt="icon" class="img-fluid"> Crear album
                                    <span class="text-danger font-12">(No posteable)</span>
                                </label>
                            </li>

                            <li class="col-md-6 mb-3 text-center upload">
                                <input hidden type="file" id="video" wire:model="video_source"
                                       accept="video/mp4">
                                <label class="iq-bg-primary text-left col-md-12 p-2 pointer mr-3 weight-500"
                                       for="video">
                                    <img src="{{ asset('assets/images/icon/video.png') }}"
                                         alt="icon" class="img-fluid"> Cargar video
                                </label>
                            </li>

                            <li class="col-md-6 mb-3 text-center upload">
                                <input hidden type="file" id="pdf" wire:model="file_source"
                                       accept="application/pdf">
                                <label class="iq-bg-primary text-left col-md-12 p-2 pointer mr-3  weight-500"
                                       for="pdf">
                                    <img src="{{ asset('assets/images/icon/file.png') }}"
                                         alt="icon" class="img-fluid"> Cargar PDF
                                </label>
                            </li>

                            <li class="col-md-12 mb-1 text-center">
                                <div wire:loading class="col-12"
                                     wire:target="photo_source, video_source, file_source">
                                    <div class="progress-outer">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped"
                                                 style="width: 0%"></div>
                                            <div class="progress-value">0%</div>
                                        </div>
                                    </div>
                                    Cargando...

                                    {{--                                                                        <div class="alert alert-danger w-100" role="alert">--}}
                                    {{--                                                                            <div class="spinner-grow" role="status"></div>--}}
                                    {{--                                                                            <div class="iq-alert-text  pl-3">Cargando...</div>--}}
                                    {{--                                                                        </div>--}}
                                </div>
                            </li>
                        </ul>
                    @endif

                    @if(count($errors))
                        @foreach ($errors->all() as $error)
                            <div class="text-danger col-md-12 text-errors mb-3 font-italic">{!! $error !!}</div>
                        @endforeach
                    @endif

                    <hr>
                    <div class="other-option">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="user-img mr-3">
                                    <img src="{{ asset('assets/images/users//').'/'.$profile }}"
                                         alt="userimg"
                                         class="avatar-60 rounded-circle img-fluid">
                                </div>
                                <h6>Tu historia</h6>
                            </div>
                            <div class="iq-card-post-toolbar">
                                <?php
                                $icon_privacy = ($privacy == 'public')
                                    ? '<i class="simple-icon-globe align-middle" style="font-size: 16px; color: white; font-weight: 600"></i>'
                                    : '<i class="simple-icon-lock align-middle" style="font-size: 16px; color: white; font-weight: 600"></i>';
                                ?>
                                <div class="dropdown rounded-0">
                                    <div class="dropdown-toggle" data-toggle="dropdown"
                                         aria-haspopup="true" aria-expanded="false" role="button">
                                    <span class="btn btn-primary pl-3 pr-3">
                                        {!! $icon_privacy !!} {{ $privacy == 'public'?'Público':'Solo yo' }}
                                    </span>
                                    </div>
                                    <div class="dropdown-menu rounded-0 m-0 p-0">
                                        <a class="dropdown-item p-3" href="#"
                                           wire:click.prevent="updatePrivacy('public')">
                                            <div
                                                class="d-flex align-items-top p-2 {{ $privacy == 'public'?'bg-info':'' }}">
                                                <div class="icon font-size-20 mt-1">
                                                    <i class="simple-icon-globe align-middle"></i>
                                                </div>
                                                <div class="data ml-2">
                                                    <h6 class="font-weight-bold">Publico</h6>
                                                    <p class="mb-0">Todos pueden ver</p>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="dropdown-item p-3" href="#"
                                           wire:click.prevent="updatePrivacy('me')">
                                            <div
                                                class="d-flex align-items-top p-2 {{ $privacy == 'me'?'bg-info':'' }}">
                                                <div class="icon font-size-20 mt-1">
                                                    <i class="simple-icon-lock align-middle"></i>
                                                </div>
                                                <div class="data ml-2">
                                                    <h6 class="font-weight-bold">Sólo yo</h6>
                                                    <p class="mb-0">Sólo yo puedo ver</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div wire:loading wire:target="storePost" class="w-100">
                        <button type="submit" class="btn btn-primary d-block w-100 mt-3" disabled>Publicando...
                        </button>
                    </div>
                    <div wire:loading.remove wire:target="storePost">
                        <button type="submit" class="btn btn-primary d-block w-100 mt-3"
                                wire:click.prevent="storePost">Publicar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
