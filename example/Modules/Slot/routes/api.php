<?php

use App\Modules\Slot\Controllers\SlotController;
use Illuminate\Support\Facades\Route;

$namePrefix = 'slots';

Route::prefix($namePrefix)->group(function () use ($namePrefix) {
    Route::get('availability', [SlotController::class, 'availability'])->name($namePrefix . '.availability');
});
