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
            'title' => $this->title,
            'active' => $this->active,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'weapon_id'=> $this->relationLoaded('weapon') ? new WeaponResource($this->weapon) : $this->weapon_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'players' => new UserCollection($this->whenLoaded('usersWithPivot')),
            'game_user' => new GameUserResource($this->whenPivotLoaded('game_user', function () {
                return $this->pivot;
            })),
            'has_user' => $this->has_user,
        ];
    }
}
