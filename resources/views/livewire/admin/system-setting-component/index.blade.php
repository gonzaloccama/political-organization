<div class="col-md-12">
    <div class="icon-cards-row">
        <?php
        use App\Models\CashContribution;use App\Models\Expense;
        $income_contribution = CashContribution::sum('amount');
        $income = \App\Models\Income::sum('amount');
        $all_income = $income_contribution + $income;
        ?>

        <div class="glide dashboard-income">
            <div class="glide__track" data-glide-el="track">
                <ul class="glide__slides">
                    <li class="glide__slide">
                        <a href="#" class="card">
                            <div class="card-body text-center">
                                <i class="iconsminds-wallet"></i>
                                <p class="card-text mb-0">Total de Ingresos (S/)</p>
                                <p class="lead text-center" style="font-size: 1.4rem !important;">
                                    {{ 'S/ ' . number_format($all_income, 2, '.', ',') }}
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="glide__slide">
                        <a href="#" class="card">
                            <div class="card-body text-center">
                                <i class="iconsminds-financial"></i>
                                <p class="card-text mb-0">Ingresos por aportes (S/)</p>
                                <p class="lead text-center" style="font-size: 1.4rem !important;">
                                    {{ 'S/ ' . number_format($income_contribution, 2, '.', ',') }}
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="glide__slide">
                        <a href="#" class="card">
                            <div class="card-body text-center">
                                <i class="iconsminds-coins"></i>
                                <p class="card-text mb-0">Otros ingresos (S/)</p>
                                <p class="lead text-center" style="font-size: 1.4rem !important;">
                                    {{ 'S/ ' . number_format($income, 2, '.', ',') }}
                                </p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>

<div class="col-md-12">
    <div class="icon-cards-row">
        <?php

        $expense = \App\Models\Expense::sum('amount');
        $expense_today = Expense::whereBetween('created_at', [
            Carbon\Carbon::today()->subDays(7)->format('Y-m-d') . ' 00:00:00',
            Carbon\Carbon::today()->format('Y-m-d') . ' 23:59:59'
        ])->sum('amount');

        $balance = $all_income - $expense;
        ?>
        <div class="glide dashboard-expense">
            <div class="glide__track" data-glide-el="track">
                <ul class="glide__slides">
                    <li class="glide__slide">
                        <a href="#" class="card">
                            <div class="card-body text-center">
                                <i class="simple-icon-layers"></i>
                                <p class="card-text mb-0">Saldo (S/)</p>
                                <p class="lead text-center" style="font-size: 1.4rem !important;">
                                    {{ 'S / ' . number_format($balance, 2, '.', ',') }}
                                </p>
                            </div>
                        </a>
                    </li>

                    <li class="glide__slide">
                        <a href="#" class="card">
                            <div class="card-body text-center">
                                <i class="iconsminds-handshake"></i>
                                <p class="card-text mb-0">Total de Egresos (S/)</p>
                                <p class="lead text-center" style="font-size: 1.4rem !important;">
                                    {{ 'S / ' . number_format($expense, 2, '.', ',') }}
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="glide__slide">
                        <a href="#" class="card">
                            <div class="card-body text-center">
                                <i class="iconsminds-calendar-4"></i>
                                <p class="card-text mb-0">Egreso semanal (S/)</p>
                                <p class="lead text-center" style="font-size: 1.4rem !important;">
                                    {{ 'S / ' . number_format($expense_today, 2, '.', ',') }}
                                </p>
                            </div>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>

</div>


<div class="col-md-12">
    <div class="icon-cards-row">
        <?php

        $all_users = \App\Models\User::all()->count();
        $baned_users = \App\Models\User::where('user_activated', '0')->where('user_banned', '1')->get()->count();
        $posts = \App\Models\Post::all()->count();


        ?>



        <div class="glide dashboard-users">
            <div class="glide__track" data-glide-el="track">
                <ul class="glide__slides">
                    <li class="glide__slide">
                        <a href="#" class="card">
                            <div class="card-body text-center">
                                <i class="iconsminds-business-mens"></i>
                                <p class="card-text mb-0">Usuarios</p>
                                <p class="lead text-center" style="font-size: 1.4rem !important;">
                                    {{ $all_users }}
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="glide__slide">
                        <a href="#" class="card">
                            <div class="card-body text-center">
                                <i class="simple-icon-user-unfollow"></i>
                                <p class="card-text mb-0">Inactivos</p>
                                <p class="lead text-center" style="font-size: 1.4rem !important;">
                                    {{ $baned_users }}
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="glide__slide">
                        <a href="#" class="card">
                            <div class="card-body text-center">
                                <i class="iconsminds-notepad"></i>
                                <p class="card-text mb-0">Publicaciones</p>
                                <p class="lead text-center" style="font-size: 1.4rem !important;">
                                    {{ $posts }}
                                </p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>
