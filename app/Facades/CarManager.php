<?php

namespace App\Facades;

use App\Models\Car;
use App\Models\User;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Repositories\CarRepositoryInterface attachWitchUser(Car $car, User $user): bool
 * @method static \App\Repositories\CarRepositoryInterface detachFromUser(Car $car): bool
 * @const  array<string \App\Repositories\CarRepositoryInterface DETACH
 */
class CarManager extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'car';
    }
}
