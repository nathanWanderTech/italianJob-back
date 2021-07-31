<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Vehicle
 *
 * @property int $id
 * @property string $name
 * @property string $brand
 * @property int $total_traveled_distance
 * @property int $daily_traveled_distance
 * @property string $last_petrol_refill
 * @property string $last_oil_change
 * @property string $last_maintenance
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Vehicle newModelQuery()
 * @method static Builder|Vehicle newQuery()
 * @method static Builder|Vehicle query()
 * @method static Builder|Vehicle whereBrand($value)
 * @method static Builder|Vehicle whereCreatedAt($value)
 * @method static Builder|Vehicle whereDailyTraveledDistance($value)
 * @method static Builder|Vehicle whereId($value)
 * @method static Builder|Vehicle whereLastMaintenance($value)
 * @method static Builder|Vehicle whereLastOilChange($value)
 * @method static Builder|Vehicle whereLastPetrolRefill($value)
 * @method static Builder|Vehicle whereName($value)
 * @method static Builder|Vehicle whereTotalTraveledDistance($value)
 * @method static Builder|Vehicle whereUpdatedAt($value)
 * @mixin Eloquent
 * @property int $owner_id
 * @property-read User $user
 * @method static Builder|Vehicle whereOwnerId($value)
 */
class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'total_traveled_distance',
        'daily_traveled_distance',
        'owner_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reminders(): HasMany
    {
        return $this->hasMany(Reminder::class);
    }
}
