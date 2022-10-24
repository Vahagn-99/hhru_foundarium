<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CarRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class CarController extends ApiController
{
    /**
     * @OA\Get(
     *     path="/api/cars",
     *     summary="Display a listing of the resource",
     *     operationId="index",
     *     tags={"Cars"},
     *     security={ {"sanctum": {} }},
     *     @OA\Response(
     *         response="200",
     *         description="The all cars"
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     * Display a listing of the resource.
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return CarResource::collection(Car::with('user')->get());
    }

    /**
     * @OA\Post(
     *     path="/api/cars",
     *     operationId="storeCars",
     *     tags={"Cars"},
     *     summary="Create yet another example record",
     *     security={ {"sanctum": {} }},
     *     @OA\Response(
     *         response="201",
     *         description="New car created",
     *         @OA\JsonContent(ref="#/components/schemas/CarRequest")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CarRequest")
     *     ),
     * )
     * Store a newly created resource in storage.
     *
     * @param CarRequest $request
     *
     * @return CarResource
     */
    public function store(CarRequest $request): CarResource
    {
        return new CarResource(Car::create($request->validated()));
    }

    /**
     * @OA\Get(
     *     path="/api/cars/{car}",
     *     operationId="Get car by id",
     *     tags={"Cars"},
     *     summary="Display the specified resource",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *         name="car",
     *         in="path",
     *         description="The ID of car",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(
     *             type="json",
     *             @OA\Items(ref="#/components/schemas/CarRequest")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Invalid tag value",
     *     ),
     * )
     * Display the specified resource.
     *
     * @param Car $car
     * @return CarResource
     */
    public function show(Car $car): CarResource
    {
        return new CarResource($car);
    }

    /**
     * @OA\Put(
     *     path="/api/cars/{car}",
     *     operationId="carUpdate",
     *     tags={"Cars"},
     *     summary="Update car by ID",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *         name="car",
     *         in="path",
     *         description="The ID of car",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Schema(
     *             type="json",
     *             @OA\Items(ref="#/components/schemas/CarRequest")
     *         ),
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CarRequest")
     *     ),
     * )
     * Update the specified resource in storage.
     *
     * @param CarRequest $request
     * @param Car $car
     * @return CarResource
     */
    public function update(CarRequest $request, Car $car): CarResource
    {
        $car->update($request->validated());
        return new CarResource($car);
    }

    /**
     * @OA\Delete(
     *     path="/api/cars/{car}",
     *     operationId="CarDelete",
     *     tags={"Cars"},
     *     summary="Delete car by ID",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *         name="car",
     *         in="path",
     *         description="The ID of car",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="204",
     *         description="Deleted",
     *     ),
     * )
     * Remove the specified resource from storage.
     *
     * @param Car $car
     * @return Response
     */
    public function destroy(Car $car): Response
    {
        $car->delete();
        return \response()->noContent();
    }
}
