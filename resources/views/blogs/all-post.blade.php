<x-blog-layout>
    @foreach ($categories as $category)
    <section class="py-5">
        <header class="container mx-auto px-5">
            <h3 class="inherits-color text-balance leading-tighter relative z-10 text-3xl font-semibold tracking-tight">
                {{ $category->name }}
            </h3>
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
        </div>
    </section>
    @endforeach

</x-blog-layout>
