<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Car>
 */
class CarFactory extends Factory
{
    /** @var array custom cars constants */
    public const  CARS = [
        'Opel' => 'astra c',
        'Ford' => 'focus',
        'Shevrolet' => 'cruze',
        'BMV' => 'm 3',
        'Mercedes' => 'c es',
        'KIA' => 'else',
        'Nissan' => 'tiidda',
        'Honda' => 'Elision',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    public function definition(): array
    {

        $class = array_rand(self::CARS);
        $model = self::CARS[$class];

        return [
            'user_id' => User::factory()->create()->id,
            'model' => $model,
            'class' => $class,
        ];
    }
}
