<?php

namespace Database\Factories\Product;

use App\Models\Product\Tax;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaxFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Tax::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      "name" => $this->faker->word(),
      "value" => $this->faker->randomFloat(2, 0.1, 50)
    ];
  }
}
