<?php

namespace App\Modules\Slot\Resources;

use App\Modules\Slot\Models\Slot;
use Illuminate\Http\Resources\Json\JsonResource;

final class SlotResource extends JsonResource
{
    public function toArray($request): array
    {
        /**
         * @var Slot $this
         */
        return [
            'id' => $this->id,
            'capacity' => $this->capacity,
            'remaining' => $this->remaining,
        ];
    }
}
