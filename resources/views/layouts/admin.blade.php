<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>

    {{-- CSS --}}
    <!-- custom fonts  -->
    <link href="{{ asset('admin/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- google font  -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- styles  -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/sb-admin-2.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/css/datatable/datatable.css')}}">


    <!-- bootstrap 4  -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/datatables/dataTables.bootstrap4.css')}}">

    <!-- bootstrap 5  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- bootstrap icons  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">




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

@stack('scripts')



<!-- jquery  -->
<script src="{{ asset('admin/assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>



<!-- sb admin  -->
<script src="{{ asset('admin/assets/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{ asset('admin/assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>

<!-- eniig commentloson  -->



<!-- Page level custom scripts -->
<script src="{{ asset('admin/assets/js/demo/datatables-demo.js') }}"></script>

<!-- real datatable  -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('admin/assets/js/datatable/datatable_bundle.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatable/datatable_jquery.js') }}"></script>

<!-- eniig bas  -->
<script src="{{ asset('admin/assets/js/datatable/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatable/dataTables.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>




<!-- sweetalert  -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- charts  -->




<!-- bootstrap5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>



@yield('alert')
@yield('dataTable-script')
</body>
</html>
