<div class="tab-pane fade show active">
    <form action="">
        <?php
        $dt = [
            'name' => 'user_verified',
            'text' => 'Usuario verificado',
            'required' => 0,
            'type' => 'checkbox',
        ];
        ?>
        @include('livewire.widgets.admin.form.input-h', $dt)

        <?php
        $dt = [
            'name' => 'user_banned',
            'text' => 'Usuario banneado',
            'required' => 0,
            'type' => 'checkbox',
        ];
        ?>
        @include('livewire.widgets.admin.form.input-h', $dt)

        <?php
        $dt = [
            'name' => 'user_activated',
            'text' => 'Cuenta activada',
            'required' => 0,
            'type' => 'checkbox',
        ];
        ?>
        @include('livewire.widgets.admin.form.input-h', $dt)

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

        <?php
        $dt = [
            'name' => 'username',
            'text' => 'Nombre de usuario',
            'required' => 1,
            'type' => 'text',
        ];
        ?>
        @include('livewire.widgets.admin.form.input-h', $dt)


        <?php
        $dt = [
            'name' => 'email',
            'text' => 'Correo electrónico',
            'required' => 1,
            'type' => 'text',
        ];
        ?>
        @include('livewire.widgets.admin.form.input-h', $dt)


        <?php
        $dt = [
            'name' => 'phone',
            'text' => 'Celular',
            'required' => 1,
            'type' => 'text',
        ];
        ?>
        @include('livewire.widgets.admin.form.input-h', $dt)

        <?php
        $dt = [
            'name' => 'user_email_verified',
            'text' => 'Correo verificado',
            'required' => 0,
            'type' => 'checkbox',
        ];
        ?>
        @include('livewire.widgets.admin.form.input-h', $dt)


    </form>

    <div class="separator mb-5"></div>

    <div class="text-right">
        <button class="btn btn-secondary btn-sm"
                wire:click.prevent="closeFrame">
            <b><i class="simple-icon-logout"></i>&nbsp;&nbsp;Regresar</b>
        </button>

        <button type="submit" class="btn btn-secondary btn-sm"
                wire:click.prevent="saveData">
            <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardar</b>
        </button>
    </div>
</div>


