<?php

namespace App\Repositories;

use App\Models\Car;
use App\Models\User;

interface CarRepositoryInterface
{
    /**
     * @const  array
     * use when need to detach car from user
     */
    public const DETACH = ['user_id' => null];

    /**
     * add car to user
     * @param Car $car
     * @param User $user
     *
     * @return bool
     */
    public function attachWitchUser(Car $car, User $user): bool;

    /**
     * remove car from user
     * @param Car $car
     *
     * @return bool
     */
    public function detachFromUser(Car $car): bool;
}
