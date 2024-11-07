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

