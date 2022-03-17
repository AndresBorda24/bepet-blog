<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use phpDocumentor\Reflection\Types\This;

class CommentResource extends JsonResource
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
            'type' => 'Comments',
            'id'   => $this->id,
            'attributes' => [
                'body' => $this->body,
                'commented_on' => $this->created_at->format('d-M-y')
            ],
            'relationships' => [
                'author' => [
                    'links' => [
                        "self" => route('api.v1.users.show', $this->user_id),
                    ]
                ],
                'replies' => [
                    'links' => []
                ]
            ]
        ];
    }
}
