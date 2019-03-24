<?php

namespace App\Http\Resources\Api\Version1;

use Illuminate\Http\Resources\Json\JsonResource;

class ResultResource extends JsonResource
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
            'id' => $this->uuid,
            'data' => $this->data,
            'image_url' => $this->image_url,
            'created_at' => $this->created_at,
        ];
    }
}
