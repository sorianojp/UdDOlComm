<x-app-layout>
    <x-slot name="header">
    {{ $post->title }}
    </x-slot>
<div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
    @include('partials.posts')
    <x-card>
        <div>
            <form action="{{ route('comment', $post->id) }}" method="POST">
                @csrf
                <x-title-sm>Comment as <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="{{ route('profile.edit') }}">{{ Auth::user()->name }}</a></x-title-sm>
                <x-textarea class="w-full" name="body" rows="3" placeholder="Whare are your thoughts?" required></x-textarea>
                <div class="flex justify-end">
                    <x-primary-button type="submit">Comment</x-primary-button>
                </div>
            </form>
        </div>
        @foreach ($post->comments->where('parent_id', null) as $comment)
            @include('partials.comment', ['comment' => $comment])
        @endforeach
    </x-card>
</div>
</x-app-layout>
