<div class="tab-content">
    <div class="tab-pane fade show active" id="{{ $tab }}" role="tabpanel"
         aria-labelledby="first-tab_">
{{--        <h3 class="card-title p-0 m-0 mb-4 title-1-nowrap"><u>Trabajo:</u> {{ $project->title }}</h3>--}}

        <table class="table table-hover scrollbar scroller mt-4">
            <tr>
                <th class="align-middle">Prioridad</th>
                <td class="align-middle">{{ $project->priorityN->name }}</td>
            </tr>
            <tr>
                <th class="align-middle">Horas estimadas</th>
                <td class="align-middle">
                    {{ $project->estimated_hours == 1 ? $project->estimated_hours . ' Hora' : $project->estimated_hours . ' Horas' }}
                </td>
            </tr>
            <tr>
                <th class="align-middle">Fecha de inicio</th>
                <td class="align-middle">
                    <?php
                    echo ucfirst(Carbon\Carbon::parse($project->start_date)
                        ->locale('es')->translatedFormat('l d \d\e F \d\e\l Y'));
                    ?>
                </td>
            </tr>
            <tr>
                <th class="align-middle">Fecha de culminación</th>
                <td class="align-middle">
                    <?php
                    echo ucfirst(Carbon\Carbon::parse($project->end_date)
                        ->locale('es')->translatedFormat('l d \d\e F \d\e\l Y'));
                    ?>
                </td>
            </tr>
            <tr>
                <th class="align-middle">Responsable del Trabajo</th>
                <td class="align-middle">
                    {{ $project->user->fullname }}
                </td>
            </tr>
            <tr>
                <th class="align-middle">Equipo de trabajo</th>
                <?php
                $tm = json_decode($project->team);

                $_team = \App\Models\User::whereIn('id', $tm)
                    ->select('users.*')
                    ->selectRaw('CONCAT(user_firstname," ",user_lastname) as fullname')
                    ->get();
                ?>
                <td class="align-middle">

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="like-block position-relative d-flex align-items-center">

                            <div class="team-group mb-0 pb-0">
                                <?php
                                $img = $project->user->user_gender == 2 ? 'woman.svg' : 'man.svg';
                                $profile = $project->user->user_cover ? $project->user->user_cover : $img;
                                ?>
                                <a href="javascript:;" class="team team-sm" data-toggle="tooltip"
                                   data-placement="top" title="{{ $project->user->fullname }}">
                                    <img alt="{{ $project->user->fullname }}" class="rounded-circle"
                                         src="{{ asset('assets/images/users') . '/' . $profile }}">
                                </a>

                                @foreach($_team as $us)
                                    <?php
                                    $img = $us->user_gender == 2 ? 'woman.svg' : 'man.svg';
                                    $profile = $us->user_cover ? $us->user_cover : $img;
                                    ?>
                                    <a href="javascript:;" class="team team-sm" data-toggle="tooltip"
                                       data-placement="top" title="{{ $us->fullname }}">
                                        <img alt="{{ $us->fullname }}" class="rounded-circle"
                                             src="{{ asset('assets/images/users') . '/' . $profile }}">
                                    </a>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

        <div class="separator"></div>
        <h3 class="card-title p-0 m-0 mb-2 mt-4 title-1-nowrap">Resumen</h3>
        <div class="border p-3 mb-5">
            {!! $project->summary !!}
        </div>

        <div class="separator"></div>
        <h3 class="card-title p-0 m-0 mb-2 mt-4 title-1-nowrap">Descripción</h3>
        <div class="border p-3">
            {!! $project->description !!}
        </div>
    </div>
</div>
