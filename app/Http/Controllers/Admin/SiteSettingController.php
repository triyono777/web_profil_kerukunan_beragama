<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SiteSettingRequest;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

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
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            if ($siteSetting->logo_path) {
                Storage::disk('public')->delete($siteSetting->logo_path);
            }
            $data['logo_path'] = $request->file('logo')->store('branding', 'public');
        }

        if ($request->hasFile('favicon')) {
            if ($siteSetting->favicon_path) {
                Storage::disk('public')->delete($siteSetting->favicon_path);
            }
            $data['favicon_path'] = $request->file('favicon')->store('branding', 'public');
        }

        $siteSetting->update($data);

        Cache::forget('site.settings');

        return redirect()->route('admin.settings.edit')->with('status', 'Pengaturan situs diperbarui.');
    }
}
