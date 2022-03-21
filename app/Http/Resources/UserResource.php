<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
        // return parent::toArray($request);
        return [
            'type' => 'User',
            'id'   => (string) $this->id,
            'attributes' => [
                'name' => $this->name,
                'email' => $this->email,
                'avatar' => Storage::url($this->avatar->link),
                'role' => $this->role_name,
            ],
            'links' => [
                'self' => route('api.v1.users.show', $this->id)
            ]
        ];
    }
}
