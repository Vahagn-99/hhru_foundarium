<?php

namespace Tests\Feature;

use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarActionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->car = Car::factory()->create();
    }

    public function test_get_all_cars(): void
    {
        $this->authUser();

        $response = $this->get(\route('cars.index'));

        $response->assertStatus(200);
    }

    public function test_create_new_car(): void
    {

        $this->authUser();

        $response = $this->post(\route('cars.store', [
            'model' => $this->car->model,
            'class' => $this->car->class,
        ]));

        $response->assertStatus(201);
    }

    public function test_create_new_car_with_user_id(): void
    {
        $user = $this->authUser();

        $response = $this->post(\route('cars.store', [
            'model' => $this->car->model,
            'class' => $this->car->class,
            'user_id' => $user->id,
        ]));

        $response->assertStatus(201);
    }

    public function test_show_car_getting_by_id(): void
    {
        $this->authUser();

        $response = $this->get(\route('cars.show', [
            'car' => $this->car->id,
        ]));

        $response->assertStatus(200);
    }

    public function test_update_car_getting_by_id(): void
    {
        $this->authUser();

        $response = $this->put(\route('cars.update', [
            'car' => $this->car->id,
            'class' => 'some new class',
        ]));

        $response->assertStatus(200);
    }

    public function test_remove_car_getting_by_id(): void
    {
        $this->authUser();

        $response = $this->delete(\route('cars.destroy', [
            'car' => $this->car->id,
        ]));

        $response->assertStatus(204);
    }
}
