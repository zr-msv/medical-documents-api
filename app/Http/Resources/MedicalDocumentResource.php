<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MedicalDocumentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'record_date' => $this->record_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'files' => MedicalFileResource::collection($this->files),
        ];
    }
}
