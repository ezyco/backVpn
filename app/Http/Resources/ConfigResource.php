<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConfigResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'country'     => $this->country,
            'location'    => $this->location,
            'active'      => $this->active,
            'special'     => $this->special,
            'type'        => $this->type,
            'configFile'  => asset($this->configFile),
            'countryFlag' => asset($this->countryFlag),
        ];
    }
}
