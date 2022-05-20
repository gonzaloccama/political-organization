<div class="card col-md-12">
    <div class="position-absolute card-top-buttons">
        <button class="btn btn-header-light icon-button" wire:click.prevent="closeFrame">
            <span style="color: white;position: absolute; margin-top: -17px; margin-left: -12px; color: #858484;">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="1" fill="none"
                     stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </span>
        </button>
    </div>

    <div class="card-body">
        <h5 class="card-title text-muted text-uppercase pt-0 mt-0 mb-4 title-nowrap">
            {{ $project->title }}
            {{--            {{ strlen($project->title) > 28 ? substr($project->title,0,28)."..." : $project->title }}--}}
        </h5>
        <div class="separator mb-5"></div>

        <div class="card-body border">

            <div class="row">
                <div class="col-md-5 mb-4">
                    <div class="card border-top border-bottom">
                        <div class="card-body">

                            @include('livewire.admin.project-component.items.status')

                        </div>
                    </div>
                </div>
                <div class="col-md-7 mb-4">

                    <div class="card border-top border-bottom">
                        <div class="card-header pl-0 pr-0">
                            <ul class="nav nav-tabs nav-nowrap card-header-tabs  ml-0 mr-0" style="overflow: hidden;"
                                role="tablist">
                                <div class="scrollbar __scroller ml-4 mr-4">
                                    <li class="nav-item w-50 text-center">
                                        <a class="nav-link font-16 {{ $tab == 'overview' ? 'active' : '' }} ml-0 mr-0 pl-0 pr-0"
                                           id="first-tab_" data-toggle="tab" wire:click.prevent="openTab('overview')"
                                           href="#overview-tab" role="tab" aria-controls="first"
                                           aria-selected="{{ $tab == 'overview' ? 'true' : 'false' }}">
                                            Resumen<br/><small>General del trabajo</small>
                                        </a>
                                    </li>

                                    <li class="nav-item w-50 text-center ml-0 mr-0">
                                        <a class="nav-link font-16 {{ $tab == 'discussion' ? 'active' : '' }}"
                                           id="second-tab_" data-toggle="tab" href="#discussion-tab"
                                           wire:click.prevent="openTab('discussion')"
                                           role="tab" aria-controls="second"
                                           aria-selected="{{ $tab == 'discussion' ? 'true' : 'false' }}">Discusión <br/>
                                            <small>Debates acerca del trabajo</small>
                                        </a>
                                    </li>

                                    <li class="nav-item w-50 text-center ml-0 mr-0">
                                        <a class="nav-link font-16 {{ $tab == 'bug' ? 'active' : '' }}"
                                           id="third-tab_" data-toggle="tab" href="#bug-tab"
                                           wire:click.prevent="openTab('bug')"
                                           role="tab" aria-controls="third"
                                           aria-selected="{{ $tab == 'bug' ? 'true' : 'false' }}">Insidencias <br/>
                                            <small>Reporte de insidencias</small>
                                        </a>
                                    </li>

                                    <li class="nav-item w-50 text-center ml-0 mr-0">
                                        <a class="nav-link font-16 {{ $tab == 'file' ? 'active' : '' }}"
                                           id="third-tab_" data-toggle="tab" href="#file-tab"
                                           wire:click.prevent="openTab('file')"
                                           role="tab" aria-controls="third"
                                           aria-selected="{{ $tab == 'file' ? 'true' : 'false' }}">Archivos <br/>
                                            <small>Historial de archivos</small>
                                        </a>
                                    </li>


                                </div>
                            </ul>
                        </div>
                        <div class="card-body">
                            @if($tab)
                                @include('livewire.admin.project-component.tabs.' . $tab)
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="separator mt-4 mb-4"></div>
            <div class="text-right">
                <button class="btn btn-secondary btn-sm"
                        wire:click.prevent="closeFrame">
                    <b><i class="simple-icon-logout"></i>&nbsp;&nbsp;Regresar</b>
                </button>

                {{--                    <button class="btn btn-danger btn-sm" wire:click.prevent="deleteConfirm({{ $itemId }})">--}}
                {{--                        <b><i class="simple-icon-user-unfollow"></i>&nbsp;&nbsp;Eliminar</b>--}}
                {{--                    </button>--}}

                {{--                    <button type="submit" class="btn btn-secondary btn-sm"--}}
                {{--                            wire:click.prevent="updateData">--}}
                {{--                        <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardar cambios</b>--}}
                {{--                    </button>--}}
            </div>
        </div>

    </div>
</div>
