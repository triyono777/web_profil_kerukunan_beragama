<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrganizationMemberRequest;
use App\Models\OrganizationMember;
use Illuminate\Support\Facades\Storage;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = OrganizationMember::orderBy('sort_order')->get();

        return view('admin.organization.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.organization.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrganizationMemberRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('organization', 'public');
        }

        OrganizationMember::create($data);

        return redirect()->route('admin.organization.index')->with('status', 'Struktur organisasi ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(OrganizationMember $organization)
    {
        return view('admin.organization.show', ['member' => $organization]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrganizationMember $organization)
    {
        return view('admin.organization.edit', ['member' => $organization]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrganizationMemberRequest $request, OrganizationMember $organization)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            if ($organization->photo_path) {
                Storage::disk('public')->delete($organization->photo_path);
            }

            $data['photo_path'] = $request->file('photo')->store('organization', 'public');
        }

        $organization->update($data);

        return redirect()->route('admin.organization.index')->with('status', 'Struktur organisasi diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrganizationMember $organization)
    {
        if ($organization->photo_path) {
            Storage::disk('public')->delete($organization->photo_path);
        }

        $organization->delete();

        return redirect()->route('admin.organization.index')->with('status', 'Anggota dihapus.');
    }
}
