<x-app-layout>
    <x-slot name="header">
        {{ __('Home') }}
    </x-slot>
<div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
    <x-card class="mb-4 hover:shadow">
        <a href="{{ route('posts.create') }}">
            <x-input type="text" class="w-full" placeholder="Create Post"/>
        </a>
    </x-card>
    @foreach ($posts as $post)
    <a href="{{ route('posts.show', $post->id) }}">
        <x-card class="my-4 hover:shadow">
            <x-subtitle>Posted by {{ $post->user->name }} {{ $post->created_at->diffForHumans() }}</x-subtitle>
            <x-title>{{ $post->title }}</x-title>
            <x-body>{{ $post->body }}</x-body>
            <div class="pt-4">
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">
                    {{ $post->comments->count() }} Comments
                </span>
            </div>
        </x-card>
    </a>
    @endforeach
</div>
</x-app-layout>