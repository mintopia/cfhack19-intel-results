<?php

namespace App\Http\Resources\Api\Version1;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'version' => 1,
            'timestamp' => Carbon::now()->toIso8601String(),
        ];
    }
}
