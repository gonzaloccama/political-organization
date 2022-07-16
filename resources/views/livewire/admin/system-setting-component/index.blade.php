<div class="col-md-12">
    <style>
        .menu-right li {
            padding: 7px;
            border: 1px solid #797979;
            /*border-radius: 5px !important;*/
        }

        .menu-right li:hover, .menu-right li a:hover, .menu-right li.active {
            border-color: #1D477A;
            box-shadow: 0 0 2px 0 #1D477A;
            color: #1D477A !important;
            cursor: pointer;
        }

        .menu-right li i {
            padding-right: 10px;
        }
    </style>
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <img src="{{ asset('assets/logos/') . '/' . $edit_logo }}" class="img-thumbnail" alt="">

                    <div class="menu-right mt-3">

                        <div class="separator mt-4 mb-3"></div>

                        <p class="text-muted text-small text-center">
                            <b>Actualizado: </b><br>
                            <?php
                            echo ucfirst(Carbon\Carbon::parse($updated_at)
                                ->locale('es')->translatedFormat('l d \d\e F \d\e\l Y | g:i:s A'));
                            ?>
                        </p>

                        <div class="separator mt-3 mb-5"></div>

                        <ul class="list-unstyled mb-2">
                            <li class="{{ $draw == 'general' ? 'active' : '' }}" wire:click.prevent="content">
                                <i class="simple-icon-screen-tablet"></i> GENERAL
                            </li>
                            <li class="{{ $draw == 'media' ? 'active' : '' }}" wire:click.prevent="content('media')">
                                <i class="simple-icon-calendar"></i> REDES SOCIALES
                            </li>
                            <li class="{{ $draw == 'logo' ? 'active' : '' }}" wire:click.prevent="content('logo')">
                                <i class="simple-icon-picture"></i> LOGOS
                            </li>
                            <li class="{{ $draw == 'mission-vision' ? 'active' : '' }}"
                                wire:click.prevent="content('mission-vision')">
                                <i class="simple-icon-speech"></i> MISIÓN Y VISIÓN
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="position-absolute card-top-buttons">
                        <button class="btn btn-header-light icon-button mr-1" wire:click.prevent="closeFrame">
                            <span style="color: white;position: absolute; margin-top: -17px; margin-left: -12px">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="1"
                                     fill="none"
                                     stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </span>
                        </button>
                    </div>
                    @include('livewire.admin.system-setting-component.contents.content-' . $draw)

                    <div class="separator mb-4 mt-5"></div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-secondary btn-sm"
                                wire:click.prevent="saveData">
                            <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardar cambios</b>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
