<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_id',
        'price',
        'name',
        'phone_number',
        'email',
        'allergies'
    ];


    public function humanOrder()
    {
        return $this->hasOne(HumanOrder::class);
    }
}

