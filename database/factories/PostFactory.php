<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'=>$this->faker->randomElement(User::all()),
            'title'=>$this->faker->word(),
            'content'=>$this->faker->text()
        ];
    }
}
