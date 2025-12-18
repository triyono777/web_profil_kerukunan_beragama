<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SiteSettingRequest;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

class SiteSettingController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $siteSetting = SiteSetting::firstOrCreate(['id' => 1]);

        return view('admin.settings.edit', compact('siteSetting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SiteSettingRequest $request)
    {
        $siteSetting = SiteSetting::firstOrCreate(['id' => 1]);
        $siteSetting->update($request->validated());

        Cache::forget('site.settings');

        return redirect()->route('admin.settings.edit')->with('status', 'Pengaturan situs diperbarui.');
    }
}
