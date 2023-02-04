<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'survey_id' => $this->survey_id,
            'position' => $this->position,
            'title' => $this->title,
            'type_id' => $this->type_id,
            'created' => $this->created_at->format('Y-m-d'),
            'updated' => $this->updated_at->format('Y-m-d'),
        ];
    }
}
