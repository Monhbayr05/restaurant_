<table class="table table-bordered text-center align-items-center" id="table2">
    <thead class="pt-4">
    <tr>
        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Ширээний ID</th>
        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Захиалагчийн нэр</th>
        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Утасны дугаар</th>
        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Хоолны харшил</th>
        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Нийт үнэ</th>
        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Хоолны нэр</th>
        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Тоо ширхэг</th>
    </tr>
    </thead>


    <tbody>
    @foreach($orders as $order)
        @foreach($order->orderItems as $item)
            <tr>
                <td>{{ $item->table_id }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->phone_number }}</td>
                <td>{{ $order->allergies }}</td>
                <td>{{ $order->price }}</td>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
            </tr>
        @endforeach
    @endforeach
    </tbody>
</table>
