<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScoreResource extends JsonResource
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
            'team_name' => isset($this->team_name) ? $this->team_name : 'something went wrong',
            'game_name' => $this->game_name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'tabel_id' => $this->table_id,
            'goals' => $this->goals,
        ];
    }
}
