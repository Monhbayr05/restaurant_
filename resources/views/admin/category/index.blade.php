@extends('layouts.admin')
@section('content')
<div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Ангилал үүсгэх</h6>
                        <div class="float-end">
                            <div class="create-page">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                    Ангилал үүсгэх
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Ангилал үүсгэх</h1>
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
                                                                        Ангилал оруулах:
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="card-body">
                                                                    <form action="{{route('admin.category.store')}}"
                                                                          method="POST"
                                                                          enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="mb-3">
                                                                            <label>Ресторан сонгох</label>
                                                                            <select name="restaurant_id"
                                                                                    class="form-select"
                                                                                    aria-label="Default select example">
                                                                                <option>Ресторан сонго</option>
                                                                                @foreach($restaurants as $restaurant)
                                                                                    <option
                                                                                        value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('restaurant_id')
                                                                            <small
                                                                                class="text-danger">{{$message}}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label>Ангилал нэр</label>
                                                                            <input type="text"
                                                                                   name="name"
                                                                                   class="form-control"
                                                                                   placeholder="Ангилал нэр"
                                                                                   value="{{old('name')}}">
                                                                            @error('name')
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
                        <table id="dataTable" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Restaurant name</th>
                                <th>Created At</th>
                                <th>Edit and Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->restaurant->name }}</td>
                                    <td>{{ $item->created_at }}</td>
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
                                                        <form action="{{ route('admin.category.update', encrypt($item->id)) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label>Ширээний Нэр</label>
                                                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $item->name }}">
                                                                @error('name')
                                                                <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Ресторан сонгох</label>
                                                                <select name="restaurant_id"
                                                                        class="form-select"
                                                                        aria-label="Default select example">
                                                                    <option value="">Ресторан сонго</option>
                                                                    @foreach($restaurants as $restaurant)
                                                                        <option value="{{ $restaurant->id }}"
                                                                            {{ old('restaurant_id') == $restaurant->id ? 'selected' : '' }}>
                                                                            {{ $restaurant->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>

                                                                @error('restaurant_id')
                                                                <small
                                                                    class="text-danger">{{$message}}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Хадгалах</button>
                                                                <!-- The "Save changes" button inside modal-footer is redundant since you already have a submit button in the form -->
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="{{ route('admin.category.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Устгахдаа итгэлтэй байна уу?')" style="display: inline-block;">
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
@endsection

@section('script')
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>
@endsection

