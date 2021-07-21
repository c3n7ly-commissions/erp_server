<?php

namespace Database\Factories\Product;

use App\Models\Company\Division;
use App\Models\Product\Category;
use App\Models\Product\Product;
use App\Models\Product\SubCategory;
use App\Models\Product\Tax;
use App\Models\Product\Unit;
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
    $bulk_unit = Unit::all()->random();
    $atomic_unit = Unit::all()->except($bulk_unit->id)->random();
    return [
      "name" => $this->faker->unique->words(2, true),
      "code" => $this->faker->unique->isbn10(),
      "bulk_weight" => $bulk_weight = $this->faker->randomFloat(2, 1, 10_000),
      "conversion" => $this->faker->randomFloat(2, 1, ($bulk_weight / 2)),
      "bulk_selling_price" => $bulk_price = $this->faker->randomFloat(2, 1, 9_000_000),
      "atomic_selling_price" => $this->faker->randomFloat(2, $bulk_price, 99_000_000),
      "exp_amount_before_tax" => $this->faker->randomFloat(2, 1, 9_000_000),
      "exp_purchase_price" => $this->faker->randomFloat(2, 1, 9_000_000),
      "exp_profit_margin" => $this->faker->randomFloat(2, 1, 1_000),
      "status" =>
      $status = $this->faker->randomElement([Product::ACTIVE, Product::INACTIVE, Product::REJECTED]),
      "status_reason" => $status == Product::REJECTED ? $this->faker->paragraph() : null,
      "division_id" => Division::all()->random()->id,
      "tax_id" => Tax::all()->random()->id,
      "category_id" => Category::all()->random()->id,
      "sub_category_id" => SubCategory::all()->random()->id,
      "bulk_unit_id" => $bulk_unit->id,
      "atomic_unit_id" => $atomic_unit->id,
      "image" => $this->faker->randomElement(['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg'])
    ];
  }
}
