<x-app-layout>
    <x-slot name="header">
        {{ __('Communities') }}
    </x-slot>
<div>
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        @foreach ($communities as $community)
            <a href="{{ route('communities.show', $community) }}">
                @include('partials.communities')
            </a>
        @endforeach
    </div>
</div>
</x-app-layout>
