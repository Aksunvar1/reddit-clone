<?php

namespace App\Http\Resources\Subreddit;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubredditResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'url' => $this->resource->url,
            'logo' => $this->resource->logo,
            'title' => $this->resource->title,
            'status' => $this->resource->status,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
            'deleted_at' => $this->resource->deleted_at,
        ];
    }
}
