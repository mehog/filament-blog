<div>
    <div class="flex items-center gap-4">
        @php
            $avatarCallback = config('filamentblog.user.media_library.avatar');
            $avatarUrl = $avatarCallback($post->user);
        @endphp
        @if ($avatarUrl)
        <img class="h-14 w-14 overflow-hidden rounded-full border-4 border-white bg-zinc-300 object-cover text-[0] ring-1 ring-slate-300"
        src="{{ $avatarUrl }}" alt="{{ $post->user->name() }}">
        @endif
        <div>
            <span title="{{ $post->user->name() }}"
                class="block overflow-hidden text-ellipsis whitespace-nowrap font-semibold">{{
                $post->user->name() }}</span>
            <span class="block whitespace-nowrap text-sm font-medium font-semibold text-zinc-600">
                {{ $post->user->{config('filamentblog.user.columns.author_title')} ?? $post->formattedPublishedDate() }}</span>
        </div>
    </div>
</div>