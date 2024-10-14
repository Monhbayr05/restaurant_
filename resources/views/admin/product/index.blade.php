@extends('layouts.admin')

@section('content')
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Бүтээгдэхүүн Жагсаалт</h6>
                    <div class="float-end">
                        <div class="create-page">
                            <!-- Button trigger modal -->
                            <a href="{{route('admin.product.create')}}" class="btn btn-primary">
                                +&nbsp; Бүтээгдэхүүн бүртгэх
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table align-items-center mb-0" id="dataTable"  style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">ID</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Name</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Slug</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Description</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Thumbnail</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Price</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Sale_percent</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Quantity</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Status</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Trending</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Created Date</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Edit, Image, and Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $item->name }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td><p class="text-xs font-weight-bold mb-0">{{ $item->slug }}</p></td>
                                <td><p class="text-xs font-weight-bold mb-0">{{ $item->description }}</p></td>
                                <td><div><img src="{{ asset($item->thumbnail) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1" width="150px"></div></td>
                                <td><p class="text-xs text-center font-weight-bold mb-0">{{ $item->price }}</p></td>
                                <td><p class="text-xs text-center font-weight-bold mb-0">{{ $item->sale_percent }}</p></td>
                                <td><p class="text-xs text-center font-weight-bold mb-0">{{ $item->quantity }}</p></td>
                                <td class="align-middle text-center text-sm">
                                    @if ($item->status == 0)
                                        <span class="badge badge-sm bg-gradient-success">Идэвхтэй</span>
                                    @elseif ($item->status == 1)
                                        <span class="badge badge-sm bg-gradient-primary">Идэвхгүй</span>
                                    @else
                                        <span class="badge badge-sm bg-gradient-warning">Бусад</span>
                                    @endif
                                </td>
                                <td class="align-middle text-center"><span class="text-secondary text-xs font-weight-bold">{{ $item->created_at }}</span></td>
                                <td class="align-middle">
                                    <a href="{{ route('admin.product.edit', $item->id) }}" class="btn btn-info" data-toggle="tooltip" width="60px">Edit</a>
                                    <a href="{{ route('admin.product.image', ['id' => $item->id]) }}" class="btn btn-primary" data-toggle="tooltip" width="60px">Image</a>
                                    <form action="{{ route('admin.product.delete', $item->id) }}" method="POST" onsubmit="return confirm('Устгахдаа итгэлтэй байна уу?')" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" width="60px">Delete</button>
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
@endsection
@section('script')
    <script src="{{ asset('admin/assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
@endsection


