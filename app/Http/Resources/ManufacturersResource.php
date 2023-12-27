<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ManufacturersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'cars' => $this->when( $request->has( 'with_cars' ), CarsResource::collection( $this->cars ) ),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}