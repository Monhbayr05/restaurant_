@extends('layouts.manager')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Хэрэглэгчдийн Жагсаалт</h3>
                    <p class="text-subtitle text-muted">hdhjkfhdjkfhdjk</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Хэрэглэгчдийн Жагсаалт</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Хэрэглэгчдийн Жагсаалт</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card shadow ">
                <div class="card-header py-3 d-flex justify-content-between align-items-center mt-4 mb-10">
                    <h5 class="card-title">
                        Хэрэглэгчдийн Жагсаалт
                    </h5>
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
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Нэр</th>
                                <th>И-мэйл</th>
                                <th>Харьяалагдах ресторан</th>
                                <th>Албан тушаал</th>
                                <th>Үйлдэл</th>
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
        </section>
    </div>
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


@endsection
