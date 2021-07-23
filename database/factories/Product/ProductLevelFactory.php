<?php

namespace Database\Factories\Product;

use App\Models\Company\Branch;
use App\Models\Product\Product;
use App\Models\Product\ProductLevel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductLevelFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = ProductLevel::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    $valid_products = Product::where("status", Product::ACTIVE)
      ->select("id")
      ->get()
      ->pluck("id")
      ->toArray();

    $branch_count = Branch::all()->count();
    $branch_products = [];
    for ($i = 1; $i <= $branch_count; $i++) {
      foreach ($valid_products as $valid_product) {
        array_push($branch_products, $i . "-" . $valid_product);
      }
    }

    $branch_and_product = $this->faker->unique->randomElement($branch_products);
    $branch_and_product = explode('-', $branch_and_product);
    $branch_id = $branch_and_product[0];
    $product_id = $branch_and_product[1];
    return [
      "minimum_level" => $min_level = $this->faker->randomFloat(2, 1, 10_000),
      "maximum_level" =>  $this->faker->randomFloat(2, $min_level, ($min_level * 4)),
      "reorder_level" =>  $this->faker->randomFloat(2, $min_level, ($min_level * 2)),
      "quantity" =>  $this->faker->randomFloat(2, 1, ($min_level * 4)),
      "branch_id" =>  $branch_id,
      "product_id" => $product_id
    ];
  }
}
