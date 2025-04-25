<?php

namespace App\Http\Controllers;

use App\Models\MedicalFile;
use Illuminate\Support\Facades\Storage;

class MedicalFileController extends Controller
{
    /**
     * Remove the specified file from storage.
     */
    public function destroy($id)
    {
        $file = MedicalFile::findOrFail($id);

        // حذف فایل از سیستم فایل
        Storage::disk('public')->delete($file->file_path);

        // حذف رکورد از دیتابیس
        $file->delete();

        return response()->json(['message' => 'فایل با موفقیت حذف شد.'], 200);
    }
}
