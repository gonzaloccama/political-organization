<div class="card col-md-12">
    <div class="position-absolute card-top-buttons">
        <button class="btn btn-header-light icon-button mr-1" wire:click.prevent="closeFrame">
            <span style="color: white;position: absolute; margin-top: -17px; margin-left: -12px">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="1" fill="none"
                     stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </span>
        </button>
    </div>

    <div class="card-body">
        <h5 class="card-title text-muted text-uppercase">{{ $title }}</h5>
        <div class="separator mb-5"></div>

        <div class="card-body border">
            <form action="">

                <?php
                $dt = [
                    'name' => 'title',
                    'text' => 'Título',
                    'required' => 1,
                    'type' => 'text',
                ];
                ?>
                @include('livewire.widgets.admin.form.input-h', $dt)

                <?php
                $dt = [
                    'name' => 'abstract',
                    'text' => 'Resumen',
                    'required' => 1,

                ];
                ?>
                @include('livewire.widgets.admin.form.textarea-h', $dt)

                <?php
                $dt = [
                    'name' => 'content',
                    'text' => 'Contenido',
                    'required' => 1,

                ];
                ?>
                @include('livewire.widgets.admin.form.textarea-h', $dt)

                <?php
                $dt = [
                    'name' => 'population',
                    'text' => 'Población',
                    'required' => 1,
                    'type' => 'text',
                ];
                ?>
                @include('livewire.widgets.admin.form.input-h', $dt)

                <?php
                $dt = [
                    'name' => 'region',
                    'text' => 'Región',
                    'required' => 1,
                    'object' => 'name',
                    'options' => \App\Models\Region::all()
                ];
                ?>
                @include('livewire.widgets.admin.form.select-h', $dt)

                <?php
                $dt = [
                    'name' => 'province',
                    'text' => 'Provincia',
                    'required' => 1,
                    'object' => 'name',
                    'options' => \App\Models\Region::find($region)->provinces ?? []
                ];
                ?>
                @include('livewire.widgets.admin.form.select-h', $dt)

                <?php
                $dt = [
                    'name' => 'town',
                    'text' => 'Distrito',
                    'required' => 1,
                    'object' => 'name',
                    'options' => \App\Models\Province::find($province)->towns ?? []
                ];
                ?>
                @include('livewire.widgets.admin.form.select-h', $dt)

                <?php
                $dt = [
                    'name' => 'location',
                    'text' => 'Localización',
                    'required' => 1,
                    'type' => 'text',
                ];
                ?>
                @include('livewire.widgets.admin.form.input-h', $dt)

                <?php
                $dt = [
                    'name' => 'file',
                    'text' => 'Archivo',
                    'required' => 0,
                    'type' => 'file',
                    'accept' => 'pdf',
                    'file' => $file,
//                    'preview' => $editFile,
                ];
                ?>
                @include('livewire.widgets.admin.form.input-h', $dt)

                    @if($file)
                        <div id="file"></div>
                    @endif

                <?php
                $dt = [
                    'name' => 'files',
                    'text' => 'Imagenes',
                    'required' => 0,
                    'type' => 'file',
                    'accept' => 'image',
                    'file' => $files,
                    'multiple' => 1,
//                    'preview' => $editFile,
                ];
                ?>
                @include('livewire.widgets.admin.form.input-h', $dt)

            </form>

            <div class="separator mb-5 mt-5"></div>

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
