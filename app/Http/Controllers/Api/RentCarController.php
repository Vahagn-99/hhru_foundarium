<?php

namespace App\Http\Controllers\Api;

use App\Facades\CarManager;
use App\Http\Controllers\Controller;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class RentCarController extends ApiController
{
    /**
     * @OA\Get(
     *     path="/api/available-cars",
     *     summary="Get all available cars in this time",
     *     operationId="availableCars",
     *     tags={"Rent car"},
     *     @OA\Response(
     *         response="200",
     *         description="The available cars",
     *         @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *     )
     * )
     * Get all available cars in this time
     * @return AnonymousResourceCollection
     */
    public function availableCars(): AnonymousResourceCollection
    {
        return CarResource::collection(Car::onlyAvailable()->get());
    }

    /**
     * @OA\Post(
     *     path="/api/attach/{car}/{user}",
     *     operationId="attachCar",
     *     tags={"Rent car"},
     *     summary="Attach car to user if both are available",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *     description="ID of car",
     *         in="path",
     *         name="car",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *     description="ID of user",
     *         in="path",
     *         name="user",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Car attached to user",
     *        @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *     ),
     *     @OA\Response(
     *         response="409",
     *         description="Car or User is not available",
     *     )
     * )
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
        $status = 409;
        /** @var bool $attached */
        $attached = CarManager::attachWitchUser($car, $user);
        if ($attached) {
            $message = 'Now User can use the attached car';
            $status = 200;
        }
        return response($message, $status);
    }

    /**
     * @OA\Post(
     *     path="/api/detach/{car}",
     *     operationId="detachCar",
     *     tags={"Rent car"},
     *     summary="Detach the given car from any user",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *     description="ID of car",
     *         in="path",
     *         name="car",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response="204",
     *         description="Car detached from user",
     *        @OA\JsonContent(ref="#/components/schemas/ApiResponse")
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Car whit given id is not exisit",
     *     )
     * )
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
