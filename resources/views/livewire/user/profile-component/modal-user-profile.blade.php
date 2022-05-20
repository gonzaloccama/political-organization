<div class="modal-header">
    <h5 class="modal-title" id="post-modalLabel">Foto de perfil</h5>
    <button type="button"
            class="btn btn-outline-danger rounded-pill mr-1 pr-1 ml-2 pl-2 mt-1 pt-1 pb-1 mb-1"
            data-dismiss="modal"
            wire:click.prevent="cleanItems">
        <i class="ri-close-circle-line" style="font-size: 14px !important;"></i>
    </button>
</div>
<div class="modal-body">
    @if($bg_source)
        <div class="col-md-12 mb-1">
            <button type="button" class="close" aria-label="Close" style="color: #961d2b"
                    wire:click.prevent="deleteFilePost">
                <span aria-hidden="true"><i class="simple-icon-close"></i></span>
            </button>
            <img src="{{ $bg_source->temporaryUrl() }}"
                 class="img-fluid w-100 shadow-sm"
                 alt="" width="120">
        </div>
        @php
            $this->updatePostType('profile_picture');
        @endphp
    @elseif($profile_source)
        <div class="col-md-12 mb-1 text-center">
            <button type="button" class="close" aria-label="Close" style="color: #961d2b"
                    wire:click.prevent="deleteFilePost">
                <span aria-hidden="true"><i class="simple-icon-close"></i></span>
            </button>
            <div style="">
                <img src="{{ $profile_source->temporaryUrl() }}"
                     class="img-fluid w-25 shadow-sm"
                     alt="">
            </div>
        </div>
        @php
            $this->updatePostType('profile_cover');
        @endphp
    @else
        <ul class="d-flex flex-wrap align-items-center list-inline m-0 p-0">
            <li class="col-md-6 mb-3 text-center upload">
                <input hidden type="file" id="picture" wire:model="bg_source"
                       accept="image/jpeg, image/png">
                <label
                    class="iq-bg-primary text-left col-md-12 p-2 pointer mr-3"
                    for="picture">
                    <img src="{{ asset('assets/images/icon/photo.png') }}"
                         alt="icon" class="img-fluid"> Fondo de perfil
                    <span class="text-danger">(resolución=1920x480)</span>
                </label>
            </li>
            <li class="col-md-6 mb-3 text-center upload">
                <input hidden type="file" id="cover" wire:model="profile_source"
                       accept="image/jpeg, image/png">
                <label
                    class="iq-bg-primary text-left col-md-12 p-2 pointer mr-3"
                    for="cover">
                    <img src="{{ asset('assets/images/icon/photo.png') }}"
                         alt="icon" class="img-fluid"> Foto de perfil
                    <span class="text-danger">(resolución=256x256)</span>
                </label>
            </li>
        </ul>
    @endif
    @error('bg_source')
    <div class="text-danger col-md-12 text-errors mb-3 font-italic">
        {!! $message !!}
    </div>
    @enderror
    @error('profile_source')
    <div class="text-danger col-md-12 text-errors mb-3 font-italic">
        {!! $message !!}
    </div>
    @enderror
    <div class="other-option">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">

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
    <div wire:loading wire:target="storeBgProfile" class="w-100">
        <button type="submit" class="btn btn-primary d-block w-100 mt-3" disabled>Publicando...</button>
    </div>
    <div wire:loading.remove wire:target="storeBgProfile" class="w-100">
        <button type="submit" class="btn btn-primary d-block w-100 mt-3"
                wire:click.prevent="storeBgProfile">Publicar
        </button>
    </div>
</div>

