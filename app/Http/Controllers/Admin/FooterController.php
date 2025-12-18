<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FooterRequest;
use App\Models\Footer;
use Illuminate\Support\Facades\Cache;

class FooterController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $footer = Footer::firstOrCreate(['id' => 1]);

        return view('admin.footer.edit', compact('footer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FooterRequest $request)
    {
        $footer = Footer::firstOrCreate(['id' => 1]);
        $data = $request->validated();

        $data['social_links'] = collect($data['social_links'] ?? [])
            ->filter(fn ($link) => filled($link['platform'] ?? null) && filled($link['url'] ?? null))
            ->values()
            ->all();

        $data['quick_links'] = collect($data['quick_links'] ?? [])
            ->filter(fn ($link) => filled($link['label'] ?? null) && filled($link['url'] ?? null))
            ->values()
            ->all();

        $footer->update($data);
        Cache::forget('footer.primary');

        return redirect()->route('admin.footer.edit')->with('status', 'Footer diperbarui.');
    }
}
