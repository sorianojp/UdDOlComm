<x-app-layout>
    <x-slot name="header">
        {{ __('Communities') }}
    </x-slot>
<div>
    <h1>Communities</h1>
    @foreach ($communities as $community)
        <div>
            <h3>{{ $community->name }}</h3>
            <p>{{ $community->description }}</p>
            <p>{{ $community->creator->name }}</p>
            <a href="{{ route('communities.show', $community) }}">View Community</a>
        </div>
    @endforeach
</div>
</x-app-layout>
