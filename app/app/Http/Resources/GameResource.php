<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use function PHPUnit\Framework\isNan;

class GameResource extends JsonResource
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
            'competition_id' => $this->relationLoaded('competition') ? new CompetitionResource($this->competition) : $this->competition_id,
            'winner_id' => $this->relationLoaded('winner') ? new TeamResource($this->winner) : $this->winner_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'teams' => new TeamCollection($this->whenLoaded('teams')),
            'gameinfo' => new GameinfoCollection($this->whenLoaded('gameinfo')),
            /*'game_user' => new GameUserResource($this->whenPivotLoaded('game_user', function () {
                return $this->pivot;
            })),
            'has_user' => $this->has_user,*/
        ];
    }
}
