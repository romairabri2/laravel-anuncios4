<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Str as Str;
use Illuminate\Support\Arr as Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $productSuffixes = ['Sweater', 'Pants', 'Shirt', 'Glasses', 'Hat', 'Socks'];
        $name = $this->faker->company().' '.Arr::random($productSuffixes);

        return
         [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->realText(320),
            'price' => $this->faker->numberBetween(10000, 100000)
        ];
    }
}
