<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static UserFactory factory(...$parameters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin Eloquent
 */
	class User extends \Eloquent implements \Tymon\JWTAuth\Contracts\JWTSubject {}
}

namespace App\Models{
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
 */
	class Vehicle extends \Eloquent {}
}

