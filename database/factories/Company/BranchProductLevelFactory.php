<?php

namespace Database\Factories\Company;

use App\Models\Company\Branch;
use App\Models\Company\BranchProductLevel;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class BranchProductLevelFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = BranchProductLevel::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    $branch_count = Branch::all()->count();
    $product_count = Product::all()->count();
    $branch_products = [];
    for ($i = 1; $i <= $branch_count; $i++) {
      for ($j = 1; $j <= $product_count; $j++) {
        array_push($branch_products, $i . "-" . $j);
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
