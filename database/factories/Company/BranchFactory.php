<?php

namespace Database\Factories\Company;

use App\Models\Company\Branch;
use App\Models\Company\Division;
use Illuminate\Database\Eloquent\Factories\Factory;

class BranchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Branch::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->unique->word(),
            "email" => $this->faker->email(),
            "telephone" => $this->faker->e164PhoneNumber(),
            "postal_address" => $this->faker->postcode(),
            "physical_address" => $this->faker->streetAddress(),
            "division_id" => Division::all()->random()->id
        ];
    }
}
