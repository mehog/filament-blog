@foreach ($category_groups as $group)
<div class="relative group">
    <button
        class="flex items-center justify-center font-semibold text-md hover:text-primary-600 gap-x-2">
        <span>{{$group->name}}</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4" viewBox="0 0 24 24">
            <path fill="none" stroke="currentColor" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="1.5" d="m19 9l-7 6l-7-6" />
        </svg>
    </button>
    <div
        class="absolute right-1 group-hover:pointer-events-auto top-[calc(100%)] origin-left pt-2 opacity-0 pointer-events-none transition will-change-transform lg:left-[50%] lg:right-auto lg:translate-x-[-50%] group-hover:opacity-100">
        <div class="top-20 min-w-[15rem] origin-left transition duration-200 will-change-[shadow] translate-y-0">
            <div class="relative z-0 rounded-2xl border bg-white py-4 shadow-xl">
                <div class="max-h-[65vh] list-none overflow-y-auto transition-all duration-300 translate-y-0 opacity-100">
                    @foreach($group->categories as $category)
                        <a href="{{ route('filamentblog.category.post', ['category' => $category->slug]) }}"
                           class="py-2 block text-sm font-medium transition-all duration-300 cursor-pointer hover:text-primary-600 px-6 capitalize"
                        >
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach