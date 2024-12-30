<div class="p-4 bg-gray-100 min-h-screen">
    @if($orderItems->isEmpty())
        <p class="text-gray-600">No orders available.</p>
    @else
        <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-800 text-white">
            <tr>
                <th class="px-4 py-2 text-left">Table ID</th>
                <th class="px-4 py-2 text-left">Food Name</th>
                <th class="px-4 py-2 text-left">Quantity</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orderItems as $item)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $item->table_id }}</td>
                    <td class="px-4 py-2">{{ $item->food_name }}</td>
                    <td class="px-4 py-2">{{ $item->quantity }}</td>
                    <td class="px-4 py-2 space-x-2">
                        @if($item->food_status === 0)
                            <button wire:click="markAsPrepared({{ $item->id }})"
                                    class="bg-blue-500 text-white px-4 py-2 rounded">
                                Mark as Prepared
                            </button>
                        @endif
                        @if($item->food_status === 1)
                            <button wire:click="markAsDone({{ $item->id }})"
                                    class="bg-green-500 text-white px-4 py-2 rounded">
                                Mark as Done
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
