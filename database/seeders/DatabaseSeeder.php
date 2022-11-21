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
            'values' => arrayGetRandom(['md', 'lg', 'xl'])
        ]);
        Attribute::create([
            'name' => 'Color',
            'values' => arrayGetRandom(['red', 'green', 'blue', 'black', 'purple'])
        ]);
        Attribute::create([
            'name' => 'Ram',
            'values' => arrayGetRandom(['4GB', '8GB', '16GB', '32GB'])
        ]);

        Product::factory(10)->create();

        $products = Product::all();

        // foreach ($products as $product) {
            // $attrs = Attribute::all();
            // $product->update([
            //     'attributes' => $attrs->pluck('id'),
            //     'options' => Attribute::pluck('values')
            // ]);

            // if ($product->varient) {
            //     $cross = arrayCross(Attribute::pluck('values'));
            //     foreach ($cross as $cr) {
            //         ProductStock::create([
            //             'product_id' => $product->id,
            //             'variant' => implode('-', $cr),
            //             'sku' => implode('-', $cr),
            //             'price' => rand(100, 500),
            //             'quantity' => 10,
            //         ]);
            //     }
            // }
        // }

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
                $cross = arrayCross($opt);
                foreach ($cross as $cr) {
                    ProductStock::create([
                        'product_id' => $product->id,
                        'variant' => implode('-', $cr),
                        'sku' => implode('-', $cr),
                        'price' => rand(100, 500),
                        'quantity' => 10,
                    ]);
                }
            }
        }
    }
}

