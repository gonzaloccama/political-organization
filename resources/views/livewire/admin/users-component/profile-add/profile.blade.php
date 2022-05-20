<div class="tab-pane fade show active">
    <form action="">
        <div class="separator mb-5"></div>
        <h4 class="mb-5 mt-4 text-muted">IDENTIFICACIÓN</h4>
        <div class="form-row">

            <div class="form-group col-md-6">
                <label for="user_dni">DNI</label>
                <div class="input-group mb-1" wire:ignore>
                    <input type="text" class="form-control" aria-label="DNI" id="user_dni"
                           placeholder="DNI" wire:model="user_dni" aria-describedby="button-dni">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button"
                                wire:click.prevent="searchData"
                                id="button-dni">Buscar...
                        </button>
                    </div>
                </div>
                @error('user_dni')
                <span class="text-danger text-error text-small font-italic">
                        <i class="simple-icon-info"></i> {!! $message !!}
                    </span>
                @enderror
            </div>

        </div>

        <div class="separator mb-5"></div>
        <h4 class="mb-4 mt-4 text-muted">INFORMACIÓN BASICA</h4>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="user_firstname">Nombres</label>
                <input type="text" class="form-control" id="user_firstname"
                       placeholder="Nombres" wire:model="user_firstname">
                @error('user_firstname')
                <span class="text-danger text-error text-small font-italic">
                    <i class="simple-icon-info"></i> {!! $message !!}
                </span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="user_lastname">Apellidos</label>
                <input type="text" class="form-control" id="user_lastname"
                       placeholder="Apellidos" wire:model="user_lastname">
                @error('user_lastname')
                <span class="text-danger text-error text-small font-italic">
                    <i class="simple-icon-info"></i> {!! $message !!}
                </span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="user_gender">Sexo</label>
                <select id="user_gender" class="form-control" wire:model="user_gender">
                    <option value="0">Seleccionar...</option>
                    @foreach($genders as $gender)
                        <option value="{{ $gender->id }}">{{ $gender->gender }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="user_relationship">Estado civil</label>
                <select id="user_relationship" class="form-control"
                        wire:model="user_relationship">
                    <option value="0">Seleccionar...</option>
                    @foreach($relationships as $relationship)
                        <option value="{{ $relationship->id }}">{{ $relationship->marital_status }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="user_birthdate">Fecha de nacimiento</label>
            <input type="text" class="form-control" id="user_birthdate"
                   wire:model="user_birthdate" placeholder="Fecha de nacimiento">
        </div>

        <div class="form-group">
            <label for="user_biography">Sobre mí</label>
            <textarea type="text" class="form-control" id="user_biography"
                      wire:model="user_biography"
                      placeholder="Biografía"> </textarea>
        </div>

        <div class="separator mb-5"></div>
        <h4 class="mb-5 mt-4 text-muted">UBICACIÓN</h4>

        <div class="form-group row">
            <label for="user_address" class="col-sm-3 col-form-label">Dirección</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="user_address"
                       wire:model="user_address"
                       placeholder="Jr. Bolivar #321 - Ubanización Manco Ccapa, Azangaro">
            </div>
        </div>

        <div class="form-group row">
            <label for="user_region" class="col-sm-3 col-form-label">Región</label>
            <div class="col-sm-9">
                <select id="user_region" class="form-control" wire:model="user_region">
                    <option value="0">Seleccionar...</option>
                    @foreach($regions as $dep)
                        <option value="{{ $dep->id }}">{{ $dep->region }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        @php
            if ($user_region) {
                $provincias = \App\Models\Departamento::where('id', $user_region)->first();
            }
        @endphp

        <div class="form-group row">
            <label for="user_province" class="col-sm-3 col-form-label">Provincia</label>
            <div class="col-sm-9">
                <select id="user_province" class="form-control" wire:model="user_province">
                    <option value="0">Seleccionar...</option>
                    @if($provincias)
                        @foreach(json_decode($provincias->province) as $prov)
                            <option value="{{ $prov }}">{{ $prov }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

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
    </form>
</div>

