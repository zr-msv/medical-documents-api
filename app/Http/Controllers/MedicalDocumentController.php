<?php

namespace App\Http\Controllers;

use App\Http\Resources\MedicalDocumentResource;
use App\Models\MedicalDocument;
use App\Models\MedicalFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class MedicalDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = MedicalDocument::all();

        return (MedicalDocumentResource::collection($data))->response()->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'record_date' => 'required|date',
            'files.*' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $document = MedicalDocument::create([
            'title' => $request->title,
            'description' => $request->description,
            'record_date' => $request->record_date,
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('medical_files', 'public');
                MedicalFile::create([
                    'medical_document_id' => $document->id,
                    'file_path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                ]);
            }
        }

        return (new MedicalDocumentResource($document))->response()->setStatusCode(Response::HTTP_CREATED);
    }

        /**
     * Display the specified resource.
     */
    public function show(MedicalDocument $medicalDocument)
    {
        return (new MedicalDocumentResource($medicalDocument))->response()->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedicalDocument $medicalDocument)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'record_date' => 'required|date',
            'files.*' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $medicalDocument->update([
            'title' => $request->title,
            'description' => $request->description,
            'record_date' => $request->record_date,
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('medical_files', 'public');
                MedicalFile::create([
                    'medical_document_id' => $medicalDocument->id,
                    'file_path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                ]);
            }
        }

        return (new MedicalDocumentResource($medicalDocument))->response()->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalDocument $medicalDocument)
    {
        if($medicalDocument->medicalFiles)
        foreach ($medicalDocument->medicalFiles as $file) {
            Storage::disk('public')->delete($file->file_path);
            $file->delete();
        }

        $medicalDocument->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
