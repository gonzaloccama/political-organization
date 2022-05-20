<div class="tab-pane fade {{ $tab_pane == 'privacy'?'active show':'' }}"
     id="{{ $tab_pane }}" role="tabpanel">
    <div class="iq-card container">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title uppercase">Privacidad</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <form>
                <div class="row pt-3 pb-3">

                    <div class="col-md-12">

                        <div class="form-group row">
                            <label
                                class="control-label col-sm-4 align-self-center text-md-right font-rajdhani-16 mb-0 uppercase"
                                for="user_privacy_gender">PRIVACIDAD DE SEXO:</label>
                            <div class="col-sm-8">

                                <div
                                    class="custom-control custom-switch custom-switch-text custom-switch-color custom-control-inline mt-1">
                                    <div class="custom-switch-inner">
                                        <input type="checkbox" class="custom-control-input bg-primary"
                                               id="user_privacy_gender" wire:model="user_privacy_gender">
                                        <label class="custom-control-label" for="user_privacy_gender" data-on-label="ON"
                                               data-off-label="OFF">
                                        </label>
                                    </div>
                                </div>

                                @error('user_privacy_gender')
                                <div class="text-danger text-errors font-italic" style="font-size: 11px;">
                                    {!! $message !!}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                class="control-label col-sm-4 align-self-center text-md-right font-rajdhani-16 mb-0 uppercase"
                                for="user_privacy_birthdate">PRIVACIDAD DE CUMPLEAÑOS:</label>
                            <div class="col-sm-8">

                                <div
                                    class="custom-control custom-switch custom-switch-text custom-switch-color custom-control-inline mt-1">
                                    <div class="custom-switch-inner">
                                        <input type="checkbox" class="custom-control-input bg-primary"
                                               id="user_privacy_birthdate" wire:model="user_privacy_birthdate">
                                        <label class="custom-control-label" for="user_privacy_birthdate" data-on-label="ON"
                                               data-off-label="OFF">
                                        </label>
                                    </div>
                                </div>

                                @error('user_privacy_birthdate')
                                <div class="text-danger text-errors font-italic" style="font-size: 11px;">
                                    {!! $message !!}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                class="control-label col-sm-4 align-self-center text-md-right font-rajdhani-16 mb-0 uppercase"
                                for="user_privacy_relationship">PRIVACIDAD DE ESTADO CIVIL:</label>
                            <div class="col-sm-8">

                                <div
                                    class="custom-control custom-switch custom-switch-text custom-switch-color custom-control-inline mt-1">
                                    <div class="custom-switch-inner">
                                        <input type="checkbox" class="custom-control-input bg-primary"
                                               id="user_privacy_relationship" wire:model="user_privacy_relationship">
                                        <label class="custom-control-label" for="user_privacy_relationship" data-on-label="ON"
                                               data-off-label="OFF">
                                        </label>
                                    </div>
                                </div>

                                @error('user_privacy_relationship')
                                <div class="text-danger text-errors font-italic" style="font-size: 11px;">
                                    {!! $message !!}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                class="control-label col-sm-4 align-self-center text-md-right font-rajdhani-16 mb-0 uppercase"
                                for="user_privacy_basic">PRIVACIDAD BÁSICA:</label>
                            <div class="col-sm-8">

                                <div
                                    class="custom-control custom-switch custom-switch-text custom-switch-color custom-control-inline mt-1">
                                    <div class="custom-switch-inner">
                                        <input type="checkbox" class="custom-control-input bg-primary"
                                               id="user_privacy_basic" wire:model="user_privacy_basic">
                                        <label class="custom-control-label" for="user_privacy_basic" data-on-label="ON"
                                               data-off-label="OFF">
                                        </label>
                                    </div>
                                </div>

                                @error('user_privacy_basic')
                                <div class="text-danger text-errors font-italic" style="font-size: 11px;">
                                    {!! $message !!}
                                </div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>

                <div class="form-group row text-right">
                    <div class="col-8 offset-4">
                        <button type="reset" wire:click.prevent="closeFrame"
                                class="btn btn-danger waves-effect waves-light mr-1">
                            <i class="fe-corner-up-left"></i>&nbsp;&nbsp;Cancelar
                        </button>
                        <button type="submit" class="btn btn-success waves-effect waves-light mr-1"
                                wire:click.prevent="storeProfile('{{ $tab_pane }}')">
                            <i class="fe-save"></i>&nbsp;&nbsp;Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

