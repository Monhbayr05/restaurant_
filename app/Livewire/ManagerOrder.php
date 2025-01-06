<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ManagerOrder extends Component
{
    public $orders;

    public $restaurantId;

    public function mount()
    {
        $manager = Auth::user(); // Нэвтэрсэн менежерийг авна.
        $this->restaurantId = $manager->restaurant_id; // Менежерийн рестораны ID-г авна.
        $this->loadOrders();
    }

    public function loadOrders()
    {
        // Тухайн рестораны бүтээгдэхүүнтэй холбоотой orders хүснэгтийн өгөгдлийг шүүнэ.
        $this->orders = Order::whereHas('orderItems.product.category.restaurant', function ($query) {
            $query->where('id', $this->restaurantId);
        })
            ->with(['orderItems.product.category.restaurant']) // Холбоотой өгөгдлүүдийг ачаална.
            ->get();
    }

    public function render()
    {
        return view('livewire.manager-order', [
            'orders' => $this->orders
        ]);
    }
}



