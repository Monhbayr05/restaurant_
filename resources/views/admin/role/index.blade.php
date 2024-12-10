@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary d-inline fs-5">Хэрэглэгчдийн Жагсаалт</h6>
            <div class="float-end">
                <div class="create-page">
                    <!-- Button trigger modal -->
                    <a href="{{ route('role.create') }}" class="btn btn-primary">
                        +&nbsp; Хэрэглэгч нэмэх
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table responsive">
                <table class="table table-bordered align-items-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">ID</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Нэр</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">И-мэйл</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Харьяалагдах ресторан</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Албан тушаал</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Үйлдэл</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->restaurant->name ?? 'Тодорхойгүй' }}</td>
                            <td>{{ $user->role->name ?? 'Тодорхойгүй' }}</td>
                            <td>
                                <form action="{{ route('role.destroy',$user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">
                                        Устгах
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('dataTable-script')
<script src="{{ asset('admin/assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/demo/datatables-demo.js') }}"></script>
@endsection
@section('alert')
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
@endsection

