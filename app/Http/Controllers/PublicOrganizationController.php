<?php

namespace App\Http\Controllers;

use App\Models\OrganizationMember;

class PublicOrganizationController extends Controller
{
    public function index()
    {
        $members = OrganizationMember::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('public.organization', compact('members'));
    }
}
