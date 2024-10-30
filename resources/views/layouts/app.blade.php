<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Inventory</title>
    <!-- This page CSS -->
    <!-- chartist CSS -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('../assets/node_modules/morrisjs/morris.css') }}" rel="stylesheet">
    <!--Toaster Popup message CSS -->
    <link href="{{ asset('../assets/node_modules/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
    <!-- Morris CSS -->
    <link href="{{ asset('../assets/node_modules/morrisjs/morris.css') }}" rel="stylesheet">
            <!-- Dashboard 1 Page CSS -->
            <link href="{{asset('dist/css/pages/dashboard1.css')}}" rel="stylesheet">

            @vite(['resources/js/app.js'])
    <!-- Custom CSS -->


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="skin-blue fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Elite admin</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            @include('partials.navbar')
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        @include('partials.sidebar')
            @yield('content')
        @include('partials.rightbar')

    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    @stack('scripts')
    
    <script src="{{ asset('../assets/node_modules/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('../assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('dist/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('dist/js/custom.min.js') }}"></script>      <!-- ============================================================== -->  <!-- This page plugins -->
        <!-- ============================================================== -->
        <!--morris JavaScript -->
        {{-- <script src="{{asset('../assets/node_modules/raphael/raphael-min.js')}}"></script>
        <script src="{{asset('../assets/node_modules/morrisjs/morris.min.js')}}"></script>
        <script src="{{asset('../assets/node_modules/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
        <!-- Popup message jquery -->
        <script src="{{asset('../assets/node_modules/toast-master/js/jquery.toast.js')}}"></script> --}}
        <!-- Chart JS -->
        {{-- <script src="{{asset('dist/js/dashboard1.js')}}"></script> --}}

       
        <script src="https://cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
            
</body>

</html>