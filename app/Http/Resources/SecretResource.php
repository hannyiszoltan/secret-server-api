<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SecretResource extends JsonResource
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
            'hash'           => $this->hash,
            'secretText'     => $this->secretText,
            'createdAt'      => $this->createdAt,
            'expiresAt'      => $this->expiresAt,
            'remainingViews' => $this->remainingViews,
        ];
    }
}
