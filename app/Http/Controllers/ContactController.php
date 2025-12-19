<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactMessageRequest;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function index()
    {
        return view('public.contact');
    }

    public function store(ContactMessageRequest $request)
    {
        ContactMessage::create($request->validated());

        return redirect()->route('contact.index')->with('status', 'Pesan terkirim. Terima kasih sudah berbagi aspirasi.');
    }
}
