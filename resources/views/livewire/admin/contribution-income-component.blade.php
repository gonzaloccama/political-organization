<div class="row">
    <div class="col-md-12">
        <?php
        $buttons = ['is_add' => null]; // button add
        $mode = 'list'; // icon list or box

        $actions = [ //static actions table
            'view' => null,
            'edit' => null,
            'go' => 'Ver aportante',
            'delete' => null,
        ];

        $navigateTo = 'contributor'; //relationship on table

        /*** status custom ***/
        $_statusIndex = [ // $_status or $_statusIndex
            '0' => 'No pagado',
            '1' => 'Pagado',
        ];

        $_statusRecurrent = [ // $_status or $_statusIndex
            '0' => 'No Recurrente',
            '1' => 'Recurrente',
        ];

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
        @include('livewire.admin.contribution-income-component.'.$frame)
    @endif
</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/select2.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/select2-bootstrap.min.css') }}"/>
@endpush

@push('scripts')
    <script src="{{ asset('assets/js/vendor/select2.full.js') }}"></script>
    <script src="{{ asset('assets/plugins/ckeditor5/ckeditor.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            window.livewire.on('refreshContent', () => {
                initSelect2Multiple('#through', 'through');
            });

            window.livewire.on('refreshSection', () => {
                activeCkeditor('#description', 'description');
            });

            window.livewire.on('notification', (mssg) => {
                notificationSwal(`¡${mssg[0]}!`, mssg[1] ? mssg[1] : 'rgba(0,67,124,0.76)');
            });

            window.livewire.on('deleteAlert', () => {
                deleteSwal();
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

        function activeCkeditor(sel, varModel) {
            if (typeof ClassicEditor !== "undefined") {
                ClassicEditor
                    .create(document.querySelector(sel), {
                        // The language code is defined in the https://en.wikipedia.org/wiki/ISO_639-1 standard.
                        language: 'es',
                    })
                    .then(editor => {
                        // editor.setData('');
                        editor.model.document.on('change:data', () => {
                            @this.
                            set(varModel, editor.getData());
                        });
                    })
                    .catch(function (error) {
                    });
            }
        }
    </script>
@endpush

