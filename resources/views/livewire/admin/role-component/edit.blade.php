<div class="card col-md-12">
    <div class="position-absolute card-top-buttons">
        <button class="btn btn-header-light icon-button" wire:click.prevent="closeFrame">
            <span style="color: white;position: absolute; margin-top: -17px; margin-left: -12px">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="1" fill="none"
                     stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </span>
        </button>
    </div>

    <div class="card-body">
        <h5 class="card-title text-muted text-uppercase">{{ $name }}</h5>
        <div class="separator mb-5"></div>
        <div class="scroll">
            <div class="card-body border">
                <form action="">

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Rol de usuario</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name"
                                   wire:model="name" placeholder="Rol de usuario">
                            @error('name')
                            <span class="text-danger text-error text-small font-italic">
                            <i class="simple-icon-info"></i> {!! $message !!}
                        </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label">Descripción</label>
                        <div class="col-sm-9">
                            <textarea type="text" class="form-control" id="description"
                                      wire:model="description" placeholder="Descripción"></textarea>
                            @error('description')
                            <span class="text-danger text-error text-small font-italic">
                            <i class="simple-icon-info"></i> {!! $message !!}
                        </span>
                            @enderror
                        </div>
                    </div>

                </form>

                <div class="text-right">
                    <button class="btn btn-secondary btn-sm"
                            wire:click.prevent="closeFrame">
                        <b><i class="simple-icon-logout"></i>&nbsp;&nbsp;Regresar</b>
                    </button>

{{--                    <button class="btn btn-danger btn-sm" wire:click.prevent="deleteConfirm({{ $itemId }})">--}}
{{--                        <b><i class="simple-icon-user-unfollow"></i>&nbsp;&nbsp;Eliminar</b>--}}
{{--                    </button>--}}

                    <button type="submit" class="btn btn-secondary btn-sm"
                            wire:click.prevent="updateData">
                        <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardar cambios</b>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>



