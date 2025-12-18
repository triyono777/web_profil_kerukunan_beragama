<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(20);

        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactMessage $message)
    {
        if ($message->status === 'new') {
            $message->update(['status' => 'read']);
        }

        return view('admin.messages.show', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactMessage $message)
    {
        $data = $request->validate([
            'status' => ['required', 'in:new,read,archived'],
        ]);

        $message->update($data);

        return redirect()->route('admin.messages.index')->with('status', 'Status pesan diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')->with('status', 'Pesan dihapus.');
    }
}
