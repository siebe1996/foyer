<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GameinfoResource extends JsonResource
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
            'team_id' => $this->relationLoaded('team') ? new TeamResource($this->team) : $this->team_id,
            'game_id' => $this->relationLoaded('game') ? new GameResource($this->game) : $this->game_id,
            'goals' => $this->goals,
        ];
    }
}
