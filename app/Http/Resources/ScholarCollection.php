<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ScholarCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($scholar)
            {
                return [
                    'id' => $scholar->id,
                    'name' => $scholar->name,
                    'email' => $scholar->email,
                    'phone' => $scholar->phone,
                    'address' => $scholar->address,
                    'total_Slp' => $scholar->total_Slp,
                    'image' => $scholar->image,
                ];
            })
        ];
    }
}
