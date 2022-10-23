<?php

namespace App\Console\Commands;

use App\Facades\CarManager;
use App\Models\Car;
use App\Models\User;
use Illuminate\Console\Command;
use JetBrains\PhpStorm\NoReturn;

class TestCarCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:car';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     */
    #[NoReturn]
    public function handle(): void
    {
//        $result = CarManager::attachWitchUser(Car::factory()->create(['user_id' => null, 'model' => 'test car']),
//            User::factory()->create(['name' => 'new test']));
        $result = CarManager::detachFromUser(Car::first());
        dd($result);
    }
}
