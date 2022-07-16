<div class="row">
    <div class="col-md-12">
        <?php
        $buttons = ['is_add' => null]; // button add
        $mode = 'list'; // icon list or box

        //        $actions = [ //static actions table
        //            'view' => null,
        //            'edit' => 'Editar',
        //            'go' => null,
        //            'delete' => null,
        //        ];

        //        $filters = $roles;//add filters

        //        $customs = [ // add custom action table
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
        @include('livewire.admin.system-setting-component.'.$frame)
    @endif
</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/select2.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/select2-bootstrap.min.css') }}"/>
@endpush

@push('scripts')
    <script src="{{ asset('assets/js/vendor/select2.full.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            initSelect2Multiple('#executive', 'executive');

            window.livewire.on('refreshContent', () => {
                initSelect2Multiple('#executive', 'executive');
            });

            window.livewire.on('notification', (mssg) => {
                notificationSwal(`¡${mssg[0]}!`, 'rgba(0,67,124,0.76)');
            });

            window.livewire.on('deleteAlert', () => {
                deleteSwal();
            });

            window.livewire.on('refresh', () => {
                Livewire.emit('refresh')
            });
        });

        function initSelect2Multiple(sel, varModel) {
            if ($().select2) {
                $(sel).select2({
                    theme: "material",
                    // dir: direction,
                    placeholder: "Seleccione...",
                    maximumSelectionSize: 6,
                    containerCssClass: ":all:",
                    "language": {
                        "noResults": function () {
                            return "No se han encontrado resultados";
                        }
                    },
                });
                $(sel).on('change', function (e) {
                    @this.
                    set(varModel, $(this).val());
                });
            }
        }
    </script>
@endpush
