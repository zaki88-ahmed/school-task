<?php

namespace modules\Students\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        return parent::toArray($request);

        return [
            'name' => $this->name,
            'status' => $this->status,
            'order' => $this->order,
            'school_name' => $this->when($this->schools()->exists(), $this->schools->name),
        ];
    }
}
