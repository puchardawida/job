<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class Event extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = User::find($this->user_id);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'slug' => str_replace(' ', '-', $this->name),
            'user_name' => $user->name
        ];
    }
}
