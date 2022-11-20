<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function randomImage() {
        $img = [
            "https://gadgetnphone.com/website/Images/soundcore-mini-3-pro.png",
            "https://gadgetnphone.com/website/Images/Anker-Soundcore-Life-Note-3i.png",
            "https://gadgetnphone.com/website/Images/Nokia-Power-Bank-P6203-1.png",
            "https://gadgetnphone.com/website/Images/a1.png",
            "https://gadgetnphone.com/website/Images/photosize.png",
            "https://gadgetnphone.com/website/Images/Anker/Anker%20r500.jpg",
            "https://gadgetnphone.com/website/Images/Edifier/w200bt%20se.png",
            "https://gadgetnphone.com/website/Images/Mibro/22mm%20watch%20strap.png",
            "https://gadgetnphone.com/website/Images/Mibro/a1.png",
            "https://gadgetnphone.com/website/Images/Nokia/e1200.png",
            "https://gadgetnphone.com/website/Images/Nokia/Nokia%20Power%20Bank%20P6203-1.png",
            "https://gadgetnphone.com/website/Images/Nokia/Nokia%20Pro%20Cable%20P8200A.png",
            "https://gadgetnphone.com/website/Images/Anker/soundcore%20mini%203%20pro.png",
            "https://gadgetnphone.com/website/Images/Anker/soundcore%20mini%203%20pro.png",
            "https://gadgetnphone.com/website/Images/Nokia/Nokia%20Pro%20Cable%20P8200A.png",
            "https://gadgetnphone.com/website/Images/Nokia/Nokia%20Power%20Bank%20P6203-1.png",
            "https://gadgetnphone.com/website/Images/Nokia/e1200.png",
            "https://gadgetnphone.com/website/Images/Mibro/a1.png",
            "https://gadgetnphone.com/website/Images/Mibro/22mm%20watch%20strap.png",
            "https://gadgetnphone.com/website/Images/Edifier/w200bt%20se.png",
            "https://gadgetnphone.com/website/Images/Anker/Anker%20r500.jpg",
        ];
        return $img[array_rand($img)];
    }
    public function definition()
    {
        $bol = rand(0, 1);
        return [
            'name' => fake()->name,
            'short_description' => fake()->text(200),
            'description' => fake()->text(500),
            'price' => $bol ? null :rand(100, 200),
            'varient' => $bol,
            'image' => $this->randomImage(),
            // 'attributes' => '',
            // 'options' => '',
        ];
    }
}
