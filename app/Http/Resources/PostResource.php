<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PostResource extends JsonResource
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
            "type"        => "articles",
            'id'          => $this->id,      
            "attributes"  => [
                'title'         => $this->title,
                // 'slug'          => $this->slug,
                'body'          => $this->body,
                'extract'       => $this->extract,
                'status'        => $this->status,
                'posted_at'     => date("d-M-Y", strtotime($this->posted_at)),
                'created_at'    => $this->created_at->format('d-M-Y'),
            ],
            "relationships" => [
                "comments"  => [
                    "links" => [
                        "self" => "ruta Comentarios",
                    ],
                ],

                "author"  => [
                    "links" => [
                        "self" => "ruta Autor",
                    ],
                ],
            ],
            "links"       => [
                "self" => route('api.v1.post.show', $this->id),
            ],
        ];
    }
}
