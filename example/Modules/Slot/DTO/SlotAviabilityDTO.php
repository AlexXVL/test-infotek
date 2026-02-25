<?php

namespace App\Modules\Slot\DTO;

use App\Modules\Slot\Models\Slot;

readonly final class SlotAviabilityDTO
{
    public function __construct(
        public int $id,
        public int $capacity,
        public int $remaining,
    ) {}

    public static function fromModel(Slot $model): self
    {
        return new self(
            $model->id,
            $model->capacity,
            $model->remaining,
        );
    }
}
