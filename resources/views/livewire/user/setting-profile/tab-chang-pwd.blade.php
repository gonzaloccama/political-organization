<div class="tab-pane fade {{ $tab_pane == 'chang-pwd'?'active show':'' }}"
     id="{{ $tab_pane }}" role="tabpanel">
    @if(!isset(auth()->user()->user_google_id))
        <div class="iq-card container">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title uppercase">Cambiar la contraseña</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <form>
                    <div class="row pt-3 pb-3">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label
                                    class="control-label col-sm-4 align-self-center text-md-right mb-0 font-rajdhani-16 uppercase"
                                    for="current_password">CONTRASEÑA ACTUAL:</label>
                                <div class="col-sm-8">
                                    <input type="password"
                                           class="form-control @error('current_password') is-invalid @enderror"
                                           id="current_password"
                                           wire:model="current_password" placeholder="Contraseña actual">
                                    @error('current_password')
                                    <div class="text-danger text-errors font-italic" style="font-size: 11px;">
                                        {!! $message !!}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    class="control-label col-sm-4 align-self-center text-md-right mb-0 font-rajdhani-16 uppercase"
                                    for="password">NUEVA CONTRASEÑA:</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           id="password"
                                           aria-describedby="basic-addon3"
                                           wire:model="password" placeholder="Nueva contraseña">
                                    @error('password')
                                    <div class="text-danger text-errors font-italic" style="font-size: 11px;">
                                        {!! $message !!}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                    class="control-label col-sm-4 align-self-center text-md-right mb-0 font-rajdhani-16 uppercase"
                                    for="confirm_password">VERIFICAR CONTRASEÑA:</label>
                                <div class="col-sm-8">
                                    <input type="password"
                                           class="form-control @error('confirm_password') is-invalid @enderror"
                                           id="confirm_password"
                                           aria-describedby="basic-addon3"
                                           wire:model="confirm_password" placeholder="Verificar contraseña">
                                    @error('confirm_password')
                                    <div class="text-danger text-errors font-italic" style="font-size: 11px;">
                                        {!! $message !!}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (session()->has('current_password'))
                        <div class="alert alert-success">
                            {{ session('current_password') }}
                        </div>
                    @endif

                    @error('current_password')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror

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
    @endif
</div>
