<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'telegram_id' => $this->faker->unique()->numberBetween(1000000, 9999999),
            'subscribed' => true,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * User unsubscribed
     */
    public function unsubscribed()
    {
        return $this->state(fn(array $attributes) => [
            'subscribed' => false,
        ]);
    }
}
