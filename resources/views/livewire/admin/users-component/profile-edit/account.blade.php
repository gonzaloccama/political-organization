<div class="tab-pane fade show active">
    <form action="">
        <div class="form-group row">
            <label for="user_verified" class="col-sm-3 col-form-label">Usuario
                verificado</label>
            <div class="col-sm-9">
                <div class="custom-switch custom-switch-primary mb-2">
                    <input class="custom-switch-input" id="user_verified" type="checkbox"
                           wire:model="user_verified">
                    <label class="custom-switch-btn" for="user_verified"></label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="user_banned" class="col-sm-3 col-form-label">Usuario banneado</label>
            <div class="col-sm-9">
                <div class="custom-switch custom-switch-primary mb-2">
                    <input class="custom-switch-input" id="user_banned" type="checkbox"
                           wire:model="user_banned">
                    <label class="custom-switch-btn" for="user_banned"></label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="user_activated" class="col-sm-3 col-form-label">Cuenta activada</label>
            <div class="col-sm-9">
                <div class="custom-switch custom-switch-primary mb-2">
                    <input class="custom-switch-input" id="user_activated" type="checkbox"
                           wire:model="user_activated">
                    <label class="custom-switch-btn" for="user_activated"></label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="user_group" class="col-sm-3 col-form-label">Rol de usuario
                (Grupo)</label>
            <div class="col-sm-9">
                <select id="user_group" class="form-control" wire:model="user_group">
                    <option selected disabled>Seleccionar...</option>
                    @foreach($roles as $rol)
                        <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                    @endforeach
                </select>
                @error('user_group')
                <span class="text-danger text-error text-small font-italic">
                    <i class="simple-icon-info"></i> {!! $message !!}
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="username" class="col-sm-3 col-form-label">Nombre de usuario</label>
            <div class="col-sm-9 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="url-user">{{  url('/users/') }}/</span>
                    </div>
                    <input type="text" class="form-control" id="username"
                           aria-describedby="url-user"
                           wire:model="username">
                </div>
                @error('username')
                <span class="text-danger text-error text-small font-italic">
                    <i class="simple-icon-info"></i> {!! $message !!}
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">Correo electrónico</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="email"
                       wire:model="email" placeholder="Correo electrónico">
                @error('email')
                <span class="text-danger text-error text-small font-italic">
                    <i class="simple-icon-info"></i> {!! $message !!}
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="phone" class="col-sm-3 col-form-label">Celular</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="phone"
                       wire:model="phone" placeholder="Celular">
                @error('phone')
                <span class="text-danger text-error text-small font-italic">
                    <i class="simple-icon-info"></i> {!! $message !!}
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="user_email_verified" class="col-sm-3 col-form-label">Correo
                verificado</label>
            <div class="col-sm-9">
                <div class="custom-switch custom-switch-primary mb-2">
                    <input class="custom-switch-input" id="user_email_verified" type="checkbox"
                           wire:model="user_email_verified">
                    <label class="custom-switch-btn" for="user_email_verified"></label>
                </div>
            </div>
        </div>
        {{--
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-3 col-form-label">Contraseña</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" id="password"
                                                       wire:model="password"
                                                       placeholder="Contraseña">
                                            </div>
                                        </div>
        --}}
    </form>

    <div class="separator mb-5"></div>

    <div class="text-right">
        <button class="btn btn-secondary btn-sm"
                wire:click.prevent="closeFrame">
            <b><i class="simple-icon-logout"></i>&nbsp;&nbsp;Regresar</b>
        </button>

        <button class="btn btn-danger btn-sm" wire:click.prevent="deleteConfirm({{ $itemId }})">
            <b><i class="simple-icon-user-unfollow"></i>&nbsp;&nbsp;Eliminar usuario</b>
        </button>

        <button type="submit" class="btn btn-secondary btn-sm"
                wire:click.prevent="updateData">
            <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardar cambios</b>
        </button>
    </div>
</div>


