<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>@stack('title') | {{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="{{ asset('assets/font/iconsmind-s/css/iconsminds.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/font/simple-line-icons/css/simple-line-icons.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.css') }}"/>
    <link href="{{ asset('assets/plugins/icons/icons.css') }}" rel="stylesheet" type="text/css"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/logos/logo.svg') }}"/>

    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.rtl.only.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap-float-label.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/component-custom-switch.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/perfect-scrollbar.css') }}"/>

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.css') }}"/>

    @livewireStyles

    @stack('styles')

    @include('layouts.template.styles')

</head>

<body id="app-container" class="menu-default show-spinner scrollbar _scroller">
@if(!isset($is_auth) && empty($is_auth))
    {{-- BEGIN HEADER --}}
    @include('layouts.template.header')
    {{-- END HEADER --}}

    {{-- BEGIN SIDEBAR --}}
    @include('layouts.template.sidebar')
    {{-- END SIDEBAR --}}
@endif
<main>
    <div class="container-fluid">
        {{ $slot }}
    </div>
</main>

@if(!isset($is_auth) && empty($is_auth))
    {{-- BEGIN FOOTER --}}
    @include('layouts.template.footer')
    {{-- END FOOTER --}}
@endif

<script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/mousetrap.min.js') }}"></script>

@livewireScripts
@stack('scripts')

<script src="{{ asset('assets/js/dore.script.js') }}"></script>
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.js') }}"></script>

<script type="text/javascript">
    function notificationSwal(mssg, stl = 'rgba(8,129,120,0.9)', stts = 'success') {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            customClass: {
                popup: 'swal-modal'
            },
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: stts,
            title: `<div class="text-white font-sm">${mssg}</div>`,
            background: stl,
            iconColor: '#efefef',
        })
    }


    function deleteSwal() {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary ml-3',
                cancelButton: 'btn btn-danger mr-3',
                popup: 'swal-modal-delete',
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: '¿Estas seguro?',
            text: "¡No podrás revertir esto esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, Eliminarlo!',
            cancelButtonText: 'No, Cancelar!',
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {

                Livewire.emit('activeConfirm');

                swalWithBootstrapButtons.fire(
                    '¡Eliminado!',
                    'El registro ha sido eliminado. <i class="far fa-dizzy text-danger"></i>',
                    'success'
                )
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    '¡Cancelado!',
                    'Tu registro está a salvo <i class="far fa-smile-beam text-primary"></i>',
                    'error'
                )
            }
        })
    }
</script>


</body>

</html>
