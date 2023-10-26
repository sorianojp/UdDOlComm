<x-app-layout>
    <x-slot name="header">
        {{ __('Create Post') }}
    </x-slot>
<div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
@if ($errors->any())
    <div>
        <strong>Error!</strong> <br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<x-card>
    <form action="{{ route('communityPostStore', $community) }}" method="POST">
        @csrf
        <div class="space-y-2">
            <input type="text" name="title">
            <textarea name="body" rows="5"></textarea>
        </div>
        <button type="submit">Post</button>
    </form>
</x-card>
</div>
</x-app-layout>
