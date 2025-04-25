<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MedicalFileResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'original_name' => $this->original_name,
            'file_path' => asset('storage/' . $this->file_path),
        ];
    }
}
