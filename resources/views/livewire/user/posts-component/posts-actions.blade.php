<div class="dropdown-menu dropdown-menu-right rounded-0 m-0 p-0">
    @if(!$saved)
        <a class="dropdown-item p-3" href="#" wire:click.prevent="PostSaved({{ $post->id }})">
            <div class="d-flex align-items-top">
                <div class="icon font-size-20"><i class="ri-save-line"></i>
                </div>
                <div class="data ml-2">
                    <h6>Guardar post</h6>
                    <p class="mb-0">Agregue a elementos guardados</p>
                </div>
            </div>
        </a>
    @endif
    @if($post->user_id == auth()->user()->id)
        <a class="dropdown-item p-3" href="#"
           wire:click.prevent="deletePostConfirm({{ $post->id }}, '{{ $post->post_type }}')">
            <div class="d-flex text-danger align-items-top">
                <div class="icon font-size-20"><i
                        class="ri-close-circle-line"></i></div>
                <div class="data ml-2">
                    <h6>Eliminar post</h6>
                    <p class="mb-0">Se eliminará definitivamente.</p>
                </div>
            </div>
        </a>
    @endif

</div>

