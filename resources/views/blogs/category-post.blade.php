<x-blog-layout>
    @section('meta')
    <meta name="title" content="{{ $category->name }}">
    <meta name="description" content="{{ $category->description }}">
    <meta property="og:title" content="{{ $category->name }}">
    <meta property="og:description" content="{{ $category->description }}">
    <!-- Add any other meta tags specific to this page -->
    @endsection
    <section>
        <header class="container mx-auto mb-4 px-5 pb-4 mt-5 text-left">
            <h1 class="inherits-color text-balance leading-tighter relative z-10 text-3xl font-semibold tracking-tight">
                {{ $category->name }}
            </h1>
            <p class="mt-4">
                {{ $category->description }}
            </p>
        </header>
    </section>
    <section class="pb-16 pt-4">
        <div class="container mx-auto px-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-14 gap-y-14">
                @forelse ($posts as $post)
                <x-blog-card :post="$post" :showAuthor="false" />
                @empty
                <div class="mx-auto col-span-3">
                    <div class="flex items-center justify-center">
                        <p class="text-2xl font-semibold text-gray-300">No posts found</p>
                    </div>
                </div>
                @endforelse
            </div>
            <div class="mt-20">
                {{ $posts->links() }}
            </div>
        </div>
    </section>

</x-blog-layout>