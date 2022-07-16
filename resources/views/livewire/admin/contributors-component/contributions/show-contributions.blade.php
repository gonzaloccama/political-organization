<div class="row">
    <div class="col-md-5 mb-4">
        <div class="card border">
            <div class="card-body">

                <div class="position-absolute card-top-buttons">
                    <button class="btn btn-secondary icon-button" wire:click.prevent="updatePutContribution('cash')">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <h5 class="card-title mb-1">Dinero en efectivo</h5>
                <span class="text-small mt-0 font-italic">
                    Mostrando {{ $c = $contributor->cashContribution->count() }} {{ $c == 1 ? 'elemento' : 'elementos' }}
                </span>
                <div class="scrollbar scroller" style="height: 320px; font-size:10px">
                    <?php
                    $hdrs = [
                        'id' => '#',
                        'amount' => 'Monto',
                        'type_file' => 'Evidencia',
                        'created_at' => 'Fecha',
                        'not' => '',
                    ];
                    $show = 'cash';//Show Modal and delete
                    $dts = $contributor->cashContribution; //data show in table
                    $deletion = 'deleteCustomConfirm';
                    ?>
                    @include('livewire.widgets.admin.table.table-custom')
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7 mb-4">
        <div class="card border">
            <div class="card-body">
                <div class="position-absolute card-top-buttons">
                    <button class="btn btn-secondary icon-button"
                            wire:click.prevent="updatePutContribution('materials')">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                <h5 class="card-title mb-1">Recursos</h5>
                <span class="text-small mt-0 font-italic">
                    Mostrando {{ $c = $contributor->materialContribution->count() }} {{ $c == 1 ? 'elemento' : 'elementos' }}
                </span>
                <div class="scrollbar scroller" style="height: 320px;font-size:10px">
                    <?php
                    $hdrs = [
                        'id' => '#',
                        'material' => 'Material',
                        'quantity' => 'Cant.',
                        'unit' => 'Medida',
                        'type_file' => 'Evidencia',
                        'created_at' => 'Fecha',
                        'not' => '',
                    ];
                    $dts = $contributor->materialContribution;
                    $_unit = 'unitM';//Unidad de medida Funtion Model
                    $show = 'materials'; // show modal and delete
                    $deletion = 'deleteCustomConfirm';
                    ?>
                    @include('livewire.widgets.admin.table.table-custom')
                </div>

            </div>
        </div>
    </div>
</div>
