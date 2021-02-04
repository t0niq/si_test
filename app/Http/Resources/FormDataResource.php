<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FormDataResource extends JsonResource
{
    private $priorities;
    private $statuses;

    public function __construct($priorities, $statuses)
    {
        $this->priorities = $priorities;
        $this->statuses = $statuses;
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'priorities' => $this->priorities,
            'statuses' => $this->statuses,
        ];
    }
}
