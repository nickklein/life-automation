<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SourcesResources extends JsonResource
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
            'source_id' => $this->source_id,
            'source_name' => $this->source_name,
            'active' => ($this->active) ? $this->active : false
        ];
    }
}
