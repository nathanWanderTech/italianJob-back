<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Reminder
 *
 * @property int $id
 * @property string $name
 * @property string|null $last_remind
 * @property string|null $next_remind
 * @property int $interval
 * @property int $vehicle_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Vehicle $vehicle
 * @method static \Database\Factories\ReminderFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereLastRemind($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereNextRemind($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereVehicleId($value)
 * @mixin \Eloquent
 */
class Reminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_remind',
        'next_remind',
        'interval',
        'vehicle_id',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
