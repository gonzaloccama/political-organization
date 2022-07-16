<div class="form-side">

    <h6 class="mb-4">Iniciar sesión</h6>
    <form>
        <?php
        $dt = [
            'name' => 'email',
            'text' => 'Correo Electrónico',
            'type' => 'text',
            'required' => 1,
        ];
        ?>
        @include('livewire.widgets.admin.form.input-float', $dt)

        <?php
        $dt = [
            'name' => 'password',
            'text' => 'Contraseña',
            'type' => 'password',
            'required' => 1,
        ];
        ?>
        @include('livewire.widgets.admin.form.input-float', $dt)

        <div class="d-flex justify-content-between align-items-center">
            <a href="#">¿Contraseña olvidada?</a>
            <a href="javascript:;" wire:click.prevent="updatePanel">Iniciar con google</a>
            <button class="btn btn-primary btn-lg btn-shadow"
                    wire:loading.attr="disabled" wire:target="login"
                    wire:click.prevent="login" type="submit">
                <div wire:loading.remove wire:target="login">
                    Iniciar sesión
                </div>
                <div wire:loading wire:target="login" class="text-white-50">
                    <div class="spinner-grow spinner-grow-sm" role="status"></div> Iniciando...
                </div>
            </button>
        </div>
    </form>

    @if($message = Session::get('error'))
        <div class="alert alert-danger mt-3">
            {{ $message }}
        </div>
    @endif
</div>

