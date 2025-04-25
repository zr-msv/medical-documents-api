<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalDocument extends Model
{
    protected $fillable = [
        'title',
        'description',
        'record_date',
    ];

    public function medicalFiles()
    {
        return $this->hasMany(MedicalFile::class);
    }
}
