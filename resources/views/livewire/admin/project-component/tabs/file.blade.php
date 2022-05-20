<div class="tab-content">
    <div class="tab-pane fade show active" id="{{ $tab }}-tab" role="tabpanel"
         aria-labelledby="first-tab_">
        {{--        <h3 class="card-title p-0 m-0 mb-4 title-1-nowrap"><u>Trabajo:</u> {{ $project->title }}</h3>--}}
        @if($writeNote)
           @include('livewire.admin.project-component.tabs.put-file')
        @endif

        <div class="separator mb-2"></div>
        <div>
            <?php
            $files = $project->projectFile;
            ?>
            <div class="text-right">
                <button class="btn btn-secondary icon-button" style="position: absolute; right: 35px !important;"
                        wire:click.prevent="updateWriteNote('open')">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <h5 class="card-title mb-1">Archivos del trabajo</h5>
            <span class="text-small mt-0 font-italic">
                    Mostrando {{ $c = $files->count() }} {{ $c == 1 ? 'elemento' : 'elementos' }}
                </span>
            <div class="scrollbar scroller" style="height: 320px;">
                <?php
                $hdrs = [
                    'id' => '#',
                    'user_id' => 'Autor',
                    'title' => 'Titulo',
                    'type_file' => 'Archivo',
                    'created_at' => 'Fecha',
                    'not' => '',
                ];
                $dts = $files;
                $fllname = true; // user fullname
                //            $_unit = 'unitM';//Unidad de medida Funtion Model
                            $show = 'file'; // show modal and delete
                $deletion = 'deleteCustomConfirm';
                ?>
                @include('livewire.widgets.admin.table.table-custom')
            </div>

        </div>
    </div>
</div>

