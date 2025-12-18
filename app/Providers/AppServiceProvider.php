<?php

namespace App\Providers;

use App\Models\Footer;
use App\Models\Menu;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $menus = Cache::remember(
                'menus.active',
                60,
                fn () => Menu::with('children')
                    ->whereNull('parent_id')
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->get()
            );

            $footer = Cache::remember('footer.primary', 60, fn () => Footer::first());
            $settings = Cache::remember('site.settings', 60, fn () => SiteSetting::first());

            $view->with([
                'sharedMenus' => $menus,
                'sharedFooter' => $footer,
                'sharedSettings' => $settings,
            ]);
        });
    }
}
