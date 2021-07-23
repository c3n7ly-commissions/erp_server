<?php

namespace Database\Factories\Partners\Supplier;

use App\Models\Partners\Supplier\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Supplier::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      "name" => $this->faker->company(),
      "email" => $this->faker->unique->companyEmail(),
      "telephone" => $this->faker->e164PhoneNumber(),
      "postal_address" => $this->faker->postcode(),
      "physical_address" => $this->faker->streetAddress(),
      "tax_id" => $this->faker->unique->regexify('[A-Z][0-9]{9}[A-Z]'),
      "status" =>
      $status = $this->faker->randomElement([Supplier::ACTIVE, Supplier::INACTIVE, Supplier::REJECTED]),
      "status_reason" => $status == Supplier::REJECTED ? $this->faker->paragraph() : null,
      "payment_terms" => $this->faker->numberBetween(0, 300),
      "credit_limit" => $this->faker->randomFloat(2, 1, 9_000_000),
    ];
  }
}
