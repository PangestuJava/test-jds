<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
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
            'title' => $this->title,
            'news_content' => $this->news_content,
            'author' => $this->whenLoaded('author'),
            'created_at' => date_format($this->created_at, "d/m/Y"),
            'comments' => $this->whenLoaded('comments', function () {
                return collect($this->comments)->each(function ($comments) {
                    $comments->commentator;
                    return $comments;
                });
            }),
            'count_comment' => $this->whenLoaded('comments', function () {
                return count($this->comments);
            })
        ];
    }
}
