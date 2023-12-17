<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
            'deleted_at' => $this->when(isset($this->deleted_at), $this->deleted_at),
        ];
    }
}
