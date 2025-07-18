<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CreatedUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'name' => $this->resource->name,
            'email' => $this->resource->email,
            'address' => [
                'street' => $this->resource->address->street,
                'neighborhood' => $this->resource->address->neighborhood,
                'city' => $this->resource->address->city,
                'state' => $this->resource->address->state,
                'complement' => $this->resource->address->complement,
                'zip_code' => (string) $this->resource->address->zipCode,
            ],
        ];
    }
}
