<?php

namespace Firefly\FilamentBlog\Http\Controllers;

use Firefly\FilamentBlog\Facades\SEOMeta;
use Firefly\FilamentBlog\Models\NewsLetter;
use Firefly\FilamentBlog\Models\Post;
use Firefly\FilamentBlog\Models\Category;
use Firefly\FilamentBlog\Models\ShareSnippet;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        SEOMeta::setTitle(config('filamentblog.pages.overview.title'));
        // fetch all categories with 3 latest posts
        $categories = Category::query()->get();

        foreach ($categories as $category) {
            $category->posts = $category->posts()
                ->published()
                ->orderBy('created_at', 'desc')
                ->take(4)
                ->get();
        }

        return view('filament-blog::blogs.all-post', [
            'categories' => $categories,
        ]);
    }

    public function allPosts()
    {
        SEOMeta::setTitle('All posts | '.config('app.name')) ;

        $posts = Post::query()->with(['categories', 'user'])
            ->published()
            ->paginate(20);

        return view('filament-blog::blogs.all-post', [
            'posts' => $posts,
        ]);
    }

    public function search(Request $request)
    {
        SEOMeta::setTitle('Search result for '.$request->get('query'));

        $request->validate([
            'query' => 'required',
        ]);
        $searchedPosts = Post::query()
            ->with(['categories', 'user'])
            ->published()
            ->whereAny(['title', 'sub_title'], 'like', '%'.$request->get('query').'%')
            ->paginate(10)->withQueryString();

        return view('filament-blog::blogs.search', [
            'posts' => $searchedPosts,
            'searchMessage' => 'Search result for '.$request->get('query'),
        ]);
    }

    public function show(Post $post)
    {

        SEOMeta::setTitle($post->seoDetail?->title);

        SEOMeta::setDescription($post->seoDetail?->description);

        SEOMeta::setKeywords($post->seoDetail->keywords ?? []);

        $shareButton = ShareSnippet::query()->active()->first();
        $post->load(['user', 'categories', 'tags', 'comments' => fn ($query) => $query->approved(), 'comments.user']);

        return view('filament-blog::blogs.show', [
            'post' => $post,
            'shareButton' => $shareButton,
        ]);
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:'. config('filamentblog.tables.prefix') . 'news_letters,email',
        ], [
            'email.unique' => 'You have already subscribed. Thank you!',
        ]);
        NewsLetter::create([
            'email' => $request->email,
        ]);

        return back()->with('success', 'You have successfully subscribed to our news letter');
    }
}
