<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Reclamo as ReclamoResource;

class Reproduccion extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'reclamo' => new ReclamoResource($this->reclamo),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
