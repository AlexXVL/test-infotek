<?php

namespace App\Modules\Slot\Services;

use App\Modules\Slot\DTO\SlotAviabilityDTO;
use App\Modules\Slot\Models\Slot;
use App\Modules\Slot\Services\Interfaces\SlotServiceInterface;
use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

final class SlotService implements SlotServiceInterface
{
    /**
     * @throws LockTimeoutException
     */
    public function availability(): array|Collection
    {
        $cacheKey = 'slots:availability';
        $lockKey  = 'lock:slots:availability';

        return Cache::lock($lockKey, 10)->block(3, function () use ($cacheKey) {
            return Cache::remember($cacheKey, 150, function () {
                $collect = collect();

                $slots = Slot::query()
                    ->get();

                foreach ($slots as $slot) {
                    $collect->push(SlotAviabilityDTO::fromModel($slot));
                }

                return $collect;
            });
        });


    }
}
