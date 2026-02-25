<?php

namespace App\Modules\Slot\Providers;

use App\Modules\Slot\Services\Interfaces\SlotServiceInterface;
use App\Modules\Slot\Services\SlotService;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

final class SlotServiceProvider extends ServiceProvider
{
    public $bindings = [
        SlotServiceInterface::class => SlotService::class,
    ];

    public function boot(): void
    {
        $this->mapApiRoutes();
    }

    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    protected function mapApiRoutes(): void
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ . '/../routes/api.php');
    }
}
