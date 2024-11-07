@extends('layouts.admin')

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary d-inline fs-5">Бүтээгдэхүүн Жагсаалт</h6>
        <div class="float-end">
            <div class="create-page">
                <!-- Button trigger modal -->
                <a href="{{ route('admin.product.create') }}" class="btn btn-primary">
                    +&nbsp; Бүтээгдэхүүн нэмэх
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
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Товчлол</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Thumbnail</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Үнэ</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Тоо хэмжээ</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Status</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Үүсгэсэн огноо</th>
                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Үйлдлүүд</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>
                            <img src="{{ asset($item->thumbnail) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1" width="150px">
                        </td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->quantity_limit }}</td>
                        <td>
                            @if ($item->status == 0)
                                <span class="badge badge-sm bg-gradient-success">Ил</span>
                            @elseif ($item->status == 1)
                                <span class="badge badge-sm bg-gradient-primary">Нууц</span>
                            @else
                                <span class="badge badge-sm bg-gradient-warning">Бусад</span>
                            @endif
                        </td>
                        <td>{{ $item->created_at }}</td>
                        <td class="editDelete justify-content-center">
                            <div class="dropdown dropstart">
                                <button class="btn btn-white dropdown-toggle border-primary text-primary border-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Үйлдэл
                                </button>
                                <ul class="dropdown-menu dropdown-menu-black fade">
                                    <li class="d-flex align-items-center text-left me-3">
                                        <a href="{{ route('admin.product.edit', $item->id) }}" class="dropdown-item text-primary p-2" data-toggle="tooltip" >
                                            <i class="fas fa-edit mr-2"></i>Өөрчлөх
                                        </a>
                                    </li>
                                    <li class="d-flex align-items-center text-left me-3">
                                        <a href="{{ route('admin.product.image', ['id' => $item->id]) }}" class="dropdown-item text-success p-2" data-toggle="tooltip">
                                            <i class="fas fa-image mr-2"></i>
                                            Зураг нэмэх
                                        </a>
                                    </li>
                                    <li class="d-flex align-items-center text-left me-3">
                                    <form id="delete-form" action="{{ route('admin.product.delete', $item->id) }}" method="POST" style="display:inline; width:100%">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" id="delete-button" class="dropdown-item text-danger p-2">
                                            <i class="fas fa-trash-alt mr-2"></i>Устгах
                                        </button>
                                    </form>
                                    </li>
                                    <li class="d-flex align-items-center text-left me-3">
                                        <button type="button" class="dropdown-item btn-primary p-2" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}">
                                            <i class="fas fa-ellipsis-v mr-2"></i>
                                            Дэлгэрэнгүй 
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal for each product -->
                    <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel{{ $item->id }}">Дэлгэрэнгүй мэдээлэл</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <ul class="nav nav-tabs" id="productTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                                                Нүүр
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="false">
                                                Бүтээгдэхүүний Зураг
                                            </button>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="productTabContent">
                                        <div class="tab-pane fade show active border p-3" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab">

                                            <div class="mb-3">
                                                <label for="name" class="form-label">Бүтээгдэхүүний Нэр</label>
                                                <h6 class="form-control">{{ $item->name }}</h6>
                                            </div>

                                            <div class="mb-3">
                                                <label for="slug" class="form-label">Товчлол</label>
                                                <h6 class="form-control">{{ $item->slug }}</h6>
                                            </div>

                                            <div class="mb-3">
                                                <label for="quantity_limit" class="form-label">Тооны Хязгаар</label>
                                                <h6 class="form-control">{{ $item->quantity_limit }}</h6>
                                            </div>

                                            <div class="mb-3">
                                                <label for="description" class="form-label">Тодорхойлолт</label>
                                                <h6 class="form-control">{{ $item->description }}</h6>
                                            </div>

                                        </div>

                                        <!-- Image Tab -->
                                        <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab">
                                            <h2 class="mt-4">Оруулсан зургууд</h2>
                                            <div class="row">
                                                @if($item->productImages && $item->productImages->count() > 0)
                                                    @foreach($item->productImages as $image)
                                                        <div class="col-md-4 mb-3">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <img src="{{ asset($image->image) }}" class="card-img-top" alt="Бүтээгдэхүүний Зураг" width="250px" height="200px">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p>Энэхүү бүтээгдэхүүний хувьд зургууд байхгүй.</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
        // Utility function to add a delay (optional, for visual effect)
        function delay(seconds) {
            return new Promise(resolve => setTimeout(resolve, seconds * 1000));
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Add event listener to the form instead of the button to catch the submit event
            document.getElementById('delete-form').addEventListener('submit', async function(event) {
                event.preventDefault(); // Prevent immediate form submission

                // SweetAlert confirmation
                const result = await Swal.fire({
                    title: "Та итгэлтэй байна уу?",
                    text: "Та үүнийг буцааж авах боломжгүй болно!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Тийм, устгах!"
                });

                // If confirmed, delay (optional) and submit the form
                if (result.isConfirmed) {
                    await delay(1.5); // Optional delay
                    this.submit(); // Submit the form
                }
            });

            // Display success alert if session has 'delete'
            @if(session('delete'))
                (async () => {
                    await delay(1); // Optional delay
                    Swal.fire({
                        title: "Устгасан!",
                        text: "{{ session('delete') }}",
                        icon: "success",
                        confirmButtonText: "Ойлголоо"
                    });
                })();
            @endif
        });
    </script>

@endif
@endsection
