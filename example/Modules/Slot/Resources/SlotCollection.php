<?php

namespace App\Modules\Slot\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

final class SlotCollection extends ResourceCollection
{
    public $collects = SlotResource::class;
}
