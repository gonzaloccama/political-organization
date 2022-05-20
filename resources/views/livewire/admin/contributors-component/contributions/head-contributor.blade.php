<?php
$img = $dt->user_gender == 2 ? 'woman.svg' : 'man.svg';
$profile = $dt->user_cover ? $dt->user_cover : $img;
?>
<div class="row">
    <div class="col-md-6 mb-2">
        <div class="card border-top border-bottom d-flex flex-row mb-4" style="height: 150px">
            <a class="d-flex" href="#">
                <img alt="Profile" src="{{ asset('assets/images/users') . '/' . $profile }}"
                     class="img-thumbnail border-0 rounded-circle m-4 list-thumbnail align-self-center">
            </a>
            <div class=" d-flex flex-grow-1 min-width-zero">
                <div
                    class="card-body pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                    <div class="min-width-zero">
                        <a href="#">
                            <p class="list-item-heading mb-1 truncate">{{ $dt->user_firstname . ' ' . $dt->user_lastname }}</p>
                        </a>
                        <p class="mb-2 text-muted text-small">{{ $dt->user_role->name ?? '' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card border-top border-bottom mb-2" style="height: 150px">
            <div class="card-body">

                <p class="mb-0 text-semi-muted">
                    <b><abbr title="DNI">DNI:</abbr></b> {{ $dt->user_dni }}
                </p>
                <p class="mb-0 text-semi-muted">
                    <b><abbr title="DNI">CELULAR:</abbr></b> {{ $dt->phone }}
                </p>
                <p class="mb-0 text-semi-muted">
                    <b><abbr
                            title="DNI">GENERO:</abbr></b> {{ $dt->u_gender->gender ?? '' }}
                </p>
                <p class="mb-0 text-semi-muted">
                    <b><abbr title="DNI">DIRECCiÓN:</abbr></b> {{ $dt->user_address }}
                </p>
            </div>
        </div>
    </div>
</div>

@if($itemId)
    <div class="row">
        <div class="col-md-4 mb-5">
            <?php
            $amount = \App\Models\CashContribution::where('contributor_id', $itemId)->sum('amount');
            ?>
            <div class="card border-top border-bottom">
                <div class="card-body text-center mb-0">
                    <i class="iconsminds-coins text-theme-1" style="font-size: 35px; font-weight: 800 !important;"></i>
                    <p class="card-text mb-0">Monto Aportado</p>
                    <p class="lead text-center text-theme-1 mb-0">S/ {{ number_format($amount, 2, '.', ',') }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-5">
            <?php
            $mC = \App\Models\MaterialContribution::where('contributor_id', $itemId)->count();
            $cC = \App\Models\CashContribution::where('contributor_id', $itemId)->count();
            ?>
            <div class="card border-top border-bottom">
                <div class="card-body text-center mb-0">
                    <i class="iconsminds-files text-theme-1" style="font-size: 35px; font-weight: 800 !important;"></i>
                    <p class="card-text mb-0">Número de aportes</p>
                    <p class="lead text-center text-theme-1 mb-0">{{ number_format($mC + $cC, 0, '.', ',') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-5">

            <div class="card border-top border-bottom">
                <div class="card-body text-center mb-0">
                    <i class="iconsminds-box-close text-theme-1" style="font-size: 35px; font-weight: 800 !important;"></i>
                    <p class="card-text mb-0">Cantidad de materiales</p>
                    <p class="lead text-center text-theme-1 mb-0">{{ $mC }}</p>
                </div>
            </div>
        </div>
    </div>
@endif
