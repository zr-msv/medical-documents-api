<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalFile extends Model
{
    protected $fillable = ['medical_document_id', 'file_path', 'original_name'];

    public function medicalDocument()
    {
        return $this->belongsTo(MedicalDocument::class);
    }
}
