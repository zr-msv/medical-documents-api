<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicalDocumentController;

Route::apiResource('/medical-documents', MedicalDocumentController::class);
Route::delete('/medical-files/{id}', [\App\Http\Controllers\MedicalFileController::class, 'destroy']);
