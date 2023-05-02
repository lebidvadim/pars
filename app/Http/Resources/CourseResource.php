<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'send_currency'      => $this->send_currency,
            'receive_currency'   => $this->receive_currency,
            'send_rate'          => $this->send_rate,
            'receive_rate'       => $this->receive_rate,
        ];
    }
}
