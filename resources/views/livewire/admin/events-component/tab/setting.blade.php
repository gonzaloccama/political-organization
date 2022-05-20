<div class="tab-pane fade show active">
    <form action="">

        <?php
        $dt = [
            'name' => 'event_title',
            'text' => 'Nombre del evento',
            'required' => 1,
            'type' => 'text',
        ];
        ?>
        @include('livewire.widgets.admin.form.input-h', $dt)

        <?php
        $dt = [
            'name' => 'event_location',
            'text' => 'Localización',
            'required' => 1,
            'type' => 'text',
        ];
        ?>
        @include('livewire.widgets.admin.form.input-h', $dt)

        <?php
        $dt = [
            'name' => 'event_start_date',
            'text' => 'Fecha de inicio',
            'required' => 1,
            'type' => 'text',
        ];
        ?>
        @include('livewire.widgets.admin.form.input-h', $dt)


        <?php
        $dt = [
            'name' => 'event_end_date',
            'text' => 'Fecha final',
            'required' => 1,
            'type' => 'text',
        ];
        ?>
        @include('livewire.widgets.admin.form.input-h', $dt)


        <?php
        $dt = [
            'name' => 'event_privacy',
            'text' => 'Seleccionar privacidad',
            'required' => 1,
            'object' => null,
            'options' => ['public' => 'Público', 'closed' => 'Cerrado', 'secret' => 'Secreto'],
        ];
        ?>
        @include('livewire.widgets.admin.form.select-h', $dt)

        <?php
        $dt = [
            'name' => 'event_category',
            'text' => 'Categoria',
            'required' => 1,
            'object' => 'category_name',
            'options' => \App\Models\EventsCategory::all(),
        ];
        ?>
        @include('livewire.widgets.admin.form.select-h', $dt)

        <?php
        $dt = [
            'name' => 'event_description',
            'text' => 'Sobre el evento',
            'required' => 1,
        ];
        ?>
        @include('livewire.widgets.admin.form.textarea-h', $dt)

    </form>

    <div class="separator mb-5"></div>

    <div class="text-right">
        <button class="btn btn-secondary btn-sm"
                wire:click.prevent="closeFrame">
            <b><i class="simple-icon-logout"></i>&nbsp;&nbsp;Regresar</b>
        </button>

        <button class="btn btn-danger btn-sm" wire:click.prevent="deleteConfirm({{ $itemId }})">
            <b><i class="simple-icon-user-unfollow"></i>&nbsp;&nbsp;Eliminar</b>
        </button>

        <button type="submit" class="btn btn-secondary btn-sm"
                wire:click.prevent="updateData">
            <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardar cambios</b>
        </button>
    </div>
</div>
