<h5 class="card-title mb-1">Detalles</h5>
<?php
if ($progress[0] == 100) {
    $status = 'completed';
}

$prc = $progress[0] > 97 ? '#317347' : '#1D477A';
if ($status == 'canceled') {
    $prc = '#f63c44';
}
?>

<div class="form-group mb-4">
    <label class="col-form-label mt-3">Progreso</label>
    <div class="border p-3 pb-5">
        <div class="progress-outer mb-5" style="border-color:{{ $prc }}; width: 100%;">
            <div class="progress">
                <div class="progress-bar progress-bar-striped"
                     style="width:{{ $progress[0] }}%; background-color: {{ $prc }};"></div>
                <div class="progress-value" style="color: {{ $prc }};">
                    <span>{{ $progress[0] }}</span>%
                </div>
            </div>
        </div>
        <div class="form-group mb-4" wire:ignore>
            <input type="text" id="progress-value" hidden wire:model="progress">
            <div>
                <div class="slider" id="singleSlider"></div>
            </div>
        </div>
    </div>
</div>

<label class="mt-3 mb-2">Estado</label>
<div class="container mb-4">
<div class="row border pl-0 pb-4 pt-4 pb-4">
    <div class="radio-box col-md-6">
        <input id="not-started" type="radio" wire:model="status" value="not-started">
        <label for="not-started">No iniciado</label>
    </div>
    <div class="radio-box col-md-6">
        <input id="progress" type="radio" wire:model="status" value="progress">
        <label for="progress">Progreso</label></div>
    <div class="radio-box col-md-6">
        <input id="canceled" type="radio" wire:model="status" value="canceled">
        <label for="canceled">Cancelado</label></div>
    <div class="radio-box col-md-6">
        <input id="completed" type="radio" wire:model="status" value="completed">
        <label for="completed">Completado</label>
    </div>
</div>
</div>



<div class="text-right">
    <button type="submit" class="btn btn-secondary btn-sm"
            wire:click.prevent="saveStatus">
        <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardar</b>
    </button>
</div>
