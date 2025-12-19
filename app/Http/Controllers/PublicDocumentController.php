<?php

namespace App\Http\Controllers;

use App\Models\Document;

class PublicDocumentController extends Controller
{
    public function index()
    {
        $documents = Document::where('is_active', true)
            ->latest('published_at')
            ->paginate(12);

        return view('public.documents', compact('documents'));
    }
}
