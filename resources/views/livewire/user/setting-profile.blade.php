@push('title') {{ $_title }} @endpush
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="iq-card rounded-0">
                <div class="iq-card-body p-0">
                    <div class="iq-edit-list">
                        <ul class="iq-edit-profile d-flex nav nav-pills">
                            <?php
                            $stts_pwd = !isset(auth()->user()->user_google_id);
                            $tabs_panes = [
                                (object)['tab' => 'personal-information', 'name' => 'Información Personal', 'stts' => 1],
                                (object)['tab' => 'chang-pwd', 'name' => 'Cambiar la contraseña', 'stts' => $stts_pwd],
                                (object)['tab' => 'links-social', 'name' => 'Redes Sociales', 'stts' => 1],
                                (object)['tab' => 'privacy', 'name' => 'Privacidad', 'stts' => 1],
                            ];
                            ?>
                            @foreach($tabs_panes as $tab)
                                @if($tab->stts)
                                    <li class="col-md-3 p-0">
                                        <a class="nav-link rounded-0 font-rajdhani font-size-18 {{ $tab_pane == $tab->tab ? 'active' : '' }}"
                                           wire:click.prevent="active_tab('{{ $tab->tab }}')"
                                           data-toggle="pill" href="#{{ $tab->tab }}">
                                            {{ $tab->name }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="iq-edit-list-data">
                <div class="tab-content">
                    @include('livewire.user.setting-profile.tab-' . $tab_pane)
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/flatpickr/flatpickr.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/plugins/flatpickr/es.js') }}"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            activeSelect2('#user_gender', 'user_gender');
            activeSelect2('#user_relationship', 'user_relationship');
            activeSelect2('#user_region', 'user_region');
            activeSelect2('#user_province', 'user_province');
            activeSelect2('#user_current_city', 'user_current_city');

            activeFlatpickr('#user_birthdate', 'user_birthdate', 0);

            window.livewire.on('refreshSection', () => {
                activeFlatpickr('#user_birthdate', 'user_birthdate', 0);
            });

            window.livewire.on('refreshContent', () => {
                activeSelect2('#user_gender', 'user_gender');
                activeSelect2('#user_relationship', 'user_relationship');
                activeSelect2('#user_region', 'user_region');
                activeSelect2('#user_province', 'user_province');
                activeSelect2('#user_current_city', 'user_current_city');
            });
        });

        $(document).ready(function () {
            window.livewire.on('alertSaved', () => {
                notificationSwal('¡Los cambios se guardaron extisomente!', 'rgba(47,122,67,0.89)');
            });
        });

        function activeSelect2(sel, varModel) {
            $(sel).select2({
                placeholder: "Seleccione...",
            });
            $(sel).on('change', function (e) {
                @this.set(varModel, e.target.value);
            });
        }

        function activeFlatpickr(sel, varModel, is_time = 0) {
            $(sel).flatpickr({
                enableTime: !!is_time,
                dateFormat: `${is_time ? 'Y-m-d H:i' : 'Y-m-d'}`,
                disableMobile: "true",
                "locale": "es",
                // onChange: function (e) {
                // @this.set(varModel, e.target.value);
                // }
            });
        }
    </script>
@endpush
