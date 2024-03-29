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
        <h5 class="card-title text-muted text-uppercase pt-0 mt-0 mb-4 title-nowrap">{{ $title }}</h5>
        <div class="separator mb-5"></div>
        <div class="scroll">
            <div class="card-body border">
                <form action="">

                    <?php
                    $dt = [
                        'name' => 'title',
                        'text' => 'Título',
                        'required' => 1,
                        'type' => 'text',
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.input-h', $dt)


                    <?php
                    $dt = [
                        'name' => 'summary',
                        'text' => 'Resumen',
                        'required' => 1,
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.textarea-h', $dt)

                    <?php
                    $dt = [
                        'name' => 'description',
                        'text' => 'Descripción',
                        'required' => 1,
                        'wire' => 1,
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.textarea-h', $dt)

                    <?php
                    $dt = [
                        'name' => 'responsible',
                        'text' => 'Responsable',
                        'required' => 1,
                        'object' => 'fullname',
                        'options' => \App\Models\User::select('users.*')
                            ->selectRaw('CONCAT(users.user_firstname," ",users.user_lastname) as fullname')
                            ->get(),
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.select-h', $dt)

                    <div wire:loading.remove wire:target="responsible">
                        <?php
                        $dt = [
                            'name' => 'team',
                            'text' => 'Equipo',
                            'required' => 1,
                            'multiple' => 1,
                            'object' => 'fullname',
                            'options' => \App\Models\User::select('users.*')
                                ->where('id', '!=', $responsible)
                                ->selectRaw('CONCAT(users.user_firstname," ",users.user_lastname) as fullname')
                                ->get(),
                        ];
                        ?>
                        @include('livewire.widgets.admin.form.select-h', $dt)
                    </div>

                    <?php
                    $dt = [
                        'name' => 'priority',
                        'text' => 'Prioridad',
                        'required' => 1,
                        'object' => 'name',
                        'options' => \App\Models\Priority::all(),
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.select-h', $dt)


                    <?php
                    $dt = [
                        'name' => 'estimated_hours',
                        'text' => 'Horas estimadas',
                        'required' => 1,
                        'type' => 'text',
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.input-h', $dt)

                    <?php
                    $dt = [
                        'name' => 'start_date',
                        'text' => 'Fecha de inicio',
                        'required' => 1,
                        'type' => 'text',
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.input-h', $dt)

                    <?php
                    $dt = [
                        'name' => 'end_date',
                        'text' => 'Fecha de culmonación',
                        'required' => 1,
                        'type' => 'text',
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.input-h', $dt)

                    <?php
                    $dt = [
                        'name' => 'note',
                        'text' => 'Nota',
                        'required' => 0,
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.textarea-h', $dt)

                </form>

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
        </div>
    </div>
</div>
