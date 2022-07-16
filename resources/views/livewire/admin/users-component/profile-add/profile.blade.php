<div class="tab-pane fade show active">

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-none border rounded-0 p-4">

                <?php
                $dt = [
                    'name' => 'user_dni',
                    'text' => 'DNI',
                    'required' => 1,
                    'function' => 'searchData'
                ];
                ?>
                @include('livewire.widgets.admin.form.input-button-h', $dt)

                <?php
                $dt = [
                    'name' => 'user_firstname',
                    'text' => 'Nombres',
                    'required' => 1,
                    'type' => 'text',
                ];
                ?>
                @include('livewire.widgets.admin.form.input-h', $dt)

                <?php
                $dt = [
                    'name' => 'user_lastname',
                    'text' => 'Apellidos',
                    'required' => 1,
                    'type' => 'text',
                ];
                ?>
                @include('livewire.widgets.admin.form.input-h', $dt)

                <?php
                $dt = [
                    'name' => 'user_gender',
                    'text' => 'Sexo',
                    'required' => 0,
                    'object' => 'gender',
                    'options' => $genders
                ];
                ?>
                @include('livewire.widgets.admin.form.select-h', $dt)

                <?php
                $dt = [
                    'name' => 'user_relationship',
                    'text' => 'Estado civil',
                    'required' => 0,
                    'object' => 'marital_status',
                    'options' => $relationships
                ];
                ?>
                @include('livewire.widgets.admin.form.select-h', $dt)

                <?php
                $dt = [
                    'name' => 'user_birthdate',
                    'text' => 'Cumpleaños',
                    'required' => 0,
                    'type' => 'text',
                ];
                ?>
                @include('livewire.widgets.admin.form.input-h', $dt)

            </div>
        </div>
        <div class="col-md-6 mt-3 mt-md-0">
            <div class="card shadow-none border rounded-0 p-4">

                <?php
                $dt = [
                    'name' => 'user_biography',
                    'text' => 'Biografía',
                    'required' => 0,
                    'no_ignore' => 1,
                ];
                ?>
                @include('livewire.widgets.admin.form.textarea-h', $dt)

                <?php
                $dt = [
                    'name' => 'user_address',
                    'text' => 'Dirección',
                    'required' => 0,
                    'type' => 'text',
                ];
                ?>
                @include('livewire.widgets.admin.form.input-h', $dt)

                <?php
                $dt = [
                    'name' => 'user_region',
                    'text' => 'Región',
                    'required' => 0,
                    'object' => 'name',
                    'options' => $regions
                ];
                ?>
                @include('livewire.widgets.admin.form.select-h', $dt)

                <?php
                $p = null;
                $t = null;

                if ($user_region) {
                    $p = \App\Models\Region::find($user_region);
                }
                if ($user_province) {
                    $t = \App\Models\Province::find($user_province);
                }
                ?>

                <?php
                $dt = [
                    'name' => 'user_province',
                    'text' => 'Provincia',
                    'required' => 0,
                    'object' => 'name',
                    'options' => $p->provinces ?? []
                ];
                ?>
                @include('livewire.widgets.admin.form.select-h', $dt)

                <?php
                $dt = [
                    'name' => 'user_current_city',
                    'text' => 'Distrito',
                    'required' => 0,
                    'object' => 'name',
                    'options' => $t->towns ?? []
                ];
                ?>
                @include('livewire.widgets.admin.form.select-h', $dt)
            </div>
        </div>
    </div>

</div>

