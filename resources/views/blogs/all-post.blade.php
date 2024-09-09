<x-blog-layout>
    @section('meta')
    <meta name="title" content="{{config('filamentblog.pages.overview.title')}}">
    <meta name="description" content="{{config('filamentblog.pages.overview.description')}}">
    <meta property="og:title" content="{{config('filamentblog.pages.overview.title')}}">
    <meta property="og:description" content="{{config('filamentblog.pages.overview.description')}}">
    <link rel="canonical" href="{{ request()->fullUrl() }}">
    @endsection
    <section>
        <header class="container mx-auto mb-4 px-5 pb-4 mt-5 text-left">
            <h1 class="inherits-color text-balance leading-tighter relative z-10 text-3xl font-semibold tracking-tight">
                {{ config('filamentblog.pages.overview.title') }}
            </h1>
            <p class="mt-4">
                {{ config('filamentblog.pages.overview.description') }}
            </p>
        </header>
    </section>
    @foreach ($categories as $category)
    <section class="py-5">
        <header class="container mx-auto px-5">
            <h2 class="inherits-color text-balance leading-tighter relative z-10 text-3xl font-semibold tracking-tight">
                {{ $category->name }}
            </h2>
        </header>
    </section>
    <section class="pb-16 pt-4">
        <div class="container mx-auto px-5">
            <div class="grid gap-x-5 gap-y-14 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @forelse ($category->posts as $post)
                    <x-blog-card :post="$post" :showAuthor="false"/>
                @empty
                    <div class="mx-auto col-span-3">
                        <div class="flex items-center justify-center">
                            <p class="text-2xl font-semibold text-gray-300">No posts found</p>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="flex justify-center pt-5">
                <a href="{{ route('filamentblog.category.post', ['category' => $category->slug]) }}" class="flex items-center justify-center md:gap-x-5 rounded-full bg-slate-100 px-20 py-4 text-sm font-semibold transition-all duration-300 hover:bg-slate-200">
                    <span>View all</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6m0 0H9m9 0v9" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endforeach

</x-blog-layout>
