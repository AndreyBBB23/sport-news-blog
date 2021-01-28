<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Support\Facades\Cache;

class MainController extends Controller
{
    public function index()
    {
        $categories_count = Category::all()->count();
        $tags_count = Tag::all()->count();
        $posts_count = Post::all()->count();
        $user_count = User::all()->count();

        return view('admin.index', compact('categories_count', 'tags_count', 'posts_count', 'user_count'));
    }

    public function clearCache()
    {
        Cache::flush();

        return redirect()->route('admin.index')->with('success', 'Clear all cache successful!');
    }
}
