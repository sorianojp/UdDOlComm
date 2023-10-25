<div x-data="{ showReplyForm: false }">
    <x-title-sm>{{ $comment->user->name }} · <span class="font-light text-gray-400">{{$comment->created_at->diffForHumans()}}</span></x-title-sm>
    <x-body>{{ $comment->body }}</x-body>
    <div class="flex space-x-2 my-2">
        <button type="submit" class="font-medium text-xs text-blue-600 dark:text-blue-500 hover:underline" @click="showReplyForm = !showReplyForm">Reply</button>
        @if(auth()->user() && auth()->user()->id === $comment->user->id)
            <form action="{{ route('delComment', $comment->id) }}" method="POST" class="form">
            @csrf
            @method('DELETE')
                <button type="submit" class="font-medium text-xs text-red-600 dark:text-red-500 hover:underline">Delete</button>
            </form>
        @endif
    </div>
    <!-- Add reply form -->
    <form x-show="showReplyForm" @click.away="showReplyForm = false" action="{{ route('reply', $comment->id) }}" method="POST">
        @csrf
        <x-textarea class="w-full" name="body" rows="2" placeholder="Whare are your thoughts?" required></x-textarea>
        <div class="flex justify-end">
            <x-primary-button type="submit">Reply</x-primary-button>
        </div>
    </form>
    
    <div class="border-l-2 border-gray-300 pl-4">
        @foreach ($comment->replies as $reply)
            @include('posts.comment', ['comment' => $reply])
        @endforeach
    </div>
</div>
