<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function value() {
        return $this->belongsTo(AttributeValue::class);
    }

    public function attribute() {
        return $this->belongsTo(Attribute::class);
    }
    public function attribute_value() {
        return $this->belongsTo(AttributeValue::class);
    }
}
