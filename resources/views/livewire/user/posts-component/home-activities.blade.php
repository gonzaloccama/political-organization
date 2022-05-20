<div class="col-lg-4">

    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title font-rajdhani uppercase weight-500">Eventos</h4>
            </div>
            {{--
            <div class="iq-card-header-toolbar d-flex align-items-center">
                <div class="dropdown">
                                 <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"
                                       aria-expanded="false" role="button">
                                 <i class="ri-more-fill"></i>
                                 </span>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton"
                         style="">
                        <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                        <a class="dropdown-item" href="#"><i
                                class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                        <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                        <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                        <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Download</a>
                    </div>
                </div>
            </div>
            --}}
        </div>
        <div class="iq-card-body">
            <?php
            $events = App\Models\Event::orderBy('event_start_date', 'desc')
                ->where('event_start_date', '>=', Carbon\Carbon::now()->format('Y-m-d'))
                ->paginate(3);
            ?>
            <ul class="media-story m-0 p-0">
                @foreach($events as $event)
                    <li class="d-flex mb-4 align-items-center ">
                        <img src="{{ asset('assets/images/events/').'/'.$event->event_cover }}" alt="story-img"
                             class="img-thumbnail rounded-0 img-fluid">
                        <div class="stories-data ml-3">
                            <h5><a href="" class="roboto weight-300">{{$event->event_title}}</a></h5>
                            <p class="mb-0"
                               style="font-size: 12px; font-weight: 600;">{{ ucfirst($this->timeElapsedString($event->event_start_date)) }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="iq-card">
        <?php
//        $birthdates = \App\Models\User::paginate(5);
        $date = now();
        $birthdates = \App\Models\User::whereMonth('user_birthdate', '>', $date->month)
            ->orWhere(function ($query) use ($date) {
                $query->whereMonth('user_birthdate', '=', $date->month)
                    ->whereDay('user_birthdate', '>=', $date->day);
            })
            ->orderByRaw("DAYOFMONTH('user_birthdate')",'ASC')
            ->take(10)
            ->get();
        ?>
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title font-rajdhani uppercase weight-500">Próximo cumpleaños</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <ul class="media-story m-0 p-0">
                @foreach($birthdates as $birthdate)
                    <?php
                    $img = $birthdate->user_gender == 2 ? 'woman.svg' : 'man.svg';
                    $profile = $birthdate->user_cover ? $birthdate->user_cover : $img;
                    ?>
                    <li class="d-flex mb-4 align-items-center">
                        <img src="{{ asset('assets/images/users/').'/'.$profile }}" alt="story-img"
                             class="rounded-circle img-fluid">
                        <div class="stories-data ml-3">
                            <h5>
                                <a href="{{ route('profile', ['id' => base64_encode($birthdate->id)]) }}"
                                   class="roboto weight-300">{{ $birthdate->fullname }}</a>
                            </h5>
                            @if($birthdate->user_birthdate != null)
                                <p class="mb-0"
                                   style="font-size: 12px; font-weight: 600;">{{ $this->birthdate_diff($birthdate->user_birthdate, 1) }}</p>
                            @else
                                <p class="mb-0"
                                   style="font-size: 12px; font-weight: 600;">{{ __('Cumpleaños no espeficado') }}</p>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

</div>
