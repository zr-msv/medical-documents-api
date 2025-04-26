<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MedicalDocument;
use App\Models\MedicalFile;

class MedicalDocumentSeeder extends Seeder
{
    public function run()
    {
        $documents = [
            [
                'title' => 'گزارش پزشکی اول',
                'description' => 'توضیحات مربوط به گزارش پزشکی اول',
                'record_date' => now()->subDays(10)->toDateString(),
            ],
            [
                'title' => 'گزارش پزشکی دوم',
                'description' => 'توضیحات مربوط به گزارش پزشکی دوم',
                'record_date' => now()->subDays(5)->toDateString(),
            ],
            [
                'title' => 'گزارش پزشکی سوم',
                'description' => 'توضیحات مربوط به گزارش پزشکی سوم',
                'record_date' => now()->toDateString(),
            ],
        ];

        foreach ($documents as $docData) {
            $document = MedicalDocument::create($docData);

            MedicalFile::create([
                'medical_document_id' => $document->id,
                'file_path' => 'uploads/medical_files/sample_file_' . $document->id . '.png',
                'original_name' => 'نمونه فایل ' . $document->id . '.png',
            ]);
        }
    }
}
