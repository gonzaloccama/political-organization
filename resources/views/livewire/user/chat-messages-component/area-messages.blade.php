@if(isset($sender) && !empty($sender))
    <?php
    $_img = $sender->user_gender == 2 ? 'woman.svg' : 'man.svg';
    $_profile = $sender->user_cover ? $sender->user_cover : $_img;

    $online_status = $sender->user_is_online == 1 ? 'status-online' : 'status-offline';
    ?>
    <div class="tab-pane fade active show" id="box-chat" role="tabpanel">
        <div class="chat-head">
            <header
                class="d-flex justify-content-between align-items-center bg-white pt-3 pl-3 pr-3 pb-3">
                <div class="d-flex align-items-center">
                    <div class="sidebar-toggle">
                        <i class="ri-menu-3-line"></i>
                    </div>
                    <!-- chat-user-profile -->
                    <div
                        class="iq-profile-avatar {{ $online_status }} m-0 mr-3">
                        <img src="{{  asset('assets/images/users/') . '/' . $_profile }}"
                             alt="avatar" class="avatar-50 ">
                    </div>
                    <h5 class="mb-0 roboto weight-500">
                        {{ $sender->fullname }}<br>
                        <span class="font-rajdhani-13 weight-400 font-italic">
                            Ultima actividad: {{ Carbon\Carbon::parse($sender->user_last_activity)->diffForHumans()}}
                        </span>
                    </h5>

                </div>
                <div class="chat-user-detail-popup scroller" wire:ignore.self>
                    <div class="user-profile text-center">
                        <button type="submit" class="close-popup p-3"><i
                                class="ri-close-fill"></i></button>
                        <div class="user mb-4">
                            <a class="avatar m-0">
                                <img
                                    src="{{  asset('assets/images/users/') . '/' . $_profile }}"
                                    alt="avatar">
                            </a>
                            <div class="user-name mt-4 roboto weight-500">
                                <h4>{{ $sender->fullname }}</h4>
                            </div>
                            <div class="user-desc">
                                <p>{{ $sender->user_role->role }}</p>
                            </div>
                        </div>
                        <hr>

                    </div>
                </div>

            </header>
        </div>
        <div class="chat-content scroller mt-0 pt-1"
             style="display: flex; flex-direction: column-reverse; background-color: #ebf7ff">

            @if(filled($allMessages))

                @foreach($allMessages as $_messages)
                    <?php
                    $dt = Carbon\Carbon::parse($_messages->created_at)->format('g:i A');

                    $is_dt = Carbon\Carbon::parse($_messages->created_at)->format('Y-m-d');
                    ?>
                    @if($_messages->from_user == auth()->user()->id)
                        <div class="chat">
                            <div class="chat-user">
                                <a class="avatar m-0">
                                    <img src="{{  asset('assets/images/users/') . '/' . $profile }}"
                                         alt="avatar" class="avatar-35 ">
                                </a>
                                <span class="chat-time font-rajdhani-11 mt-1">{{ $dt }}</span>
                            </div>
                            <div class="chat-detail">
                                <div class="chat-message ml-5">
                                    <p class="mb-0" ondragstart="return false" onselectstart="return false"
                                       oncontextmenu="return false">
                                        @include('livewire.widgets.social.icon-regex.pattern-comment-emojis', ['content' => $_messages->message, 'w' => 30])
                                    </p>
                                    {{--                                    <p>{!! $_messages->message !!}</p>--}}
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="chat chat-left">
                            <div class="chat-user">
                                <a class="avatar m-0">
                                    <img src="{{  asset('assets/images/users/') . '/' . $_profile }}"
                                         alt="avatar" class="avatar-35 ">
                                </a>
                                <span class="chat-time font-rajdhani-11 mt-1">{{ $dt }}</span>
                            </div>
                            <div class="chat-detail">
                                <div class="chat-message mr-5">

                                    <p class="mb-0" ondragstart="return false" onselectstart="return false"
                                       oncontextmenu="return false">
                                        @include('livewire.widgets.social.icon-regex.pattern-comment-emojis', ['content' => $_messages->message, 'w' => 30])
                                    </p>

                                    {{--                                    <p>{!! $_messages->message !!}</p>--}}
                                </div>
                            </div>
                        </div>
                    @endif
                    {{--                    <div class="m-auto">--}}
                    {{--                        <hr class="bg-chat-date">--}}
                    {{--                        <h2 class="chat-date">{{ $is_dt }}</h2>--}}
                    {{--                    </div>--}}
                @endforeach
            @else
                <div class="chat-start">
                    <span class="iq-start-icon text-primary">
                        <i class="ri-message-3-line"></i>
                    </span>
                    <button id="chat-start" class="btn bg-white mt-3 text-primary">¡Escriba para iniciar una
                        conversación!
                    </button>
                </div>
            @endif
            <div class="text-center pb-1">
                @if($allMessages->count() >= $moreMessages)
                    <button class="btn btn-link weight-500" wire:click.prevent="updateMoreMessages">Ver más</button>
                @endif
            </div>
        </div>
        <div class="chat-footer p-3 bg-white">
            <form class="d-flex align-items-center" action="javascript:void(0);">
                <div class="chat-attagement d-flex">

                    <div class="dropdown" wire:ignore>

                        <a href="javascript:;" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-smile-o pr-3" aria-hidden="true"></i>
                        </a>


                        <div class="dropdown-menu border rounded-0">
                            <div class="dropdown-item-text p-2" style="width:324px; height: 110px; overflow-y: auto"
                                 ondragstart="return false" onselectstart="return false" oncontextmenu="return false">

                                @foreach($emojis as $emoji)
                                    <a href="javascript:;" class="media-emoji reactions"
                                       wire:click.prevent="updateText('{{ $emoji->pattern }}')">
                                        @include('livewire.widgets.social.icon-regex.pattern-emojis', ['svg' => $emoji->pattern, 'w' => 45])
                                    </a>
                                @endforeach

                            </div>

                        </div>
                    </div>
                    {{--                                        <a href="javascript:;">--}}
                    {{--                                            <i class="fa fa-smile-o pr-3" aria-hidden="true"></i>--}}
                    {{--                                        </a>--}}
                    {{--                    <a href="javascript:;">--}}
                    {{--                        <i class="fa fa-paperclip pr-3" aria-hidden="true"></i>--}}
                    {{--                    </a>--}}
                </div>
                <input type="text" class="form-control mr-3 iq-bg-primary" wire:model="message"
                       placeholder="Escriba su mensaje...">
                <button type="submit" wire:click.prevent="sendMessage"
                        class="btn btn-primary d-flex align-items-center p-2">
                    <i class="ri-send-plane-2-fill" aria-hidden="true"></i>
                    <span class="d-none d-lg-block ml-1">Enviar</span>
                </button>
            </form>
        </div>
    </div>

@else
    <div class="tab-pane fade active show" id="default-block" role="tabpanel" style="background-color: #ebf7ff">
        <div class="chat-start">
                                            <span class="iq-start-icon text-primary"><i
                                                    class="ri-message-3-line"></i></span>
            <button id="chat-start" class="btn bg-white mt-3 text-primary">¡Iniciar conversación!
            </button>
        </div>
    </div>
@endif
