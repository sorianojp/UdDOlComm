<x-app-layout>
    <x-slot name="header">
        {{ __('Home') }}
    </x-slot>
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="lg:flex space-x-2">
            <div class="lg:w-3/4">
                @include('partials.create-post')
                @foreach ($posts as $post)
                <a href="{{ route('posts.show', $post->id) }}">
                    @include('partials.posts')
                </a>
                @endforeach
            </div>
            <div class="lg:w-1/4 hidden lg:block">
                <x-card>
                    <x-title-md class="uppercase mb-2">Recent Posts</x-title-md>
                    @foreach ($latestPosts as $post)
                    <a href="{{ route('posts.show', $post->id) }}">
                        <div class="border-b border-gray-900 dark:border-gray-200 my-1">
                            <x-title-xs class="hover:underline">{{ $post->title }}</x-title-xs>
                            <x-subtitle>
                                {{ $post->comments->count() }} Comments
                                ·
                                {{ $post->created_at->diffForHumans() }}
                            </x-subtitle>
                        </div>
                    </a>
                    @endforeach
                </x-card>
            </div>
        </div>
    </div>


</x-app-layout>
