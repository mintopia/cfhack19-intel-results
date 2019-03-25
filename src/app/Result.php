<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;
use Storage;

/**
 * App\Result
 *
 * @property int $id
 * @property string $uuid
 * @property string $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Result newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Result newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Result query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Result whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Result whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Result whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Result whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Result whereUuid($value)
 * @mixin \Eloquent
 */
class Result extends Model
{
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public $casts = [
        'data' => 'object'
    ];

    public function getEmotion()
    {
        if (property_exists($this->data, 'emotion')) {
            return $this->data->emotion;
        }
        return null;
    }

    public function process()
    {
        $this->responseToOisp();
    }

    public function saveImageToStorage()
    {

    }

    protected function respondToOisp()
    {
        Log::notice('Would send response to OISP');
    }
}
