<x-app-layout>
    <x-slot name="header">
        {{ __('My Posts') }}
    </x-slot>
<div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
    @include('partials.create-post')
    @foreach ($myposts as $post)
        <a href="{{ route('posts.show', $post->id) }}">
            @include('partials.posts')
        </a>
    @endforeach
    {!! $myposts->links() !!}
</div>
</x-app-layout>
