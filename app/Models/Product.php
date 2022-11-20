<?php

namespace App\Models;

use App\Models\Attribute as ModelsAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // attributes

    protected function attributes(): Attribute {
        return Attribute::make(
            get: function($value) {
                $attrs = ModelsAttribute::whereIn('id', json_decode($value))->get();
                return $attrs->pluck('name');
            }
        );
    }

    protected $casts = [
        // 'attributes' => 'array',
        'options' => 'array',
    ];

    public function stock() {
        return $this->hasMany(ProductStock::class);
    }
}
