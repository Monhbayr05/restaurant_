@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div
                            class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                            <h6 class="text-white text-capitalize ps-2 mb-0">All Products</h6>

                            <a href="{{route('admin.product.create')}}"
                               class="btn bg-gradient-primary btn-sm mb-0 me-3">
                                +&nbsp; New Product
                            </a>
                        </div>
                    </div>

                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>

                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">
                                        Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10 ">
                                        Slug
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">
                                        Description
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">
                                        Thumbnail
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">
                                        Price
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">
                                        Sale_percent
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">
                                        Quantity
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">
                                        Status
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">
                                        Trending
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">
                                        Created Date
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">
                                        Edit, Image and Delete
                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($products as $item )
                                    <tr>


                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$item->name}}</h6>
                                                </div>
                                            </div>
                                        </td>


                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$item->slug}}</p>
                                        </td>


                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$item->description}}</p>
                                        </td>


                                        <td>
                                            <div>
                                                <img src="{{asset($item->thumbnail)}}"
                                                     class="avatar avatar-sm me-3 border-radius-lg" alt="user1"
                                                     width="150px" height="100px">
                                            </div>
                                        </td>

                                        <td>
                                            <p class="text-xs text-center font-weight-bold mb-0">{{$item->price}}</p>
                                        </td>


                                        <td>
                                            <p class="text-xs text-center font-weight-bold mb-0">{{$item->sale_percent}}</p>
                                        </td>


                                        <td>
                                            <p class="text-xs text-center font-weight-bold mb-0">{{$item->quantity}}</p>
                                        </td>


                                        <td class="align-middle text-center text-sm">
                                            @if ($item->status == 0)
                                                <span class="badge badge-sm bg-gradient-success">Public</span>
                                            @elseif ($item->status == 1)
                                                <span class="badge badge-sm bg-gradient-primary">Private</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-warning">Other</span>
                                            @endif
                                        </td>

                                        <td class="align-middle text-center text-sm">
                                            @if ($item->trending == 1)
                                                <span class="badge badge-sm bg-gradient-success">Trending</span>
                                            @else
                                                <span class="badge badge-sm bg-gradient-warning">Not Trending</span>
                                            @endif
                                        </td>


                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{$item->created_at}}</span>
                                        </td>


                                        <td class="align-middle">
                                            <a href="{{ route('admin.product.edit',  $item->id) }}" class="btn btn-info"
                                               data-toggle="tooltip" width='60px'>
                                                Edit
                                            </a>

                                            <a href="{{ route('admin.product.image',  ['id'=> $item->id]) }}"
                                               class="btn btn-primary" data-toggle="tooltip" width='60px'>
                                                Image
                                            </a>

                                            <form action="{{route('admin.product.delete', $item->id)}}" method="POST"
                                                  onsubmit="return confirm('Are you sure to Delete this Data?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-primary" width='60px'>
                                                    Delete
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
            </div>
        </div>
    </div>
@endsection
