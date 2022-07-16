<div class="row">
    <div class="col-md-12">
        <?php
        $buttons = ['is_add' => $frame == 'index']; // button add
        $mode = 'list'; // icon list or box

        $actions = [ //static actions table
            'view' => null,
            'show' => 'Ver y editar trabajo',
            'edit' => 'Editar',
            'go' => null,
            'delete' => 'Eliminar',
        ];

        /*** status custom ***/
        $_status = [ // $_statusIndex
            'not-started' => 'No iniciado',
            'progress' => 'En progreso',
            'canceled' => 'Cancelado',
            'completed' => 'Completado',
        ];

        //        $filters = $roles;//filters

        //        $customs = [ // custom action table
        /** one button **/
        //            'button' => 'Ver Aportes',
        //            'action' => 'edit',
        /** dropdown **/
        //                    'txt' => 'Estado', //static
        //                    'actions' => [ //editable
        //                        'delivered' => 'updateOrderStatus',
        //                        'completed' => 'updateOrderStatus',
        //                        'canceled' => 'updateOrderStatus',
        //                    ],
        //                    'inputs' => [ //static
        //                        'one' => 'id',
        //                        'two' => 'status',
        //                    ],
        //        ];
        ?>

        @include('livewire.widgets.admin.header.title-page')
    </div>
    @if($frame)
        @include('livewire.admin.project-component.'.$frame)
    @endif

    @if($modal)
        @include('livewire.admin.project-component.tabs.' . $modal)
    @endif
</div>
@push('styles')
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/vendor/select2.min.css') }}"/>--}}

    <link rel="stylesheet" href="{{ asset('assets/css/vendor/nouislider.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/select2.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/select2-bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/flatpickr/flatpickr.css') }}">

    <style>

        .__scroller::-webkit-scrollbar {
            border-radius: 10px;
            width: 5px;
            height: 5px;
            background-color: #ddd;
        }

        .__scroller::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            /*background-color: rgba(221, 221, 221, 0.65);*/
            border-radius: 10px;
        }

        .__scroller::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background-color: #38688b;
        }

        .btn-header-warning {
            color: #f38d49;
            border-color: transparent;
            background: transparent;
            margin-top: -8px;
            margin-right: -8px;
        }

        .btn-header-warning:hover {
            background-color: transparent;
            border-color: rgba(243, 141, 73, 0.75);
            color: rgba(243, 141, 73, 0.75);
        }
    </style>
@endpush
@push('scripts')
    {{--        <script src="{{ asset('assets/js/vendor/ckeditor5-build-classic/ckeditor.js') }}"></script>--}}

    <script src="{{ asset('assets/js/vendor/nouislider.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/ckeditor5/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/plugins/ckeditor5/translations/es.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/select2.full.js') }}"></script>

    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/plugins/flatpickr/es.js') }}"></script>

    <script type="text/javascript">

        $(document).ready(function () {

            window.livewire.on('refreshContent', () => {
                initSelect2Multiple('#team', 'team');
                initSelect2Multiple('#responsible', 'responsible');
                initSelect2Multiple('#priority', 'priority');
                initTooltip();
            });

            window.livewire.on('refreshSection', () => {
                activeCkeditor('#description', 'description');
                activeCkeditor('#note', 'note');

                activeFlatpickr('#start_date');
                activeFlatpickr('#end_date');
            });

            window.livewire.on('refreshTab', () => {
                activeCkeditor('#discussion', 'discussion');
                activeCkeditor('#bug_note', 'bug_note');
            });

            window.livewire.on('noviSlider', () => {
                initNoVi('#singleSlider');
            });

            window.livewire.on('notification', (mssg) => {
                notificationSwal(`¡${mssg[0]}!`, 'rgba(0,67,124,0.76)');
                if (mssg[1]) {
                    Livewire.emit('refresh');
                }
            });

            window.livewire.on('onlyRefresh', () => {
                Livewire.emit('refresh');
            });

            window.livewire.on('deleteAlert', () => {
                deleteSwal();
            });

            window.livewire.on('deleteCustom', () => {
                deleteCustom();
            });

            window.livewire.on('showModal', () => {
                $('#showModal').modal('show');
            });
        });

        function activeSelect2(sel, varModel) {
            $(sel).select2({
                theme: `material`,
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
                set(varModel, e.target.value);
                {{--                @this.set(varModel, $(this).val());--}}
            });
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

        function destroyCkeditor(sel) {
            ClassicEditor
                .create(document.querySelector(sel))
                .then( editor => editor.destroy() )
                .catch(function (error) {
                });
        }

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


        function activeFlatpickr(sel, is_time = 0) {
            $(sel).flatpickr({
                enableTime: !!is_time,
                dateFormat: `${is_time ? 'Y-m-d H:i' : 'Y-m-d'}`,
                disableMobile: "true",
                "locale": "es"
            });
        }

        function initNoVi(sel, start) {
            var slider = document.getElementById(sel);
            noUiSlider.create($(sel)[0], {
                start: [$('#progress-value').val()],
                connect: true,
                tooltips: true,
                // direction: direction,
                range: {
                    min: [0],
                    max: [100]
                },
                step: 1,
                format: {
                    to: function (value) {
                        return $.fn.addCommas(Math.round(value));
                    },
                    from: function (value) {
                        return value;
                    }
                }
            });

            $(sel)[0].noUiSlider.on('update', function (value) {
                @this.
                set('progress', value);
            });

        }

        function initTooltip() {
            let tooltip_ = $('[data-toggle="tooltip"]');

            tooltip_.tooltip('dispose');
            tooltip_.tooltip('hide');
            tooltip_.tooltip();
        }

        function deleteCustom() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-primary ml-3',
                    cancelButton: 'btn btn-danger mr-3',
                    popup: 'swal-modal-delete',
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: '¿Estas seguro?',
                text: "¡No podrás revertir esto esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, Eliminarlo!',
                cancelButtonText: 'No, Cancelar!',
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emit('customConfirm');

                    swalWithBootstrapButtons.fire(
                        '¡Eliminado!',
                        'El registro ha sido eliminado. <i class="far fa-dizzy text-danger"></i>',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        '¡Cancelado!',
                        'Tu registro está a salvo <i class="far fa-smile-beam text-primary"></i>',
                        'error'
                    )
                }
            })
        }


    </script>
@endpush
