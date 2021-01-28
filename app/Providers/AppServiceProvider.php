<?php

namespace App\Providers;

use App\Category;
use App\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.sidebar', function ($view) {
            if (Cache::has('sidebar_categories')) {
                $categories = Cache::get('sidebar_categories');
            } else {
                $categories = Category::withCount('posts')->orderBy('posts_count', 'desc')->get();
                Cache::put('sidebar_categories', $categories, 3600);
            }

            $view->with('popular_posts', Post::orderBy('views', 'desc')->limit(3)->get());
            $view->with('categories', $categories);
        });

        view()->composer('layouts.header', function ($view) {
            if (Cache::has('header_categories')) {
                $categories = Cache::get('header_categories');
            } else {
                $categories = Category::orderBy('id', 'desc')->get();
                Cache::put('header_categories', $categories, 86400);
            }

            $view->with('categories', $categories);
        });

        view()->composer('layouts.footer', function ($view) {
            if (Cache::has('footer_categories')) {
                $categories = Cache::get('footer_categories');
            } else {
                $categories = Category::withCount('posts')->orderBy('posts_count', 'desc')->get();
                Cache::put('footer_categories', $categories, 3600);
            }

            $view->with('new_posts', Post::orderBy('created_at', 'desc')->limit(3)->get());
            $view->with('popular_posts', Post::orderBy('views', 'desc')->limit(3)->get());
            $view->with('categories', $categories);
        });
    }
}
