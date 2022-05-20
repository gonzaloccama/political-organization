@push('title') {{ $_title }} @endpush
<?php
$img = auth()->user()->user_gender == 2 ? 'woman.svg' : 'man.svg';
$profile = auth()->user()->user_cover ? auth()->user()->user_cover : $img;

$auth_status = auth()->user()->user_is_online == 1 ? 'status-online' : 'status-offline';
?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-body chat-page p-0">
                    <div class="chat-data-block">
                        <div class="row" wire:poll="mountData">
                            <div class="col-lg-4 chat-data-left pr-3 scroller" wire:ignore.self>
                                <div class="chat-search pt-3 pl-3">
                                    <div class="d-flex align-items-center">
                                        <div class="iq-profile-avatar {{ $auth_status }} mr-3">
                                            <img src="{{  asset('assets/images/users/') . '/' . $profile }}"
                                                 alt="chat-user" class="avatar-60 ">
                                        </div>
                                        <div class="chat-caption">
                                            <h5 class="mb-0 roboto weight-500">{{ auth()->user()->fullname }}</h5>
                                            <p class="m-0 font-rajdhani">{{ auth()->user()->user_role->role }}</p>
                                        </div>
                                        <button type="submit" class="close-btn-res p-3"><i class="ri-close-fill"></i>
                                        </button>
                                    </div>
                                    <div id="user-detail-popup" class="overflow-auto w-100">
                                        <div class="user-profile">
                                            <button type="submit" class="close-popup p-3"><i class="ri-close-fill"></i>
                                            </button>
                                            <div class="user text-center mb-4">
                                                <a class="avatar m-0">
                                                    <img src="{{  asset('assets/images/users/') . '/' . $profile }}"
                                                         alt="avatar">
                                                </a>
                                                <div class="user-name mt-4">
                                                    <h4 class="roboto weight-400"
                                                        style="font-size: 16px">{{ auth()->user()->fullname }}</h4>
                                                </div>
                                                <div class="user-desc">
                                                    <p class="font-rajdhani">{{ auth()->user()->user_role->role }}</p>
                                                </div>
                                            </div>
                                            <hr>

                                        </div>
                                    </div>
                                    <div class="chat-searchbar mt-4">
                                        <div class="form-group chat-search-data m-0">
                                            <input type="text" class="form-control round" id="chat-search"
                                                   wire:model="keyWord"
                                                   placeholder="Buscar...">
                                            <i class="ri-search-line"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat-sidebar-channel scroller mt-4 pl-3">
                                    <h5 class="mt-3 font-rajdhani weight-600">Contactos</h5>
                                    <ul class="iq-chat-ui nav flex-column nav-pills">
                                        @foreach($users as $user)
                                            @if($_id = auth()->user()->id != $user->id)
                                                <?php
                                                $_img = $user->user_gender == 2 ? 'woman.svg' : 'man.svg';
                                                $_profile = $user->user_cover ? $user->user_cover : $_img;
                                                // status = text-dark, text-success, text-primary, text-danger, text-warning

                                                $status_user = '';

                                                $not_read = \App\Models\ChatMessage::where('from_user', $user->id)
                                                        ->where('to_user', auth()->user()->id)
                                                        ->where('is_read', 0)
                                                        ->get() ?? null;

                                                $on_status = $user->user_is_online == 1 ? 'status-online' : 'status-offline';

                                                if (isset($sender) && !empty($sender)) {
                                                    $status_user = $sender->id == $user->id ? 'active' : '';
                                                }
                                                ?>
                                                <li>
                                                    <a data-toggle="pill" class="{{ $status_user }}"
                                                       href="#box-chat" wire:click.prevent="getUser({{ $user->id }})">
                                                        <div class="d-flex align-items-center">
                                                            <div class="iq-profile-avatar {{ $on_status }} mr-2">
                                                                <img
                                                                    src="{{  asset('assets/images/users/') . '/' . $_profile }}"
                                                                    alt="chatuserimage" class="avatar-50 ">
                                                            </div>
                                                            <div class="chat-sidebar-name">
                                                                <h6 class="mb-0 roboto">{{ $user->fullname }}</h6>
                                                                <span
                                                                    class="font-rajdhani-13">{{ $user->user_role->role }}</span>
                                                            </div>

                                                            @if(filled($not_read))
                                                                <?php
                                                                $ago = $not_read[$not_read->count() - 1]->created_at->diffForHumans();
                                                                ?>
                                                                <div
                                                                    class="chat-meta float-right text-center mt-2 mr-1">
                                                                    <div class="chat-msg-counter bg-primary text-white">
                                                                        {{ $not_read->count() }}
                                                                    </div>
                                                                    <span class="text-nowrap">{{ $ago }}</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </a>
                                                </li>

                                                <?php
                                                unset($_img);
                                                unset($_profile);
                                                ?>
                                            @endif
                                        @endforeach
                                        <li class="text-center">
                                            @if($moreUsers <= $users->count())
                                                <a href="javascript:;" wire:click.prevent="updateMoreUsers">Ver
                                                    más</a>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-8 chat-data p-0 chat-data-right">
                                <div class="tab-content mt-0 pt-0">

                                    @include('livewire.user.chat-messages-component.area-messages')

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('styles')

    <style>

    </style>
@endpush

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            window.livewire.on('closeModalPost', () => {
                $('#post-modal').modal('hide');
            });

            window.livewire.on('closeModalPostShared', () => {
                $('#post-modal-shared').modal('hide');
                notificationSwal('¡Compartido extisomente!', 'rgba(47,122,67,0.89)');
            });

            window.livewire.on('refreshContent', () => {
                lightbox('.baguetteBoxThree');
            });
            lightbox('.baguetteBoxThree');
        });

        $(document).ready(function () {
            window.livewire.on('deleteAlert', () => {
                deleteSwal()
            });

            window.livewire.on('alertSaved', () => {
                notificationSwal('¡Publicación Guadada extisomente!', 'rgba(47,122,67,0.89)');
            });
        });
    </script>

@endpush
