<x-app-layout>
    <x-slot name="header">
        {{ $community->name }}
    </x-slot>
    @if(session('error'))
    <div>
        {{ session('error') }}
    </div>
    @endif
    @if(session('success'))
    <div>
        {{ session('success') }}
    </div>
    @endif
    <x-card class="mb-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 flex items-center space-x-4">
            <x-title-3xl class="tracking-widest">{{ $community->name }}</x-title-3xl>
            @if ($community->user_id === auth()->user()->id)
                <x-primary-badge>You are the creator</x-primary-badge>
            @else
                @if ($community->members->contains(auth()->user()))
                    <form action="{{ route('leaveCommunity', $community) }}" method="POST">
                        @csrf
                        <x-secondary-button type="submit" class="btn btn-danger">Leave</x-secondary-button>
                    </form>
                @else
                    <form action="{{ route('joinCommunity', $community) }}" method="POST">
                        @csrf
                        <x-primary-button type="submit" class="btn btn-success">Join</x-primary-button>
                    </form>
                @endif
            @endif
        </div>
    </x-card>
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="lg:flex space-x-2">
            <div class="lg:w-3/4">
                @include('partials.create-community-post')
                @foreach ($community->posts as $post)
                    <a href="{{ route('posts.show', $post->id) }}">
                        @include('partials.posts')
                    </a>
                @endforeach
            </div>
            <div class="lg:w-1/4 hidden lg:block">
                <x-card>
                    <x-title>About Community</x-title>
                    <x-body>{{ $community->description }}</x-body>
                    <x-title-md>Members</x-title-md>
                    <div class="flex items-center space-x-2">
                        <x-title-sm>{{ $community->creator->name }}</x-title-sm>
                        @if ($community->user_id === auth()->user()->id)
                            <x-primary-badge>You</x-primary-badge>
                        @else
                            <x-primary-badge>Creator</x-primary-badge>
                        @endif
                    </div>
                    <x-title-md>For Approval</x-title-md>
                    @foreach ($members as $member)
                        @if ($member->pivot->status === 'approved')
                            <x-title-sm>{{ $member->name }}</x-title-sm>
                            @if ($community->user_id === auth()->user()->id)
                                <form action="{{ route('communities.kick', ['community' => $community, 'user' => $member]) }}" method="post">
                                    @csrf
                                    <x-primary-button-xs type="submit">Kick</x-primary-button-xs>
                                </form>
                            @endif
                        @endif
                        @if ($member->pivot->status === 'pending')
                            <x-title-sm>
                                {{ $member->name }}
                                @if ($community->user_id === auth()->user()->id)
                                    <div class="flex space-x-2">
                                        <form method="post" action="{{ route('communities.approve', ['community' => $community, 'user' => $member]) }}">
                                            @csrf
                                            <x-primary-button-xs type="submit">Approve</x-primary-button-xs>
                                        </form>
                                        <form method="post" action="{{ route('communities.reject', ['community' => $community, 'user' => $member]) }}">
                                            @csrf
                                            <x-primary-button-xs type="submit">Reject</x-primary-button-xs>
                                        </form>
                                    </div>
                                @endif
                            </x-title-sm>
                        @endif
                    @endforeach
                </x-card>
            </div>
        </div>
    </div>
</x-app-layout>
