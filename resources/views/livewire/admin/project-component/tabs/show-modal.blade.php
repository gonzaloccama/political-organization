<div wire:ignore.self class="modal fade" id="showModal" role="dialog"
     aria-labelledby="showModal" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    {{ $showFile->title }}
                </h5>
                <button type="button" wire:click="closeFile" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                @if($showFile->type_file == 'document')
                    <object data="{{ asset('assets/uploads/projects/') . '/' . $showFile->attachment_file }}"
                            width="100%" style="min-height: 480px; max-height: 780px;"></object>
                @elseif($showFile->type_file == 'image')
                    <img src="{{ asset('assets/uploads/projects/') . '/' . $showFile->attachment_file }}"
                         alt="{{ $showFile->attachment_file }}" width="100%">
                @endif
                <div class="container">
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h3 class="text-theme-1"><u>Trabajo:</u></h3>
                            <p>
                                {{ $showFile->project->title }}
                            </p>

                            <h3 class="text-theme-1"><u>Author:</u></h3>
                            <p>
                                {{ $showFile->user->fullname }}
                            </p>

                            <h3 class="text-theme-1"><u>Fecha de subida del archivo:</u></h3>
                            <p>
                                <?php
                                echo ucfirst(Carbon\Carbon::parse($showFile->created_at)
                                    ->locale('es')->translatedFormat('l d \d\e F \d\e\l Y | g:i:s A'));
                                ?>
                            </p>

                        </div>
                        <div class="col-md-6">
                            <h3 class="text-theme-1"><u>Titulo:</u></h3>
                            <p>{{ $showFile->title }}</p>

                            <h3 class="text-theme-1"><u>Nota:</u></h3>
                            <p>
                                {{ $showFile->note }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="closeFile" class="btn btn-outline-primary" data-dismiss="modal">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
