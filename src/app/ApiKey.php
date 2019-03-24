<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ApiKey
 *
 * @property int $id
 * @property string $key
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiKey newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiKey newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiKey query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiKey whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiKey whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiKey whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiKey whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ApiKey whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ApiKey extends Model
{
    //
}
