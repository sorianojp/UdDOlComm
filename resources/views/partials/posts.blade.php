<x-card class="my-4 hover:shadow">
    <div class="flex space-x-2">
        <form action="{{ route('vote', $post) }}" method="POST" >
            @csrf
            <div class="flex flex-col items-center">
                <button type="submit" name="vote" value="upvote" class="{{ Auth::user()->votes->where('vote_type', 'upvote')->contains('post_id', $post->id) ? 'text-green-500' : 'text-gray-500' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11.25l-3-3m0 0l-3 3m3-3v7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </button>
                <div class="dark:text-gray-200">{{ $post->votes()->where('vote_type', 'upvote')->count() - $post->votes()->where('vote_type', 'downvote')->count() }}</div>
                <button type="submit" name="vote" value="downvote" class="{{ Auth::user()->votes->where('vote_type', 'downvote')->contains('post_id', $post->id) ? 'text-red-500' : 'text-gray-500' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75l3 3m0 0l3-3m-3 3v-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </button>
            </div>
        </form>
        <div>
            <div class="flex items-center space-x-2">
                @if ($post->community)
                    <x-title-sm>{{ $post->community->name }}</x-title-sm>
                @else
                    <x-title-sm>For All</x-title-sm>
                @endif
                <x-subtitle>Posted by {{ $post->user->name }} {{ $post->created_at->diffForHumans() }}</x-subtitle>
            </div>
            <x-title>{{ $post->title }}</x-title>
            <x-body>{{ $post->body }}</x-body>
            <div class="pt-4">
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">
                {{ $post->comments->count() }} Comments
            </span>
            </div>
        </div>
    </div>
</x-card>
