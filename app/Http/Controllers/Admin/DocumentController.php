<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DocumentRequest;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Document::latest()->paginate(15);

        return view('admin.documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.documents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DocumentRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('documents', 'public');
        }

        Document::create($data);

        return redirect()->route('admin.documents.index')->with('status', 'Dokumen disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        return view('admin.documents.show', compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        return view('admin.documents.edit', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DocumentRequest $request, Document $document)
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            if ($document->file_path) {
                Storage::disk('public')->delete($document->file_path);
            }

            $data['file_path'] = $request->file('file')->store('documents', 'public');
        }

        $document->update($data);

        return redirect()->route('admin.documents.index')->with('status', 'Dokumen diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        if ($document->file_path) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return redirect()->route('admin.documents.index')->with('status', 'Dokumen dihapus.');
    }
}
