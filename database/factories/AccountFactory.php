<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Account::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'acount_num' => $this->faker->numerify('##########'),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'balance' => $this->faker->randomFloat
        ];
    }
}
