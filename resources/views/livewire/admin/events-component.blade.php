<div class="row">
    <div class="col-md-12">
        <?php
        $buttons = ['is_add' => false]; // button add
        $mode = 'list'; // icon list or box

        $actions = [ //static actions table
            'view' => null,
            'edit' => 'Editar',
            'go' => null,
            'delete' => 'Eliminar',
        ];
        //        $filters = $roles;//filters

        //        $customs = [ // custom action table
        //            'txt' => 'Estado', //static
        //            'actions' => [ //editable
        //                'delivered' => 'updateOrderStatus',
        //                'completed' => 'updateOrderStatus',
        //                'canceled' => 'updateOrderStatus',
        //            ],
        //            'inputs' => [ //static
        //                'one' => 'id',
        //                'two' => 'status',
        //            ],
        //        ];
        ?>

        @include('livewire.widgets.admin.header.title-page')
    </div>
    @if($frame)
        @include('livewire.admin.events-component.'.$frame)
    @endif
</div>
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/select2.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/flatpickr/flatpickr.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('assets/js/vendor/select2.full.js') }}"></script>

    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.js') }}"></script>
    {{--    <script src="{{ asset('assets/plugins/flatpickr/es.js') }}"></script>--}}

    <script type="text/javascript">
        $(document).ready(function () {

            window.livewire.on('refreshContent', () => {
                activeSelect2('#event_privacy', 'event_privacy');
                activeSelect2('#event_category', 'event_category');
            });

            window.livewire.on('refreshPicker', () => {
                activeFlatpickr('#event_start_date', 1);
                activeFlatpickr('#event_end_date', 1);
            });

            window.livewire.on('notification', (mssg) => {
                notificationSwal(`¡${mssg[0]}!`, 'rgba(0,67,124,0.76)');
            });

            window.livewire.on('deleteAlert', () => {
                deleteSwal();
            });
        });

        function activeSelect2(sel, varModel) {
            $(sel).select2({theme: `material`});
            $(sel).on('change', function (e) {
                @this.
                set(varModel, e.target.value);
            });
        }

        function activeFlatpickr(sel, is_time = 0) {
            $(sel).flatpickr({
                enableTime: !!is_time,
                dateFormat: `${is_time ? 'Y-m-d H:i' : 'Y-m-d'}`,
                disableMobile: "true",
                // "locale": "es"
            });
        }
    </script>
@endpush



