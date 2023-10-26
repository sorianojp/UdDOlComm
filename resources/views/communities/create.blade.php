<x-app-layout>
    <x-slot name="header">
        {{ __('Create Community') }}
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
            <form action="{{ route('communities.store') }}" method="POST">
                @csrf
                <div class="space-y-2">
                    <x-input type="text" class="w-full" name="name" placeholder="Name"/>
                    <x-textarea class="w-full" name="description" rows="4" placeholder="Description"></x-textarea>
                    <div class="flex justify-end">
                        <x-primary-button type="submit">Create</x-primary-button>
                    </div>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
