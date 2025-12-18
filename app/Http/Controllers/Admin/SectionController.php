<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SectionRequest;
use App\Models\Section;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageKey = request('page', 'home');
        $sections = Section::where('page_key', $pageKey)
            ->orderBy('sort_order')
            ->get();

        return view('admin.sections.index', compact('sections', 'pageKey'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageKey = request('page', 'home');

        return view('admin.sections.create', compact('pageKey'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionRequest $request)
    {
        $data = $this->prepareData($request->validated());
        Section::create($data);

        return redirect()->route('admin.sections.index', ['page' => $request->get('page_key')])->with('status', 'Blok konten ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        return view('admin.sections.show', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        return view('admin.sections.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectionRequest $request, Section $section)
    {
        $data = $this->prepareData($request->validated());
        $section->update($data);

        return redirect()->route('admin.sections.index', ['page' => $section->page_key])->with('status', 'Blok konten diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        $pageKey = $section->page_key;
        $section->delete();

        return redirect()->route('admin.sections.index', ['page' => $pageKey])->with('status', 'Blok konten dihapus.');
    }

    private function prepareData(array $data): array
    {
        if (isset($data['json_data'])) {
            $decoded = is_string($data['json_data']) ? json_decode($data['json_data'], true) : $data['json_data'];
            $data['json_data'] = $decoded ?: null;
        }

        return $data;
    }
}
