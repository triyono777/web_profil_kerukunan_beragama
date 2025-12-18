<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProgramRequest;
use App\Models\Program;
use Illuminate\Support\Str;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::latest()->paginate(15);

        return view('admin.programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.programs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProgramRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug']);

        Program::create($data);

        return redirect()->route('admin.programs.index')->with('status', 'Program disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        return view('admin.programs.show', compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProgramRequest $request, Program $program)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug']);

        $program->update($data);

        return redirect()->route('admin.programs.index')->with('status', 'Program diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('admin.programs.index')->with('status', 'Program dihapus.');
    }
}
