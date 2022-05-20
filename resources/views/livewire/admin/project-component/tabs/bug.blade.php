<div class="tab-content">
    <div class="tab-pane fade show active" id="{{ $tab }}-tab" role="tabpanel"
         aria-labelledby="first-tab_">
        {{--        <h3 class="card-title p-0 m-0 mb-4 title-1-nowrap"><u>Trabajo:</u> {{ $project->title }}</h3>--}}
        <div class="separator mb-2"></div>
        <div class="" style="display: flex; flex-direction: column-reverse;">
            @if(filled($bugs = $project->projectBug()->orderBy('created_at','desc')->paginate($loadMore)))
                @foreach($bugs as $bug)
                    <?php
                    $img = $bug->user->user_gender == 2 ? 'woman.svg' : 'man.svg';
                    $profile = $bug->user->user_cover ? $bug->user->user_cover : $img;
                    ?>
                    <div class="border mt-3 p-3">
                        @if( $bug->user->id == auth()->user()->id)
                            <div class="float-right">
                                <button class="btn btn-header-warning icon-button"
                                        wire:click.prevent="deleteCustomConfirm({{ $bug->id }})">
                                <span
                                    style="position: absolute; margin-top: -16px; margin-left: -7px; font-weight: 500; font-size: 15px">
                                    <i class="fas fa-trash"></i>
                                </span>
                                </button>
                            </div>
                        @endif
                        <div class="d-flex flex-row mb-3">
                            <a href="{{ route('profile', ['id' => base64_encode($bug->user->id)]) }}">
                                <img src="{{ asset('assets/images/users') . '/'. $profile }}" alt="Mayra Sibley"
                                     class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall"/>
                            </a>
                            <div class="pl-3">
                                <a href="{{ route('profile', ['id' => base64_encode($bug->user->id)]) }}">
                                    <p class="font-weight-medium mb-0 ">{{ $bug->user->fullname }}</p>
                                    <p class="text-muted mb-0 text-small"><?php
                                        echo ucfirst(Carbon\Carbon::parse($bug->created_at)
                                            ->locale('es')->translatedFormat('l d \d\e F \d\e\l Y | g:i:s A'));
                                        ?></p>
                                </a>
                            </div>
                        </div>
                        <div
                            style="overflow-wrap: break-word !important; word-wrap: break-word !important; hyphens: auto !important;">
                            {!! $bug->bug_note !!}
                        </div>
                    </div>
                @endforeach
            @else
                <div class="border mt-3 p-3">
                    <div class="alert alert-success alert-dismissible fade show rounded mb-0" role="alert">
                        <strong>Aviso: </strong>  Ningún error reportado de este trabajo.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif

            @if($loadMore < $project->projectBug->count())
                <div class="text-center">
                    <button class="btn btn-link" wire:click.prevent="updateLoadMore">Ver más</button>
                </div>
            @endif
        </div>
        <div class="separator mt-4"></div>

        @if($writeNote)


            <div class="form-group row mt-4">
                <div class="col-md-12">
                    <div wire:ignore>
                    <textarea class="form-control scrollbar scroller" id="bug_note" rows="5"
                              wire:model="bug_note" placeholder="Insidencia..."></textarea>
                    </div>

                    @include('livewire.widgets.admin.form.error', ['name' => 'bug_note'])

                </div>
            </div>

            <div class="text-right mt-4">
                <button type="submit" class="btn btn-secondary btn-sm"
                        wire:click.prevent="updateWriteNote">
                    <b><i class="fas fa-minus"></i>&nbsp;&nbsp;Nota</b>
                </button>
                <button type="submit" class="btn btn-secondary btn-sm"
                        wire:click.prevent="updateTab">
                    <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardar</b>
                </button>
            </div>
        @else
            <div class="text-right mt-4">
                <button type="submit" class="btn btn-secondary btn-sm" id="add-discussion"
                        wire:click.prevent="updateWriteNote('open')">
                    <b><i class="fas fa-plus"></i>&nbsp;&nbsp;Nota</b>
                </button>
            </div>
        @endif
    </div>
</div>
