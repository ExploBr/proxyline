<?php

namespace App\Http\Resources\Page;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'template' => $this->template,
            'slug' => $this->slug,
            'publish'=>$this->publish,
            'title' => $this->title,
            'content' => $this->content,
            'lang' => $this->lang,
            'page_id' => $this->page_id,
        ];
    }
}
