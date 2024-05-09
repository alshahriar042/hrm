<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>HRM</title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">



    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/morris/morris.css') }}">

    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet" type="text/css">

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">



    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />

    @stack('css')

    <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">

    <style>
        @media only screen and (max-width: 575px) {
            .content-page {
                margin-left: 0px;
            }

        }

        @media only screen and (min-width: 576px) and (max-width: 767px) {
            .content-page {
                margin-left: 0px;
            }
        }

        @media only screen and (min-width: 768px) and (max-width: 991px) {
            .content-page {
                margin-left: 0px;
            }
        }
    </style>
</head>

<body>
    <!-- Begin page -->
    <div id="wrapper">
        @include('backend.partials.header')
        @include('backend.partials.sidebar')

        <div class="content-page">
            @yield('content')
            @include('backend.partials.footer')
        </div>
    </div>
    <!-- END wrapper -->

    <!-- jQuery  -->
    <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/metismenu.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('backend/assets/js/waves.min.js') }}"></script>

    <!--Morris Chart-->
    <script src="{{ asset('backend/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/raphael/raphael.min.js') }}"></script>

    <script src="{{ asset('backend/assets/pages/dashboard.init.js') }}"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.0/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>

    <!-- App js -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> --}}

    <script type="text/javascript" src="{{ asset('js/sweetalert2@11.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/customSweetalert2.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

    <script src="{{ asset('js/iziToast.js') }}"></script>

    @include('vendor.lara-izitoast.toast')

    @stack('js')

    <script>
        $('.select2').select2({
            width: '100%'
        });



        $(document).ready(function() {
            // Function to open sidebar on mobile
            $('#openSidebar').click(function() {
                if ($('.side-menu').hasClass('d-none')) {
                    $('.side-menu').removeClass('d-none');
                    $('.side-menu').addClass('d-block');

                } else {
                    $('.side-menu').addClass('d-none');
                    $('.side-menu').removeClass('d-block');
                }

            });
        });
    </script>
</body>

</html>
