<x-app-layout>
    <x-slot name="header">
        {{ __('Home') }}
    </x-slot>
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="lg:flex space-x-4">
            <div class="lg:w-3/4">
                @include('partials.create-post')
                @foreach ($posts as $post)
                    <a href="{{ route('posts.show', $post->id) }}">
                        @include('partials.posts')
                    </a>
                @endforeach
            </div>
            <div class="lg:w-1/4 hidden lg:block">
                <div class="mb-2">
                    <x-title-md class="uppercase mb-2">Recent Posts</x-title-md>
                    @foreach ($latestPosts as $post)
                    <a href="{{ route('posts.show', $post->id) }}">
                        <div class="bg-gray-200 p-2 rounded my-2">
                            <x-title-xs class="hover:underline">{{ $post->title }}</x-title-xs>
                            <x-subtitle>
                                {{ $post->comments->count() }} Comments
                                ·
                                {{ $post->created_at->diffForHumans() }}
                            </x-subtitle>
                        </div>
                    </a>
                    @endforeach
                </div>
                <div class="mb-2">
                    <x-title-md class="uppercase mb-2">Top Communities</x-title-md>
                    @foreach ($communities as $community)
                    <a href="{{ route('communities.show', $community->id) }}">
                        <div class="bg-gray-200 p-2 rounded my-2 hover:shadow">
                            <x-title-xs class="hover:underline">{{ $community->name }}</x-title-xs>
                            <x-subtitle>
                                Mmebers: {{ $community->members->count() }}
                            </x-subtitle>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
