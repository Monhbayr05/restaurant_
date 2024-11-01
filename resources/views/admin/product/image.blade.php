@extends('layouts.admin')

@section('content')
    <div class="container">
        <a href="{{ route('admin.product.index') }}" class="btn btn-secondary mb-3">Буцах</a>
        <h1>{{ $product->name }} <span class="fs-3 opacity-50">- Бүтээгдэхүүний зургууд</span></h1>


        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.product.storeImage', $product->id) }}" method="POST" enctype="multipart/form-data" class="">
            @csrf

            <div class="form-group mb-3">
                <label for="image">Бүтээгдэхүүний Зургийг Нэмэх</label>
                <input type="file" name="image[]" class="form-control" multiple accept="image/*">
                <small class="form-text text-muted">Та олон зураг оруулж болно.</small>
            </div>

            <button type="submit" class="btn btn-primary">Оруулах</button>
        </form>

        <h2 class="mt-4">Оруулсан зургууд</h2>
        <div class="row">
            @if($product->productImages && $product->productImages->count() > 0)
                @foreach($product->productImages as $image)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="{{ asset($image->image) }}" class="card-img-top" alt="Бүтээгдэхүүний Зураг" width="250px" height="200px">
                            <div class="card-body">
                                <button type="button" class="btn btn-danger delete-image-button" data-id="{{ $image->id }}">Устгах</button>
                                <form id="delete-image-form-{{ $image->id }}" action="{{ route('admin.product.imageDestroy', $image->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Энэхүү бүтээгдэхүүний хувьд зургууд байхгүй.</p>
            @endif
        </div>

    </div>
@endsection
@section('script')
<script>
    // Delay function to simulate waiting before the form submits
    function delay(seconds) {
        return new Promise(resolve => setTimeout(resolve, seconds * 1000));
    }

    // Add event listener for each delete button
    document.querySelectorAll('.delete-image-button').forEach(button => {
        button.addEventListener('click', async function(event) {
            const id = event.target.getAttribute('data-id');
            
            // SweetAlert confirmation dialog
            const result = await Swal.fire({
                title: "Та итгэлтэй байна уу?",
                text: "Та энэ зургийг устгахыг хүсч байна уу?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Тийм, устгах!"
            });

            // If confirmed, submit the form
            if (result.isConfirmed) {
                await delay(1.5); // Optional delay before form submission
                document.getElementById(`delete-image-form-${id}`).submit();
            }
        });
    });
    @if(Session::has('delete'))
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

@endsection
