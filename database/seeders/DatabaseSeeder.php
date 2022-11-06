<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Product::create(['name' => 'Product One']);
        Attribute::create(['name' => 'size']);
        Attribute::create(['name' => 'color']);

        AttributeValue::create([
            'attribute_id' => 1,
            'value' => 'XL'
        ]);
        AttributeValue::create([
            'attribute_id' => 1,
            'value' => 'M'
        ]);
        AttributeValue::create([
            'attribute_id' => 2,
            'value' => 'red'
        ]);
        AttributeValue::create([
            'attribute_id' => 2,
            'value' => 'Green'
        ]);

        ProductAttribute::create([
            'product_id' => 1,
            'attribute_id' => 1,
            'attribute_value_id' => 1,
            'price' => 20,
        ]);
        ProductAttribute::create([
            'product_id' => 1,
            'attribute_id' => 2,
            'attribute_value_id' => 4,
            'price' => 22,
        ]);





        Property::create([
            'product_id' => 1,
            'size' => 'M',
            'color' => ['red', 'green'],
            'price' => 20,
        ]);
        Property::create([
            'product_id' => 1,
            'size' => 'L',
            'color' => ['red', 'blue'],
            'price' => 25,
        ]);







        
    }
}
