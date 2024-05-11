<?php

namespace Database\Factories;

use App\Models\Ussers;
use Illuminate\Database\Eloquent\Factories\Factory;

class UssersFactory extends Factory
{
    protected $model = Ussers::class;

    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'age' => $this->faker->numberBetween(18, 60),
            'nickname' => $this->faker->userName,
        ];
    }
}
