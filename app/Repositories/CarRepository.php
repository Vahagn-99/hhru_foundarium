<?php

namespace App\Repositories;

use App\Models\Car;
use App\Models\User;

class CarRepository implements CarRepositoryInterface
{
    /**
     * add car to user, only if user and car are available
     * @param Car $car
     * @param User $user
     *
     * @return bool
     */
    private function attachIfAvailable(Car $car, User $user): bool
    {
        if ($user->available && $car->available) {
            return $car->update(['user_id' => $user->id]);
        }
        return false;
    }

    /**
     * add car to user
     * @implements <CarRepositoryInterface>
     * @param Car $car
     * @param User $user
     *
     * @return bool
     */
    public function attachWitchUser(Car $car, User $user): bool
    {

        return $this->attachIfAvailable($car, $user);
    }

    /**
     * remove car from user
     * @implements <CarRepositoryInterface>
     * @param Car $car
     *
     * @return bool
     */
    public function detachFromUser(Car $car): bool
    {
        return $car->update(self::DETACH);
    }
}
