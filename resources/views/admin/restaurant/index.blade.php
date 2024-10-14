@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ресторан Жагсаалт</h6>
            <div class="float-end">
                <div class="create-page">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Ресторан бүртгэх
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Шинэ Ресторан</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="card">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12"></div>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.restaurant.store') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label>Ресторан Нэр</label>
                                                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
                                                                @error('name')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Товчлол</label>
                                                                <input type="text" name="slug" class="form-control" placeholder="Товчлол" value="{{ old('slug') }}">
                                                                @error('slug')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Байршил</label>
                                                                <input type="text" name="location" class="form-control" placeholder="Байршил" value="{{ old('location') }}">
                                                                @error('location')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Утасны дугаар</label>
                                                                <input type="text" name="phone_number" class="form-control" placeholder="Утасны дугаар" value="{{ old('phone_number') }}">
                                                                @error('phone_number')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-2">
                                                                <button type="submit" class="btn btn-primary">Хадгалах</button>
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table align-items-center mb-2">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">ID</th>
                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Name</th>
                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Slug</th>
                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Location</th>
                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Phone_Number</th>
                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Created at</th>
                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Edit and Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($restaurants as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->slug }}</td>
                            <td>{{ $item->location }}</td>
                            <td>{{ $item->phone_number }}</td>
                            <td>{{ date('d-m-y', strtotime($item->created_at)) }}</td>
                            <td class="editDelete">
                                <!-- Edit Button -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                    Өөрчлөх
                                </button>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editModalLabel{{ $item->id }}">Ресторан засах</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.restaurant.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label>Ресторан Нэр</label>
                                                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name', $item->name) }}">
                                                        @error('name')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Товчлол</label>
                                                        <input type="text" name="slug" class="form-control" placeholder="Товчлол" value="{{ old('slug', $item->slug) }}">
                                                        @error('slug')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Байршил</label>
                                                        <input type="text" name="location" class="form-control" placeholder="Байршил" value="{{ old('location', $item->location) }}">
                                                        @error('location')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Утасны дугаар</label>
                                                        <input type="text" name="phone_number" class="form-control" placeholder="Утасны дугаар" value="{{ old('phone_number', $item->phone_number) }}">
                                                        @error('phone_number')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-2">
                                                        <button type="submit" class="btn btn-primary">Хадгалах</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('admin.restaurant.delete', $item->id) }}" method="POST" onsubmit="return confirm('Устгахдаа итгэлтэй байна уу?')" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Устгах</button>
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
<!-- @section('modal-script')

@endsection -->
@section('script')
    <script src="{{ asset('admin/assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
@endsection

