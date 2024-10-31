<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HumanOrder extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'name', 'phone_number', 'email', 'allergies'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

