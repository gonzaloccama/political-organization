<div class="card col-md-12">
    <div class="position-absolute card-top-buttons">
        <button class="btn btn-header-light icon-button mr-1" wire:click.prevent="closeFrame">
            <span style="color: white;position: absolute; margin-top: -17px; margin-left: -12px">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="1" fill="none"
                     stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </span>
        </button>
    </div>

    <div class="card-body">
        <h5 class="card-title text-muted text-uppercase">{{ $reference }}</h5>
        <div class="separator mb-5"></div>
        <div class="scroll">
            <div class="card-body border">
                <form action="">

                    <?php
                    $dt = [
                        'name' => 'reference',
                        'text' => 'Referencia',
                        'required' => 1,
                        'type' => 'text',
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.input-h', $dt)

                    <?php
                    $dt = [
                        'name' => 'description',
                        'text' => 'Description',
                        'required' => 1,
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.textarea-h', $dt)

                    <?php
                    $dt = [
                        'name' => 'amount',
                        'text' => 'Monto',
                        'required' => 1,
                        'type' => 'text',
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.input-h', $dt)

                    <?php
                    $dt = [
                        'name' => 'through',
                        'text' => 'A cargo',
                        'required' => 1,
                        'object' => 'fullname',
                        'options' => \App\Models\User::select('users.*')
                            ->selectRaw('CONCAT(users.user_firstname," ",users.user_lastname) as fullname')
                            ->get()
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.select-h', $dt)

                    <?php
                    $dt = [
                        'name' => 'attachment_file',
                        'text' => 'Evidencia',
                        'required' => 0,
                        'type' => 'file',
                        'accept' => 'image',
                        'file' => $attachment_file,
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.input-h', $dt)

                    <?php
                    $dt = [
                        'name' => 'status',
                        'text' => 'Estado de pago',
                        'required' => 0,
                        'type' => 'checkbox',
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.input-h', $dt)

                    <?php
                    $dt = [
                        'name' => 'is_recurrent',
                        'text' => 'Recurrente',
                        'required' => 0,
                        'type' => 'checkbox',
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.input-h', $dt)


                </form>

                <div class="separator mb-5 mt-5"></div>

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
        </div>
    </div>
</div>
