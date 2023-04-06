<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
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
            'id' => $this->name,
            //'player1' => new UserResource($this->whenLoaded('player1')),
            'player1_id'=> $this->relationLoaded('player1') ? new UserResource($this->player1) : $this->player1_id,
            //'player2' => new UserResource($this->whenLoaded('player2')),
            'player2_id'=> $this->relationLoaded('player2') ? new UserResource($this->player2) : $this->player2_id,
            'total_wins' => $this->total_wins,
            'games_played' => $this->games_played,
            'games' => new GameCollection($this->whenLoaded('games')),
            'gameinfo' => new GameinfoCollection($this->whenLoaded('gameinfo')),
        ];
    }
}
