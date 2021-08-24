<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'uid' => $this->uid,
            'email_verified_at' => $this->email_verified_at,
            'email' => $this->email,
            'name' => $this->name,
            'joined_at' => $this->created_at,
        ];
    }
}
