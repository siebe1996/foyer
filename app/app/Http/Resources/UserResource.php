<?php

namespace App\Http\Resources;

use App\Models\Game_User;
use App\Models\Team;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'total_wins' => $this->total_wins,
            'games_played' => $this->games_played,
            'roles' => new RoleCollection($this->whenLoaded('roles')),
            'teams' => [
                'as_player1' => new TeamCollection($this->whenLoaded('teamsAsPlayer1')),
                'as_player2' => new TeamCollection($this->whenLoaded('teamsAsPlayer2')),
            ],
            /*'game_user' => new GameUserResource($this->whenPivotLoaded('game_user', function () {
                return $this->pivot;
            }))*/
            //'game_user' => $this->relationLoaded('players') ? new GameUserResource($this->pivot) : null,
        ];
    }
}
