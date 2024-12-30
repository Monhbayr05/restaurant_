<?php

namespace App\Livewire;

use App\Models\OrderItem;
use Livewire\Component;

class ChefDashboard extends Component
{
    public $orderItems;
    public $restaurantId; // Тогоочийн рестораны ID

    protected $listeners = ['orderUpdated' => 'refreshOrders'];

    public function mount($restaurantId)
    {
        $this->restaurantId = $restaurantId; // Тогоочийн рестораны ID-г тохируулна
        $this->refreshOrders();
    }

    public function refreshOrders()
    {
        // Захиалгуудыг ресторанаар нь шүүж ачаална
        $this->orderItems = OrderItem::whereHas('product.category.restaurant', function ($query) {
            $query->where('id', $this->restaurantId);
        })
            ->where('food_status', '<', 2) // Food status: 0 (шинэ), 1 (бэлэн болсон)
            ->with(['table', 'product.category.restaurant'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function markAsPrepared($itemId)
    {
        $orderItem = OrderItem::find($itemId);
        if ($orderItem && $this->isOrderBelongsToRestaurant($orderItem)) {
            $orderItem->food_status = 1; // 1 = Бэлэн болсон
            $orderItem->save();
            $this->refreshOrders();
        }
    }

    public function markAsDone($itemId)
    {
        $orderItem = OrderItem::find($itemId);
        if ($orderItem && $this->isOrderBelongsToRestaurant($orderItem)) {
            $orderItem->food_status = 2; // 2 = Дууссан
            $orderItem->save();
            $this->refreshOrders();
        }
    }

    // Тухайн захиалга тогоочийн рестораны захиалга эсэхийг шалгах
    public function isOrderBelongsToRestaurant($orderItem)
    {
        return $orderItem->product->category->restaurant_id == $this->restaurantId;
    }

    public function render()
    {
        return view('livewire.chef-dashboard');
    }
}
