<?php

namespace App\Modules\Slot\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Slot\Resources\SlotCollection;
use App\Modules\Slot\Services\Interfaces\SlotServiceInterface;

final class SlotController extends Controller
{
    public function __construct(
        private readonly SlotServiceInterface $slotService
    ) {}

    public function availability(): SlotCollection
    {
        return new SlotCollection($this->slotService->availability());
    }
}
