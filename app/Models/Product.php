<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function product_attribute() {
        return $this->hasMany(ProductAttribute::class);
    }

    public function property() {
        return $this->hasMany(Property::class);
    }
}
