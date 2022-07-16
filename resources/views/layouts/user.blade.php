<?php
$sttngs = \App\Models\SystemSetting::find(1);
?>
    <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> @stack('title') | Social | {{ config('app.name', $sttngs->name) }}</title>
    <meta name="robots" content="index, follow"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/iconsmind-s/css/iconsminds.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/simple-line-icons/css/simple-line-icons.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.css') }}"/>
    <link href="{{ asset('assets/plugins/icons/icons.css') }}" rel="stylesheet" type="text/css"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/logos/logo.svg') }}"/>
    <!-- Bootstrap CSS -->
    {{--    <link rel="stylesheet" href="{{ asset('assets/social/css/bootstrap.min.css') }}"/>--}}
    <link href="{{ asset('assets/css/vendor/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Typography CSS -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/typography.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/plugins/baguetteBox/baguetteBox.css') }}">

    <!-- Begin emoji-picker Stylesheets -->
    {{--    <link href="{{ asset('assets/plugins/emoji/css/emoji.css" rel="stylesheet') }}">--}}
<!-- End emoji-picker Stylesheets -->

    {{--    <link href="{{ asset('assets/admin/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>--}}

    {{--    <meta name="theme-color" content="#00365A"/>--}}
    {{--    <link rel="apple-touch-icon" href="{{ asset('assets/images/logo/logo.png') }}">--}}
    {{--    <link rel="manifest" href="{{ asset('/manifest.json') }}">--}}

    @livewireStyles

    @stack('styles')


    @include('layouts.template.user.styles')

</head>
<body class="right-column-fixed">
<!-- loader Start -->
<div id="loading">
    <div id="loading-center">
    </div>
</div>
<!-- loader END -->
<!-- Wrapper Start -->
<div class="wrapper" style="background-color: rgba(0,54,90,0.03);">
@if(!isset($is_auth) && empty($is_auth))
    <!-- Sidebar  -->
    @include('layouts.template.user.sidebar')
    <!-- TOP Nav Bar -->
    @include('layouts.template.user.header')
    <!-- TOP Nav Bar END -->
        <!-- Right Sidebar Panel Start-->
    @include('layouts.template.user.sidebar-mini')
    <!-- Right Sidebar Panel End-->
        <!-- Page Content  -->
        <div id="content-page" class="content-page">
            @endif


            {{ $slot }}


        </div>
        <!-- Wrapper END -->
        @if(!isset($is_auth) && empty($is_auth))
</div>
<!-- Footer -->
@include('layouts.template.user.footer')
<!-- Footer END -->
@endif
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
{{--<script src="{{ asset('assets/user/js/popper.min.js') }}"></script>--}}
<script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
<!-- Appear JavaScript -->
<script src="{{ asset('assets/user/js/jquery.appear.js') }}"></script>
<!-- Countdown JavaScript -->
<script src="{{ asset('assets/user/js/countdown.min.js') }}"></script>
<!-- Counterup JavaScript -->
<script src="{{ asset('assets/user/js/waypoints.min.js') }}"></script>
<script src="{{ asset('assets/user/js/jquery.counterup.min.js') }}"></script>
<!-- Wow JavaScript -->
<script src="{{ asset('assets/user/js/wow.min.js') }}"></script>
<!-- Apexcharts JavaScript -->
<script src="{{ asset('assets/user/js/apexcharts.js') }}"></script>
<!-- Slick JavaScript -->
<script src="{{ asset('assets/user/js/slick.min.js') }}"></script>
<!-- Select2 JavaScript -->
<script src="{{ asset('assets/user/js/select2.min.js') }}"></script>
<!-- Owl Carousel JavaScript -->
<script src="{{ asset('assets/user/js/owl.carousel.min.js') }}"></script>
<!-- Magnific Popup JavaScript -->
<script src="{{ asset('assets/user/js/jquery.magnific-popup.min.js') }}"></script>
<!-- Smooth Scrollbar JavaScript -->
<script src="{{ asset('assets/user/js/smooth-scrollbar.js') }}"></script>
<!-- lottie JavaScript -->
<script src="{{ asset('assets/user/js/lottie.js') }}"></script>
<!-- am core JavaScript -->
<script src="{{ asset('assets/user/js/core.js') }}"></script>
<!-- am charts JavaScript -->
<script src="{{ asset('assets/user/js/charts.js') }}"></script>
<!-- am animated JavaScript -->
<script src="{{ asset('assets/user/js/animated.js') }}"></script>
<!-- am kelly JavaScript -->
<script src="{{ asset('assets/user/js/kelly.js') }}"></script>
<!-- am maps JavaScript -->
<script src="{{ asset('assets/user/js/maps.js') }}"></script>
<!-- am worldLow JavaScript -->
<script src="{{ asset('assets/user/js/worldLow.js') }}"></script>
<!-- Chart Custom JavaScript -->
<script src="{{ asset('assets/user/js/chart-custom.js') }}"></script>
<!-- Custom JavaScript -->
<script src="{{ asset('assets/user/js/custom.js') }}"></script>

{{--<script src="{{ asset('assets/admin/libs/select2/select2.min.js') }}"></script>--}}

<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/baguetteBox/baguetteBox.js') }}"></script>

@livewireScripts

@stack('scripts')

<script type="text/javascript">
    // $(".media-comment").on('input', function() {
    //     var scroll_height = $(this).get(0).scrollHeight;
    //
    //     $(this).css('height', scroll_height + 'px');
    // });


    function notificationSwal(mssg, stl) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'success',
            title: `<div class="text-white swal-notification">${mssg}</div>`,
            background: stl,
            iconColor: '#efefef',
        })
    }

    function deleteSwal() {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary ml-3',
                cancelButton: 'btn btn-danger mr-3'
            },
            buttonsStyling: false,
            background: 'rgba(255,255,255,0.85)',
        })

        swalWithBootstrapButtons.fire({
            title: '<span class="text-swal">¿Estas seguro?</span>',
            html: '<span class="text-swal">¡No podrás revertir esto esta acción!</span>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, Eliminarlo!',
            cancelButtonText: 'No, Cancelar!',
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {

                Livewire.emit('activeConfirm');

                swalWithBootstrapButtons.fire(
                    '<span class="text-swal">¡Eliminado!</span>',
                    '<span class="text-swal">El registro ha sido eliminado.</span> <i class="simple-icon-trash text-danger"></i>',
                    'success'
                )
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    '<span class="text-swal">¡Cancelado!</span>',
                    '<span class="text-swal">Tu registro está a salvo</span> <i class="simple-icon-emotsmile text-primary"></i>',
                    'error'
                )
            }
        })
    }

    function lightbox(sel) {
        baguetteBox.run(sel, {
            animation: 'fadeIn',
            noScrollbars: true,
        });
    }


</script>

</body>
</html>
