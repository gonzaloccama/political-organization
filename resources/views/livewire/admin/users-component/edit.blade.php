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
        <h5 class="card-title text-muted text-uppercase">{{ $user_firstname . ' ' . $user_lastname }}</h5>
        <div class="separator mb-5"></div>
        <div class="scroll">

            @php
                $img = $user_gender == 2 ? 'pwoman.png' : 'pman.png';
                $profile = $user_picture ? $user_picture : $img;
            @endphp

            <div class="row align-items-center">
                <div class="col-md-6 col-sm-6 col-lg-3 col-12 mb-4">
                    <div class="card">
                        <div class="card-body border">
                            <div class="text-center">
                                <img alt="Profile" src="{{ asset('assets/user/images/user/').'/'.$profile }}"
                                     class="img-thumbnail border-0 rounded-circle mb-4 list-thumbnail">
                                <p class="list-item-heading mb-1">{{ $user_firstname . ' ' . $user_lastname }}</p>
                                <button class="btn btn-secondary btn-sm">
                                    <b><i class="simple-icon-eye"></i>&nbsp;&nbsp;Ver perfil</b>
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
                                    <th>ID del usuario</th>
                                    <td>
                                        <span class="badge badge-pill badge-outline-primary">{{ $itemId }}</span>
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <th>Fecha de registro</th>
                                    <td>
                                        <span class="badge badge-pill badge-outline-primary">{{ $created_at }}</span>
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <th>Ultima actividad</th>
                                    <td>
                                        <span class="badge badge-pill badge-outline-primary">{{ $user_seen_at }}</span>
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
                                    <th>Amigos</th>
                                    <td>
                                        <span class="badge badge-pill badge-outline-primary">0</span>
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <th>Seguidos</th>
                                    <td>
                                        <span class="badge badge-pill badge-outline-primary">0</span>
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <th>Seguidores</th>
                                    <td>
                                        <span class="badge badge-pill badge-outline-primary">0</span>
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
                    <ul class="nav nav-tabs nav-fill card-header-tabs border-bottom" role="tablist">
                        <li class="nav-item">
                            <a href="" class="nav-link {{ $profileInner == 'account' ? 'active':'' }}"
                               id="first-tab" wire:click.prevent="accountSection">
                                <h6><i class="simple-icon-settings"></i>&nbsp;&nbsp;<b>CUENTA</b></h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link {{ $profileInner == 'profile' ? 'active':'' }}"
                               id="second-tab" wire:click.prevent="profileSection">
                                <h6><i class="simple-icon-user"></i>&nbsp;&nbsp;<b>PERFIL</b></h6>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">

                    <div class="tab-content">

                            @include('livewire.admin.users-component.profile-edit.'.$profileInner)

                    </div>


                </div>
            </div>
            <div class="text-right mt-4">
                <button class="btn btn-secondary btn-sm"
                        wire:click.prevent="closeFrame">
                    <b><i class="simple-icon-logout"></i>&nbsp;&nbsp;Regresar</b>
                </button>

                <button class="btn btn-danger btn-sm">
                    <b><i class="simple-icon-user-unfollow"></i>&nbsp;&nbsp;Eliminar usuario</b>
                </button>

                <button type="submit" class="btn btn-secondary btn-sm"
                        wire:click.prevent="updateData">
                    <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardar cambios</b>
                </button>
            </div>

        </div>
    </div>
</div>


