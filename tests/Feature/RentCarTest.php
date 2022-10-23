<?php

namespace Tests\Feature;

use App\Facades\CarManager;
use App\Models\Car;
use App\Models\User;
use App\Repositories\CarRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RentCarTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Car $car;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->car = Car::factory()->create(['user_id' => $this->user->id]);
    }

    public function test_user_can_rent_a_car(): void
    {
        $this->car->update(CarRepositoryInterface::DETACH);

        $status = CarManager::attachWitchUser($this->car, $this->user);

        $this->assertTrue((bool)$status);
    }

    public function test_user_can_not_rent_a_car_when_the_user_is_already_using_another(): void
    {
        $anotherCar = clone $this->car;

        $status = CarManager::attachWitchUser($anotherCar, $this->user);

        $this->assertFalse($status);
    }

    public function test_user_can_not_rent_a_car_when_car_is_already_in_use(): void
    {
        $anotherUser = clone $this->user;

        $status = CarManager::attachWitchUser($this->car, $anotherUser);

        $this->assertFalse($status);
    }

    public function test_user_can_drop_off_a_car(): void
    {
        $status = CarManager::detachFromUser($this->car);

        $this->assertTrue((bool)$status);
    }
}
