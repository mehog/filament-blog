@props(['logo' => null])
@foreach ($category_groups as $group)
<div class="relative group hidden lg:block">
    <button class="flex items-center justify-center font-semibold text-md hover:text-primary-600 gap-x-2">
        <span>{{$group->name}}</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4" viewBox="0 0 24 24">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="m19 9l-7 6l-7-6" />
        </svg>
    </button>
    <div
        class="absolute right-1 group-hover:pointer-events-auto top-[calc(100%)] origin-left pt-2 opacity-0 pointer-events-none transition will-change-transform lg:left-[50%] lg:right-auto lg:translate-x-[-50%] group-hover:opacity-100">
        <div class="top-20 min-w-[15rem] origin-left transition duration-200 will-change-[shadow] translate-y-0">
            <div class="relative z-0 rounded-2xl border bg-white py-4 shadow-xl">
                <div
                    class="max-h-[65vh] list-none overflow-y-auto transition-all duration-300 translate-y-0 opacity-100">
                    @foreach($group->categories as $category)
                    <a href="{{ route('filamentblog.category.post', ['category' => $category->slug]) }}"
                        class="py-2 block text-sm font-medium transition-all duration-300 cursor-pointer hover:text-primary-600 px-6 capitalize">
                        {{ $category->name }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Hamburger Menu Button -->
<button id="menuButton" class="block lg:hidden text-gray-700 focus:outline-none absolute right-5 top-0 z-50">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
</button>

<!-- Overlay Background -->
<div id="menuOverlay" class="fixed inset-0 bg-black bg-opacity-50 hidden backdrop-blur-sm z-40"></div>

<!-- Sliding Menu -->
<div id="mobileMenu"
    class="fixed top-0 left-0 w-72 max-h-screen bg-white h-full transform -translate-x-full menu-slide shadow-lg z-50 overflow-y-auto"
    style="transition: transform 0.3s ease">
    <div class="p-4 relative">
        <!-- Logo at the top left -->
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center">
                @if($logo)
                <img src="{{ $logo }}" alt="Logo" class="max-h-[60px] h-8 w-auto" style="min-width: 100px" />
                @endif
            </div>
            <!-- Close Button -->
            <button id="closeMenuButton" class="text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
        <nav class="mt-10">
            <ul>
                @foreach ($category_groups as $group)
                <li class="py-2">
                    <a href="javascript:void(0)" class="font-semibold text-md hover:text-primary-600">
                        {{$group->name}}
                    </a>
                    <ul>
                        @foreach($group->categories as $category)
                        <li class="py-4">
                            <a href="{{ route('filamentblog.category.post', ['category' => $category->slug]) }}"
                                class="text-gray-700 hover:text-primary-600 ms-2">
                                {{ $category->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
        </nav>
    </div>
</div>

<script>
    const menuButton = document.getElementById('menuButton');
    const closeMenuButton = document.getElementById('closeMenuButton');
    const mobileMenu = document.getElementById('mobileMenu');
    const menuOverlay = document.getElementById('menuOverlay');

    // Function to open the menu
    const openMenu = () => {
        mobileMenu.classList.remove('-translate-x-full');
        menuOverlay.classList.remove('hidden');
    };

    // Function to close the menu
    const closeMenu = () => {
        mobileMenu.classList.add('-translate-x-full');
        menuOverlay.classList.add('hidden');
    };

    menuButton.addEventListener('click', openMenu);
    closeMenuButton.addEventListener('click', closeMenu);
    menuOverlay.addEventListener('click', closeMenu); // Close when clicking outside the menu
</script>