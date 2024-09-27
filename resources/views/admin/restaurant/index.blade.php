@extends('layouts.admin')
@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Ресторан Оруулах</h6>
                        <div class="float-end">
                            <div class="create-page">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                    Ресторан үүсгэх
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="card-head">
                                                                    <h4 class="font-weight-light">
                                                                        Ресторан оруулах:
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="card-body">
                                                                    <form action="{{route('admin.restaurant.store')}}"
                                                                          method="POST"
                                                                          enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="mb-3">
                                                                            <label>Ресторан Нэр</label>
                                                                            <input type="text"
                                                                                   name="name"
                                                                                   class="form-control"
                                                                                   placeholder="Name"
                                                                                   value="{{old('name')}}">
                                                                            @error('name')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label>Товчлол</label>
                                                                            <input type="text"
                                                                                   name="slug"
                                                                                   class="form-control"
                                                                                   placeholder="Товчлол"
                                                                                   value="{{old('slug')}}">
                                                                            @error('slug')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label>Байршил</label>
                                                                            <input type="text"
                                                                                   name="location"
                                                                                   class="form-control"
                                                                                   placeholder="Байршил"
                                                                                   value="{{old('location')}}">
                                                                            @error('location')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="mb-2">
                                                                            <button type="submit"
                                                                                    class="btn btn-primary">
                                                                                Хадгалах
                                                                            </button>
                                                                            <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Close
                                                                            </button>
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
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Location</th>
                                    <th>Created at</th>
                                    <th>Edit and Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($restaurants as $item)
                                    <tr>
                                        <td>
                                            {{ $item->id }}
                                        </td>
                                        <td>
                                            {{ $item->name }}
                                        </td>
                                        <td>
                                            {{ $item->slug }}
                                        </td>
                                        <td>
                                            {{ $item->location }}
                                        </td>
                                        <td>
                                            {{ $item->created_at }}
                                        </td>
                                        <td class="editDelete">
                                            <!-- Edit Button -->
                                            <button type="button"
                                                    class="btn btn-primary"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $item->id }}">
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
                                                                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $item->name }}">
                                                                    @error('name')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>Товчлол</label>
                                                                    <input type="text" name="slug" class="form-control" placeholder="Товчлол" value="{{ $item->slug }}">
                                                                    @error('slug')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label>Байршил</label>
                                                                    <input type="text" name="location" class="form-control" placeholder="Байршил" value="{{ $item->location }}">
                                                                    @error('location')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-2">
                                                                    <button type="submit" class="btn btn-primary">Хадгалах</button>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <!-- The "Save changes" button inside modal-footer is redundant since you already have a submit button in the form -->
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
            </div>
        </div>
    </div>
@endsection
@section('modal-script')

@endsection
@section('script')
    <script src="{{ asset('admin/assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
@endsection
