<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PostResouce extends JsonResource
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
            'title'         => $this->title,
            'slug'          => $this->slug,
            'body'          => $this->body,
            'extract'       => $this->extract,
            'status'        => $this->status,
            'cover'         => url(Storage::url($this->cover->link)),
            'comments_count'=> $this->when($this->comments_count !== null, $this->comments_count),
            'comments'      => CommentResource::collection($this->whenLoaded('comments')),             
            'category'      => new GeneralResource($this->whenLoaded('category')),
            'tags'          => GeneralResource::collection($this->whenLoaded('tags')),
            'author'        => new UserResource($this->whenLoaded('author')),
            'posted_at'     => date("d-M-Y", strtotime($this->posted_at)),
            'created_at'    => $this->created_at->format('d-M-Y'),

            'links'         => [
                'self'  => route('api.v1.post.show', $this->id),

                // 'edit'  => $this->when(request()->is('api/v1/user/*'), 'editar'),
                // 'remove' => $this->when(request()->routeIs('api.v1.user.posts'), 'eliminar')
                ]
            ];
    }
}
