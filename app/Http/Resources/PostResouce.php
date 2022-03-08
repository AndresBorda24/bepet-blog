<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

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
        // return parent::toArray($request);
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
            'extract' => $this->extract,
            'status' => $this->status,
            'category' => new GeneralResource($this->category),
            'tags' => GeneralResource::collection($this->tags),
            'posted_at' => date("d-M-Y", strtotime($this->posted_at)),
            'created_at' => $this->created_at->format('d-M-Y'),
        ];
    }
}
