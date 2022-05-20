<div class="separator mb-5"></div>

<div class="card">
    <div class="position-absolute card-top-buttons">
        <button class="btn btn-secondary btn-sm"
                wire:click.prevent="closeEdit">
            <b><i class="simple-icon-logout"></i>&nbsp;&nbsp;Regresar</b>
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
                    <button type="submit" class="btn btn-secondary btn-sm"
                            wire:click.prevent="saveRegister">
                        <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardar</b>
                    </button>

                    <button class="btn btn-secondary btn-sm"
                            wire:click.prevent="closeEdit">
                        <b><i class="simple-icon-logout"></i>&nbsp;&nbsp;Regresar</b>
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>





