<?php

namespace Fligno\Auth\Database\Factories;

use Fligno\Auth\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Organization::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->email,
            'company' => $this->faker->company,
            'contact' => $this->faker->phonenumber,
            'address' => $this->faker->address,
        ];
    }
}
