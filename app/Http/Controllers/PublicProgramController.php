<?php

namespace App\Http\Controllers;

use App\Models\Program;

class PublicProgramController extends Controller
{
    public function index()
    {
        $programs = Program::where('status', 'published')
            ->orderByDesc('is_featured')
            ->latest()
            ->paginate(9);

        return view('public.programs', compact('programs'));
    }
}
