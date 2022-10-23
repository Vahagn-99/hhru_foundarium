<?php

namespace App\Http\Controllers;

use App\Facades\CarManager;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class RentCarController extends Controller
{
    /**
     * Get all available cars in this time
     * @return AnonymousResourceCollection
     */
    public function availableCars(): AnonymousResourceCollection
    {
        return CarResource::collection(Car::onlyAvailable()->get());
    }

    /**
     * Attach car to user if both are available
     * @param Car $car
     * @param User|null $user
     * @return Application|ResponseFactory|Response
     */
    public function attach(Car $car, ?User $user): Response|Application|ResponseFactory
    {
        // if $user parameter is not passed, supposing the auth user wanted to attach the given car themselves
        $user = $user ?? auth()->id();

        $message = 'Car or User is not available';
        /** @var bool $attached */
        $attached = CarManager::attachWitchUser($car, $user);
        if ($attached) {
            $message = 'Now User can use the attached car';
        }
        return response($message);
    }

    /**
     * Detach the given car from any user
     * @param Car $car
     * @return Response|Application|ResponseFactory
     */
    public function detach(Car $car): Response|Application|ResponseFactory
    {
        $message = 'Can not detach the car';
        /** @var bool $detached */
        $detached = CarManager::detachFromUser($car);
        if ($detached) {
            $message = 'Ok now this car is available';
        }
        return response($message);
    }
}
