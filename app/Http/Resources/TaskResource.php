<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'priority' => $this->priority->only('id', 'title'),
            'status' => $this->status->only('id', 'title'),
            'tags' => $this->tags->pluck('title')
        ];
    }
}
