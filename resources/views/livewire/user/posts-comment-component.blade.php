<form class="comment-text d-flex align-items-center mt-3">

    <textarea class="form-control iq-bg-primary media-comment" rows="1" wire:model="text"></textarea>

    <div class="comment-attagement d-flex pr-1">
        {{--        <a href="javascript:;"><i class="ri-link mr-3"></i></a>--}}

        {{--        <a href="javascript:;">--}}
        {{--            <i class="ri-user-smile-line mr-3"></i>--}}
        {{--        </a>--}}

        <div class="dropdown">

            <!--Trigger-->
            {{--class="dropdown-toggle"--}}
            <a type="button" id="" data-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false">
                <i class="ri-user-smile-line mr-3"></i>
            </a>


            <!--Menu-->
            <div class="dropdown-menu dropdown-menu-right shadow border rounded-0">
                <div class="dropdown-item-text p-2" style="width:324px; height: 110px; overflow-y: auto"
                     ondragstart="return false" onselectstart="return false" oncontextmenu="return false">

                    @foreach($emojis as $emoji)
                        <a href="javascript:;" class="media-emoji reactions"
                           wire:click.prevent="updateText('{{ $emoji->pattern }}')">
                            @include('livewire.widgets.social.icon-regex.pattern-emojis', ['svg' => $emoji->pattern, 'w' => 45])
                        </a>
                    @endforeach

                </div>
                {{--                <a class="dropdown-item" href="javascript:;"><i class="fab fa-apple-pay"></i>&nbsp;&nbsp;Pay</a>--}}
                {{--                <a class="dropdown-item" href="javascript:;"><i class="fas fa-bell-slash"></i>&nbsp;&nbsp;Disable--}}
                {{--                    alertss</a>--}}
                {{--                <a class="dropdown-item" href="javascript:;"><i class="far fa-envelope"></i>&nbsp;&nbsp;Check mail</a>--}}
            </div>
        </div>

        {{--        <a href="javascript:;"><i class="ri-camera-line mr-3"></i></a>--}}
        <button type="submit" class="btn btn-primary" wire:click.prevent="storePostsComment">
            <i class="ri-send-plane-2-fill"></i>
        </button>
    </div>

</form>
