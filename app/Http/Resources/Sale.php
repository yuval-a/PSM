<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Sale extends JsonResource
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
            'sale_time' => $this->sale_time,
            'sale_number' => $this->sale_number,
            'description' => $this->description,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'payment_link' => $this->payment_link
        ];
    }
}
