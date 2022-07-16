<div class="row h-100">
    @push('title')
        {{ $_title }}
    @endpush
    <div class="col-12 col-md-10 mx-auto my-auto">
        <div class="card auth-card rounded-0 shadow-lg">
            <div class="position-relative image-side rounded-0">

                <div class="text-white p-3"
                     style="background-color: rgba(6,8,24,0.51) !important; font-weight: 700; border: 1px solid rgba(255,255,255,0.18);">

                    <div class='text-center'>
                        <img src='{{ asset('assets/logos/') . '/' . $sttngs->logo }}'
                             style='width: 80px !important; box-shadow: 0 0 15px 0 rgba(255,255,255,0.28);'
                             alt=""/>
                        <div class="separator pt-2" style="border-color: rgba(255,255,255,0.18);"></div>
                        <div class="pt-2 pl-2 text-uppercase">
                            <p class="h5">{{ $sttngs->name }}</p>

                            <span class="h3">{{ $sttngs->campus }}</span>
                        </div>
                    </div>
                    <p class="white mb-0 pt-3 text-right">
                        <a href="#" class="btn btn-link white">Registrarme</a>
                    </p>
                </div>

                {{--                <p class="white mb-0 p-3 text-right" style="background-color: rgba(6,8,24,0.51) !important;; border: 1px solid rgba(255,255,255,0.18);">--}}
                {{--                    --}}
                {{--                </p>--}}
            </div>

            @if($panel)
                @include('livewire.auth.' . $panel)
            @endif

            {{--            @if($currentUrl == route('login'))--}}
            {{--                @include('livewire.auth.google')--}}
            {{--            @else--}}
            {{--                @include('livewire.auth.admin')--}}
            {{--            @endif--}}
        </div>
    </div>
</div>

@push('styles')
    <style>
        .icon-google {
            font-size: calc(14px + (13 - 12) * ((100vw - 360px) / (1600 - 320))) !important;;
            padding: calc(7px + 5 * ((100vw - 320px) / 780)) !important;
            color: #646464 !important
        }

        .icon-google:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            outline-width: 0
        }

        .btn-icon-google {
            border: 1px solid #646464;
            background-color: transparent;
            border-radius: 0;
            letter-spacing: 1px;
            width: 80%;
        }

        .btn-icon-google:hover {
            background-color: #3c79e6;
            color: #fff !important;
            border: 1px solid #3c79e6;
        }
    </style>
@endpush
