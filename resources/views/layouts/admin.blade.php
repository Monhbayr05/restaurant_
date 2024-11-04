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




<!-- jquery  -->
<script src="{{ asset('admin/assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<script src="{{ asset('admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>



<!-- sb admin  -->
<script src="{{ asset('admin/assets/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{ asset('admin/assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>



<!-- Page level custom scripts -->
<script src="{{ asset('admin/assets/js/demo/datatables-demo.js') }}"></script>

<!-- real datatable  -->
<!-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('admin/assets/js/datatable/datatable_bundle.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatable/datatable_jquery.js') }}"></script> -->
<script src="{{ asset('admin/assets/js/datatable/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('admin/assets/js/datatable/dataTables.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>


<!-- sweetalert  -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- charts  -->

<!-- Page level plugins -->
 <script src="{{ asset('admin/asset/vendor/chart.js/Chart.min.js') }} "></script>
 <script src="{{ asset('admin/asset/vendor/chart.js/Chart.bundle.min.js') }} "></script>

<!-- Page level custom scripts -->
 <script src="{{ asset('admin/assets/js/demo/chart-area-demo.js') }}"></script>
 <script src="{{ asset('admin/assets/js/demo/chart-pie-demo.js') }}"></script>
 <script src="{{ asset('admin/assets/js/demo/chart-bar-demo.js') }}"></script>



<!-- sweetalerts  -->

@if (Session::has('success'))
    <script>
        Swal.fire({
            title: " Амжилттай!",
            text: "{{ Session::get('success') }}",
            icon: "success"
        });
    </script>
@endif

@if (Session::has('error'))
    <script>
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "{{ Session::get('error') }}!",
        });
    </script>
@endif

@if (Session::has('delete'))
    
    <script>

        function delay(seconds) {
            return new Promise(resolve => setTimeout(resolve, seconds * 1000));
        }

        document.getElementById('delete-button').addEventListener('click', async function(event) {


            const result = await Swal.fire({
                title: "Та итгэлтэй байна уу?",
                text: "Та үүнийг буцааж авах боломжгүй болно!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Тийм, устгах!"
            });

            if (result.isConfirmed) {
                await delay(1.5); 
                document.getElementById('delete-form').submit();
            }
        });


        @if(session('delete'))
            (async () => {
                await delay(0.5);
                Swal.fire({
                    title: "Устгасан!",
                    text: "{{ session('delete') }}",
                    icon: "success",
                    confirmButtonText: "Ойлголоо"
                });
            })();
        @endif
    </script>
@endif



@yield('dataTable-script')
</body>
</html>
