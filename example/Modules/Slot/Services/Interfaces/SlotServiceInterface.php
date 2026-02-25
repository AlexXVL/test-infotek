<?php

namespace App\Modules\Slot\Services\Interfaces;

use App\Modules\Slot\Models\Slot;
use Illuminate\Support\Collection;

interface SlotServiceInterface
{
    /**
     * @return Slot[]|Collection
     */
    public function availability(): array|Collection;
}
