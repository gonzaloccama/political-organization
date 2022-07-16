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
        <h5 class="card-title text-muted text-uppercase pt-0 mt-0 mb-4 title-nowrap">{{ $contributor->user->user_firstname . ' ' . $contributor->user->user_lastname }}</h5>
        <div class="separator mb-5"></div>

            <div class="card-body border">

                @include('livewire.admin.contributors-component.contributions.head-contributor', ['dt' => $contributor->user])

                @if(isset($putContribution) && !empty($putContribution))
                    <div class="separator mb-5"></div>
                    @include('livewire.admin.contributors-component.contributions.'.$putContribution)
                @endif

                <div class="separator mb-5"></div>

                @include('livewire.admin.contributors-component.contributions.show-contributions')

                <div class="separator mb-5"></div>
{{--                <form action="">--}}
{{--                    <?php--}}
{{--                    $dt = [--}}
{{--                        'name' => 'c_note',--}}
{{--                        'text' => 'Nota',--}}
{{--                        'required' => 0,--}}

{{--                    ];--}}
{{--                    ?>--}}
{{--                    @include('livewire.widgets.admin.form.textarea-h', $dt)--}}


{{--                </form>--}}
{{--                <div class="separator mt-4 mb-4"></div>--}}
                <div class="text-right">
                    <button class="btn btn-secondary btn-sm"
                            wire:click.prevent="closeFrame">
                        <b><i class="simple-icon-logout"></i>&nbsp;&nbsp;Regresar</b>
                    </button>

                    {{--                    <button class="btn btn-danger btn-sm" wire:click.prevent="deleteConfirm({{ $itemId }})">--}}
                    {{--                        <b><i class="simple-icon-user-unfollow"></i>&nbsp;&nbsp;Eliminar</b>--}}
                    {{--                    </button>--}}

{{--                    <button type="submit" class="btn btn-secondary btn-sm"--}}
{{--                            wire:click.prevent="updateData">--}}
{{--                        <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardar cambios</b>--}}
{{--                    </button>--}}
                </div>
            </div>

    </div>
</div>

