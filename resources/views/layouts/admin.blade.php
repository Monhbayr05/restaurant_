<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>

    {{-- CSS --}}
    <!-- custom fonts  -->
    <link href="{{ asset('admin/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('admin/assets/css/sb-admin_2.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">


    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('admin/assets/css/datatable/datatable.css') }}">

</head>
<body>
<div id="wrapper">
    @include('layouts.inc.admin.sidebar')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
        @include('layouts.inc.admin.header')
            <div class="container-fluid">
                    @yield('content')
            </div>
        </div>
        @include('layouts.inc.admin.footer')
    </div>
</div>
{{-- Scripts --}}
<script src="{{ asset('admin/assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


<script src="{{ asset('admin/assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>



<script src="{{ asset('admin/assets/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{ asset('admin/assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
<script src="{{ asset('admin/assets/js/demo/datatables-demo.js') }}"></script>


<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('admin/assets/js/datatable/datatable_bundle.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatable/datatable_jquery.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatable/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatable/dataTables.js') }}"></script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@yield('script')
@yield('dataTable-script')
</body>
</html>
