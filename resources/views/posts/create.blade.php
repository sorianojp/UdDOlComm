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
<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <div class="space-y-2">
        <select name="community_id">
            <option value="">No Community</option>
            @foreach ($communities as $community)
                <option value="{{ $community->id }}">{{ $community->name }}</option>
            @endforeach
        </select>
        <x-input type="text" class="w-full" name="title" placeholder="Title"/>
        <x-textarea class="w-full" rows="6" name="body" placeholder="Body"></x-textarea>
        <div class="flex justify-end">
            <x-primary-button type="submit">Post</x-primary-button>
        </div>
    </div>
</form>
</x-card>
</div>
</x-app-layout>
