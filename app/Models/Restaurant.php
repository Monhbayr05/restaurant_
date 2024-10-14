<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function tables(){
        return $this->hasMany(Table::class);
    }
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
