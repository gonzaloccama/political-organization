<div class="card col-md-12">
    <div class="position-absolute card-top-buttons">
        <button class="btn btn-header-light icon-button" wire:click.prevent="closeFrame">
            <span style="color: white;position: absolute; margin-top: -17px; margin-left: -12px">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="1" fill="none"
                     stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </span>
        </button>
    </div>

    <div class="card-body">
        <h5 class="card-title text-muted text-uppercase">{{ $region }}</h5>
        <div class="separator mb-5"></div>
        <div class="scroll">
            <div class="card-body border">
                <form action="">

                    <?php
                    $dt = [
                        'name' => 'region',
                        'text' => 'Departamento',
                        'required' => 1,
                        'type' => 'text',
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.input-h', $dt)


                    <div class="form-group row">
                        <label for="province" class="col-sm-3 col-form-label">Provincia 1 <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <div class="input-group mb-1">
                                <input type="text" class="form-control" aria-label="province" id="province"
                                       placeholder="Provincia 1" wire:model="province.0" aria-describedby="province.0">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="button"
                                            wire:click.prevent="addInput({{$iterator}})" id="province.0">
                                        <b><i class="iconsminds-add"></i> Nuevo</b>
                                    </button>
                                </div>
                            </div>
                            @error('province.0')
                            <span class="text-danger text-error text-small font-italic">
                                <i class="simple-icon-info"></i> {!! $message !!}
                            </span>
                            @enderror
                        </div>

                    </div>

                    @foreach($inputs as $key => $value)
                        <div class="form-group row">
                            <label for="province{{$value}}"
                                   class="col-sm-3 col-form-label">Provincia {{++$i}}</label>
                            <div class="col-sm-9">
                                <div class="input-group mb-1">
                                    <input type="text" class="form-control" aria-label="province"
                                           id="province{{$value}}"
                                           placeholder="Provincia {{$i}}" wire:model="province.{{$value}}"
                                           aria-describedby="province.{{$value}}">
                                    <div class="input-group-append">
                                        <button class="btn btn-danger" type="button"
                                                wire:click.prevent="removeInput({{$key}}, {{$value}})" id="province.{{$value}}">
                                            <b><i class="iconsminds-remove"></i> Elimnar</b>
                                        </button>
                                    </div>
                                </div>
                                @error('province.'.$value)
                                <span class="text-danger text-error text-small font-italic">
                                        <i class="simple-icon-info"></i> {!! $message !!}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    @endforeach

                </form>

                <div class="separator mb-5"></div>

                <div class="text-right">
                    <button class="btn btn-secondary btn-sm"
                            wire:click.prevent="closeFrame">
                        <b><i class="simple-icon-logout"></i>&nbsp;&nbsp;Regresar</b>
                    </button>

                    <button type="submit" class="btn btn-secondary btn-sm"
                            wire:click.prevent="saveData">
                        <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardar</b>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>






