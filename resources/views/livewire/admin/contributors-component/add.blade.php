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
        <h5 class="card-title text-muted text-uppercase pt-0 mt-0 mb-4 title-nowrap">{{ __('Nuevo aportante') }}</h5>
        <div class="separator mb-5"></div>
        <div class="scroll">
            <div class="card-body border">

                @if($user_id)
                    <?php
                    $user = App\Models\User::find($user_id);
                    ?>
                    @include('livewire.admin.contributors-component.contributions.head-contributor', ['dt' => $user])
                    <div class="separator"></div>
                @endif

                <form action="" class="mt-3">
                    <?php
                    $dt = [
                        'name' => 'user_id',
                        'text' => 'Seleccione un aportante',
                        'required' => 1,
                        'object' => 'fullname',
                        'options' => \App\Models\User::select('users.*')
                            ->whereNull('contributors.user_id')
                            ->leftJoin('contributors', 'contributors.user_id', 'users.id')
                            ->selectRaw('CONCAT(users.user_firstname," ",users.user_lastname) as fullname')
                            ->get()
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.select-h', $dt)

                </form>

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




