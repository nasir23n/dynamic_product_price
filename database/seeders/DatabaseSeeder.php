<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Attribute;
use App\Models\Product;
use App\Models\ProductStock;
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
        Attribute::create([
            'name' => 'Size',
            'values' => ['md', 'lg', 'xl']
        ]);
        Attribute::create([
            'name' => 'Color',
            'values' => ['red', 'green', 'blue']
        ]);
        Attribute::create([
            'name' => 'Ram',
            'values' => ['4GB', '8GB', '16GB']
        ]);

        Product::factory(10)->create();

        $products = Product::all();
        foreach ($products as $key => $product) {
            if ($product->varient) {
                $attrs = Attribute::all();
                $opt = [];
                foreach ($attrs as $value) {
                    $opt[$value->name] = $value->values;
                }
                $product->update([
                    'attributes' => $attrs->pluck('id'),
                    'options' => $opt,
                ]);
                foreach($opt as $key => $value) {
                    $opt_txt = $key;
                    foreach($value as $val) {
                        ProductStock::create([
                            'product_id' => $product->id,
                            'variant' => $opt_txt.'-'.$val,
                            'sku' => $opt_txt.'-'.$val,
                            'price' => rand(100, 500),
                            'quantity' => 10,
                        ]);
                    }
                }
            }
        }
    }
}

