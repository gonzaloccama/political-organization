<div class="tab-pane fade show active">
    <div class="row">
        <div class="col-md-7">
            <div class="card shadow-none border rounded-0 p-4">


                <?php
                $dt = [
                    'name' => 'user_group',
                    'text' => 'Rol de usuario',
                    'required' => 1,
                    'object' => 'name',
                    'options' => $roles
                ];
                ?>
                @include('livewire.widgets.admin.form.select-h', $dt)

                <?php
                $dt = [
                    'name' => 'username',
                    'text' => 'Nombre de usuario',
                    'required' => 1,
                    'type' => 'text',
                ];
                ?>
                @include('livewire.widgets.admin.form.input-h', $dt)


                <?php
                $dt = [
                    'name' => 'email',
                    'text' => 'Correo electrónico',
                    'required' => 1,
                    'type' => 'text',
                ];
                ?>
                @include('livewire.widgets.admin.form.input-h', $dt)


                <?php
                $dt = [
                    'name' => 'phone',
                    'text' => 'Celular',
                    'required' => 1,
                    'type' => 'text',
                ];
                ?>
                @include('livewire.widgets.admin.form.input-h', $dt)

            </div>
        </div>
        <div class="col-md-5 mt-3 mt-md-0">
            <div class="card shadow-none border rounded-0 p-4">

                <?php
                $dt = [
                    'name' => 'user_activated',
                    'text' => 'Cuenta activada',
                    'required' => 0,
                    'type' => 'checkbox',
                ];
                ?>
                @include('livewire.widgets.admin.form.input-h', $dt)



                <?php
                $dt = [
                    'name' => 'user_banned',
                    'text' => 'Usuario banneado',
                    'required' => 0,
                    'type' => 'checkbox',
                ];
                ?>
                @include('livewire.widgets.admin.form.input-h', $dt)


                <?php
                $dt = [
                    'name' => 'user_email_verified',
                    'text' => 'Correo verificado',
                    'required' => 0,
                    'type' => 'checkbox',
                ];
                ?>
                @include('livewire.widgets.admin.form.input-h', $dt)

                <?php
                $dt = [
                    'name' => 'user_verified',
                    'text' => 'Usuario verificado',
                    'required' => 0,
                    'type' => 'checkbox',
                ];
                ?>
                @include('livewire.widgets.admin.form.input-h', $dt)

            </div>
        </div>
    </div>
</div>




