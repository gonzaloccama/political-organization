<div class="card col-md-12">
    <div class="position-absolute card-top-buttons">
        <button class="btn btn-header-light icon-button" wire:click.prevent="closeFrame">
            <span style="color: white;position: absolute; margin-top: -17px; margin-left: -12px">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="1" fill="none"
                     stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </span>
        </button>
    </div>

    <div class="card-body">
        <h5 class="card-title text-muted text-uppercase">{{ $event_title }}</h5>
        <div class="separator mb-5"></div>
        <div class="scroll">

            <div class="row align-items-center">
                <div class="col-md-6 col-sm-6 col-lg-3 col-12 mb-4">
                    <div class="card">
                        <div class="card-body border">
                            <div class="text-center">
                                <img alt="Profile" src="{{ asset('assets/img/profiles/l-1.jpg') }}"
                                     class="img-thumbnail border-0 rounded-circle mb-4 list-thumbnail">
{{--                                <p class="list-item-heading mb-1">{{ $event_title }}</p>--}}
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="simple-icon-eye"></i>&nbsp;&nbsp;Ver evento
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-5 col-12 mb-4">
                    <div class="card ">
                        <div class="card-body border">
                            <table class="table responsive" id="table-user">
                                <tbody>
                                <tr class="align-middle">
                                    <th>ID del evento</th>
                                    <td>
                                        <span class="badge badge-pill badge-outline-primary">{{ $itemId }}</span>
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <th>Fecha de creación</th>
                                    <td>
                                        <span class="badge badge-pill badge-outline-primary">{{ $created_at }}</span>
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <th>privacidad</th>
                                    <td>
                                        <span class="badge badge-pill badge-outline-primary">{{ $event_privacy }}</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6 col-lg-4 col-12 mb-4">
                    <div class="card ">
                        <div class="card-body border">
                            <table class="table responsive" id="table-user">
                                <tbody>
                                <tr class="align-middle">
                                    <th>Invitados</th>
                                    <td>
                                        <span class="badge badge-pill badge-outline-primary">0</span>
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <th>Participantes</th>
                                    <td>
                                        <span class="badge badge-pill badge-outline-primary"> aa </span>
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <th>Admin del Evento</th>
                                    <td>
                                        <span class="badge badge-pill badge-outline-primary"> {{ $admin }} </span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator mb-5"></div>

            <div class="border text mt-4">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs " role="tablist">
                        <li class="nav-item">
                            <a href="" class="nav-link {{ $tabInner == 'setting' ? 'active':'' }}"
                               id="first-tab" wire:click.prevent="settingSection">
                                <h6><i class="simple-icon-settings"></i>&nbsp;&nbsp;<b>CONFIGURACIONES</b></h6>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">

                    <div class="tab-content">

                        @include('livewire.admin.events-component.tab.'.$tabInner)

                    </div>


                </div>
            </div>

        </div>
    </div>
</div>


