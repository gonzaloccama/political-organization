<div class="tab-pane fade {{ $tab_pane == 'links-social'?'active show':'' }}"
     id="{{ $tab_pane }}" role="tabpanel">
    <div class="iq-card container">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title uppercase">Redes Sociales</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <form>

                <div class="row pt-3 pb-3">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label
                                class="control-label col-sm-4 align-self-center text-md-right mb-0 font-rajdhani-16 uppercase"
                                for="user_social_facebook">FACEBOOK:</label>
                            <div class="col-sm-8">
                                <input type="text"
                                       class="form-control @error('user_social_facebook') is-invalid @enderror"
                                       id="user_social_facebook" wire:model="user_social_facebook"
                                       placeholder="Facebook">
                                @error('user_social_facebook')
                                <div class="text-danger text-errors font-italic" style="font-size: 11px;">
                                    {!! $message !!}
                                </div>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                class="control-label col-sm-4 align-self-center text-md-right mb-0 font-rajdhani-16 uppercase"
                                for="user_social_whatsapp">WHATSAPP:</label>
                            <div class="col-sm-8">
                                <input type="text"
                                       class="form-control @error('user_social_whatsapp') is-invalid @enderror"
                                       id="user_social_whatsapp" aria-describedby="basic-addon3"
                                       wire:model="user_social_whatsapp" placeholder="WhatsApp">
                                @error('user_social_whatsapp')
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
