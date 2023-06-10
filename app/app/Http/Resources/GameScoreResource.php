<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GameScoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'active' => $this->active,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'unique_code' => $this->fooseballtable->unique_code,
            'teams' => $this->teamsWithPivot->map(function ($team) {
                return [
                    'id' => $team->id,
                    'name' => $team->name,
                    'goals' => $team->pivot->goals ?? 0,
                ];
            }),
        ];
    }
}
