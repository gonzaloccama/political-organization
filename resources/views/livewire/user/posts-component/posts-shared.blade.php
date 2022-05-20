<div class="post-modal-data{{ __('-shared') }}">
    <div class="share-block d-flex align-items-center feather-icon mr-3">
        <a href="javascript:;" data-toggle="modal" data-target=".post-modal-shared"
           wire:click.prevent="postShared({{ $post->origin_id?$post->origin_id:$post->id }})">
            <i class="ri-share-line"></i>
            <?php
            $share_count = \App\Models\Post::where('origin_id', $post->id)->get()->count();
            ?>
            <span class="ml-1">{{ $share_count }} Share</span>
        </a>
    </div>

    <div class="modal fade post-modal-shared" wire:ignore.self tabindex="-1" role="dialog"
         aria-labelledby="post-modalLabel" aria-hidden="true" style="display: none;">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="post-modalLabel">Compartir Post</h5>
                    <button type="button"
                            class="btn btn-outline-danger rounded-pill mr-1 pr-1 ml-2 pl-2 mt-1 pt-1 pb-1 mb-1"
                            data-dismiss="modal"
                            wire:click.prevent="cleanItems">
                        <i class="ri-close-circle-line" style="font-size: 14px !important;"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center">
                        <div class="user-img">
                            <img src="{{ asset('assets/images/users/').'/'.$profile }}"
                                 alt="userimg" class="avatar-60 rounded-circle">
                        </div>
                        <form class="post-text ml-3 w-100" action="javascript:;">
                        <textarea type="text" class="form-control iq-bg-primary" wire:model="text"
                                  style="line-height: 180%"
                                  placeholder="Escribe algo aquí..." autofocus></textarea>
                        </form>
                    </div>

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
                    <button type="submit" class="btn btn-primary d-block w-100 mt-3"
                            wire:click.prevent="postShared">Publicar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
