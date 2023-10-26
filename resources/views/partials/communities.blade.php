<x-card class="mb-4 hover:shadow">
    <x-subtitle>{{ $community->creator->name }}</x-subtitle>
    <x-title>{{ $community->name }}</x-title>
    <x-body>{{ $community->description }}</x-body>
    <div class="pt-4">
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">
            Members: {{ $community->members->count() }}
        </span>
        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">
            Posts: {{ $community->posts->count() }}
        </span>
    </div>
</x-card>
