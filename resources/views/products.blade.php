

@foreach($products as $product)
    <h1>{{$product->name}}</h1>
    <img src=" {{ asset($product->thumbnail) }} ">
@endforeach
