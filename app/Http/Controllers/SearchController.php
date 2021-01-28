<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Post;

class SearchController extends Controller
{
    public function index(SearchRequest $request)
    {
        $s = $request->s;

        $posts = Post::like($s)->with('category')->paginate(2);

        return view('posts.search', compact('posts', 's'));
    }
}
