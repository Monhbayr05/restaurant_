@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary d-inline fs-5">Ресторан Жагсаалт</h6>
            <div class="float-end">
                <div class="create-page">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary p-2 " data-bs-toggle="modal" data-bs-target="#exampleModal">
                        +&nbsp; Ресторан Нэмэх
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ресторан үүсгэх</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-2">
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
            <div class="table responsive">
                <table class="table table-bordered align-items-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">ID</th>
                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Нэр</th>
                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Товчлол</th>
                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Байршил</th>
                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Утасны дугаар</th>
                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Үүсгэсэн огноо</th>
                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Үйлдлүүд</th>
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
                            <td class="editDelete justify-content-center">
                                <!-- Edit Button -->
                                <div class="dropdown dropstart">
                                    <button class="btn btn-white dropdown-toggle border-primary text-primary border-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Үйлдэл
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-black">
                                        <li class="d-flex align-items-center text-left me-3">
                                            <button type="button" class="dropdown-item btn-primary p-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                                <i class="fas fa-edit mr-2"></i>Өөрчлөх
                                            </button>
                                        </li>
                                        <li class="d-flex align-items-center text-left me-3">
                                            <form action="{{ route('admin.restaurant.delete', $item->id) }}" method="POST" style="display: inline-block; width:100%;">
                                                @csrf
                                                @method('DELETE')
                                                <button id="delete-button" type="submit" class="dropdown-item text-danger p-2">
                                                    <i class="fas fa-trash-alt mr-2"></i>Устгах
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                
                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editModalLabel{{ $item->id }}">Ресторан засах</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.restaurant.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="p-3">
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
                                                    <div class="mb-2 mt-4">
                                                        <button type="submit" class="btn btn-primary">Хадгалах</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

