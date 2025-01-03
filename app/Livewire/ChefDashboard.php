<?php

namespace App\Livewire;

use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChefDashboard extends Component
{
    public $orderItems;
    public $restaurantId;

    protected $listeners = ['orderUpdated' => 'refreshOrders'];

    public function mount($restaurantId)
    {
        $this->restaurantId = $restaurantId;
        $this->refreshOrders();
    }

    public function refreshOrders()
    {
        $this->orderItems = OrderItem::with(['product', 'order.table'])
            ->whereHas('product.category', function ($query) {
                $query->where('restaurant_id', $this->restaurantId);
            })
            ->where('food_status', '<', 2)
            ->orderBy('created_at', 'desc')
            ->get();
        dd($this->orderItems);
    }

    public function markAsPrepared($itemId)
    {
        $orderItem = OrderItem::find($itemId);
        if ($orderItem && $this->isOrderBelongsToRestaurant($orderItem)) {
            $orderItem->food_status = 1;
            $orderItem->save();
            $this->refreshOrders();
        }
    }

    public function markAsDone($itemId)
    {
        $orderItem = OrderItem::find($itemId);
        if ($orderItem && $this->isOrderBelongsToRestaurant($orderItem)) {
            $orderItem->food_status = 2;
            $orderItem->save();
            $this->refreshOrders();
        }
    }

    public function isOrderBelongsToRestaurant($orderItem)
    {
        return $orderItem->table->restaurant_id == $this->restaurantId;
    }

    public function render()
    {
        return view('livewire.chef-dashboard');
    }
}
