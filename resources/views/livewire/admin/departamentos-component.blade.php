<div class="row">
    <div class="col-md-12">
        <?php
        $buttons = ['is_add' => null]; // button add
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
        @include('livewire.admin.departamento-component.'.$frame)
    @endif
</div>

@push('styles')
    <style>
        .tooltip-- {
            display: inline-block;
            position: relative;
            border-bottom: 1px dotted #666;
            text-align: left;
            z-index: 100;
        }

        .tooltip-- .top {
            min-width:200px;
            top:-20px;
            left:50%;
            transform:translate(-50%, -100%);
            padding:10px 20px;
            color:#444444;
            background-color:#EEEEEE;
            font-weight:normal;
            font-size:13px;
            border-radius:8px;
            position:absolute;
            z-index:99999999;
            box-sizing:border-box;
            box-shadow:0 1px 8px rgba(0,0,0,0.5);
            display:none;
        }

        .tooltip--:hover .top {
            display:block;
        }

        .tooltip-- .top i {
            position:absolute;
            top:100%;
            left:50%;
            margin-left:-12px;
            width:24px;
            height:12px;
            overflow:hidden;
        }

        .tooltip-- .top i::after {
            content:'';
            position:absolute;
            width:12px;
            height:12px;
            left:50%;
            transform:translate(-50%,-50%) rotate(45deg);
            background-color:#EEEEEE;
            box-shadow:0 1px 8px rgba(0,0,0,0.5);
        }
    </style>
@endpush

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {

            window.livewire.on('notification', (mssg) => {
                notificationSwal(`¡${mssg[0]}!`, 'rgba(0,67,124,0.76)');
            });

            window.livewire.on('deleteAlert', () => {
                deleteSwal();
            });
        });
    </script>
@endpush


