<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PublicPostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['category', 'tags'])
            ->published()
            ->when($request->get('q'), fn ($q, $term) => $q->where(function ($sub) use ($term) {
                $sub->where('title', 'like', "%{$term}%")
                    ->orWhere('excerpt', 'like', "%{$term}%");
            }))
            ->when($request->get('category'), function ($q, $slug) {
                $q->whereHas('category', fn ($cat) => $cat->where('slug', $slug));
            })
            ->when($request->get('tag'), function ($q, $slug) {
                $q->whereHas('tags', fn ($tag) => $tag->where('slug', $slug));
            })
            ->latest('published_at');

        $posts = $query->paginate(9)->withQueryString();
        $categories = Category::all();
        $tags = Tag::all();

        return view('public.posts.index', compact('posts', 'categories', 'tags'));
    }

    public function show(string $slug)
    {
        $post = Post::with(['category', 'tags', 'author'])
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        $related = Post::published()
            ->where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('public.posts.show', compact('post', 'related'));
    }
}
