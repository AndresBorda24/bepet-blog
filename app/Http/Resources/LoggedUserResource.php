<?php

namespace App\Http\Resources;

use App\Models\Avatar;
use App\Models\Role;
use Illuminate\Http\Resources\Json\JsonResource;

class LoggedUserResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name, 
            'email' => $this->email,
            'role' => new GeneralResource(Role::where('id', $this->role_id)->get(['id', 'role'])),
            'avatar' => Avatar::where('id', $this->avatar_id)->pluck('link')
        ];
    }
}
