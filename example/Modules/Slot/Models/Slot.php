<?php

namespace App\Modules\Slot\Models;

use App\Modules\Hold\Models\Hold;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $capacity
 * @property int $remaining
 *
 * @property-read Hold[] $holds
 */
final class Slot extends Model
{
    public $timestamps = false;

    /**
     * @var list<string>
     */
    protected $guarded = [
        'id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'capacity' => 'integer',
            'remaining' => 'integer',
        ];
    }

    public function holds(): HasMany
    {
        return $this->hasMany(Hold::class);
    }
}
