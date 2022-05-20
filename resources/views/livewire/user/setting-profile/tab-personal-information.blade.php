<div class="tab-pane fade {{ $tab_pane == 'personal-information'?'active show':'' }}"
     id="{{ $tab_pane }}" role="tabpanel">
    <?php
    $img = $user_gender == 2 ? 'woman.svg' : 'man.svg';
    $profile = $user_cover ? $user_cover : $img;
    ?>
    <div class="iq-card container">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">INFORMACIÓN PERSONAL</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <form>
                <div class="form-group row align-items-center text-center">
                    <div class="col-md-12">
                        <div class="profile-img-edit">
                            <img class="profile-pic" src="{{ asset('assets/images/users/') . '/' . $profile }}"
                                 alt="profile-pic">
{{--                            <div class="p-image">--}}
                            {{--                                <i class="ri-pencil-line upload-button"></i>--}}
                            {{--                                <input class="file-upload" type="file" id="profile" accept="image/*"/>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                </div>

                <h4 class="title text-center p-3 m-3 font-rajdhani uppercase"
                    style="font-weight: 500">Configuraciones de la cuenta</h4>


                <div class="row pt-3 pb-3">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label
                                class="control-label col-sm-4 align-self-center text-md-right mb-0 font-rajdhani-16 uppercase"
                                for="email">EMAIL:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                       wire:model="email" placeholder="Email" readonly>
                                @error('email')
                                <div class="text-danger text-errors font-italic" style="font-size: 11px;">
                                    {!! $message !!}
                                </div>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                class="control-label col-sm-4 align-self-center text-md-right mb-0 font-rajdhani-16 uppercase"
                                for="username">USUARIO:</label>
                            <div class="col-sm-8">
                                {{--                                <div class="input-group">--}}
                                {{--                                    <div class="input-group-prepend">--}}
                                {{--                                        <span class="input-group-text"--}}
                                {{--                                              id="basic-addon3">{{ route('social.profile').'/' }}</span>--}}
                                {{--                                    </div>--}}
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                       id="username"
                                       aria-describedby="basic-addon3"
                                       wire:model="username" placeholder="Usuario">
                                {{--                                </div>--}}
                                @error('username')
                                <div class="text-danger text-errors font-italic" style="font-size: 11px;">
                                    {!! $message !!}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <h4 class="title text-center mb-3 pb-3 font-rajdhani uppercase"
                    style="font-weight: 500">Información básica</h4>

                <div class=" row align-items-center mb-3">


                    <div class="form-group col-sm-6">
                        <label for="user_firstname" class="font-rajdhani-16">DNI:</label>

                        <div class="input-group">
                            <input type="text" class="form-control @error('user_dni') is-invalid @enderror"
                                   placeholder="DNI"id="user_dni" wire:model="user_dni" aria-label="DNI"
                                    aria-describedby="button-addon2" {{ !$user_dni ? '' : 'readonly' }}>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" id="button-addon2">
                                    Buscar...
                                </button>
                            </div>
                        </div>
                        @error('user_dni')
                        <div class="text-danger text-errors font-italic" style="font-size: 11px;">
                            {!! $message !!}
                        </div>
                        @enderror

                    </div>
                </div>

                <div class=" row align-items-center">
                    <div class="form-group col-sm-6">
                        <label for="user_firstname" class="font-rajdhani-16">NOMBRES:</label>
                        <input type="text" class="form-control @error('user_firstname') is-invalid @enderror"
                               id="user_firstname" wire:model="user_firstname" readonly>
                        @error('user_firstname')
                        <div class="text-danger text-errors font-italic" style="font-size: 11px;">
                            {!! $message !!}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="user_lastname" class="font-rajdhani-16">APELLIDOS:</label>
                        <input type="text" class="form-control @error('user_lastname') is-invalid @enderror"
                               id="user_lastname" wire:model="user_lastname" readonly>
                        @error('user_lastname')
                        <div class="text-danger text-errors font-italic" style="font-size: 11px;">
                            {!! $message !!}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="user_gender" class="font-rajdhani-16">SEXO:</label>
                        <select class="form-control @error('user_gender') is-invalid @enderror" id="user_gender"
                                wire:model="user_gender">
                            <option value="">Seleccionar...</option>
                            @foreach($genders as $gender)
                                <option value="{{ $gender->id }}">{{ $gender->gender }}</option>
                            @endforeach
                        </select>
                        @error('user_gender')
                        <div class="text-danger text-errors font-italic" style="font-size: 11px;">
                            {!! $message !!}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="user_relationship" class="font-rajdhani-16">ESTADO CIVIL:</label>
                        <select class="form-control @error('user_relationship') is-invalid @enderror"
                                id="user_relationship" wire:model="user_relationship">
                            <option value="">Seleccionar...</option>
                            @foreach($relationships as $relationship)
                                <option value="{{ $relationship->id }}">{{ $relationship->marital_status }}</option>
                            @endforeach
                        </select>
                        @error('user_relationship')
                        <div class="text-danger text-errors font-italic" style="font-size: 11px;">
                            {!! $message !!}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="phone" class="font-rajdhani-16">CELULAR:</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                               wire:model="phone">
                        @error('phone')
                        <div class="text-danger text-errors font-italic" style="font-size: 11px;">
                            {!! $message !!}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="user_birthdate" class="font-rajdhani-16">FECHA DE NACIMIENTO:</label>
                        <input type="text" class="form-control @error('user_birthdate') is-invalid @enderror"
                               id="user_birthdate" wire:model="user_birthdate"
                               placeholder="Fecha de nacimiento">
                        @error('user_birthdate')
                        <div class="text-danger text-errors font-italic" style="font-size: 11px;">
                            {!! $message !!}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group col-sm-12 mt-2">
                        <label for="user_biography" class="font-rajdhani-16">BIOGRAFÍA:</label>
                        <textarea type="text" class="form-control @error('user_biography') is-invalid @enderror"
                                  id="user_biography" wire:model="user_biography"
                                  placeholder="Biografía"></textarea>
                        @error('user_biography')
                        <div class="text-danger text-errors font-italic" style="font-size: 11px;">
                            {!! $message !!}
                        </div>
                        @enderror
                    </div>

                </div>

                <h4 class="title text-center mb-3 pb-3 mt-3 pt-3 font-rajdhani uppercase"
                    style="font-weight: 500">Dirección</h4>

                <?php
                $regions = \App\Models\Departamento::all();

                $provinces = [];
                if ($user_region) {
                    $provinces = json_decode(\App\Models\Departamento::find($user_region)->province);
                }
                ?>

                <div class="row pt-3 pb-3">


                    <div class="col-md-12">
                        <div class="form-group row">
                            <label
                                class="control-label col-sm-4 align-self-center pt-0 text-md-right font-rajdhani-16 uppercase"
                                for="user_address">Dirección:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('user_address') is-invalid @enderror" id="user_address"
                                       wire:model="user_address" placeholder="Dirección">
                                @error('user_address')
                                <div class="text-danger text-errors font-italic" style="font-size: 11px;">
                                    {!! $message !!}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                class="control-label col-sm-4 align-self-center pt-0 text-md-right font-rajdhani-16 uppercase"
                                for="user_region">Región:</label>
                            <div class="col-sm-8">
                                <select class="form-control @error('user_region') is-invalid @enderror" id="user_region"
                                        wire:model="user_region">
                                    <option value="">Seleccionar...</option>
                                    @foreach($regions as $region)
                                        <option value="{{ $region->id }}">{{ $region->region }}</option>
                                    @endforeach
                                </select>
                                @error('user_region')
                                <div class="text-danger text-errors font-italic" style="font-size: 11px;">
                                    {!! $message !!}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                class="control-label col-sm-4 align-self-center pt-0 text-md-right font-rajdhani-16 uppercase"
                                for="user_province">Provincia:</label>
                            <div class="col-sm-8">
                                <select class="form-control @error('user_province') is-invalid @enderror"
                                        id="user_province" wire:model="user_province">
                                    <option value="">Seleccionar...</option>
                                    @foreach($provinces as $province)
                                        <option value="{{ $province }}">{{ $province }}</option>
                                    @endforeach
                                </select>
                                @error('user_province')
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
