<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GameUserResource extends JsonResource
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
            'game_id' => $this->game_id,
            'user_id' => $this->user_id,
            'kills' => $this->kills,
            'alive' => $this->alive,
            'when_killed' => $this->when_killed,
            'target_id' => $this->when(!is_null($this->target_id), $this->target_id),
            'target_name' => $this->when(!is_null($this->target_name), $this->target_name),
        ];
    }
}
