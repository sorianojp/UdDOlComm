<x-app-layout>
    <x-slot name="header">
        {{ __('Posts') }}
    </x-slot>
    @if ($message = Session::get('success'))
        {{ $message }}
    @endif
    <table>
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Body</th>
            <th>Action</th>
        </tr>
        @foreach ($posts as $post)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->body }}</td>
            <td>
                <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
                    <a href="{{ route('posts.show',$post->id) }}">Show</a>
                    <a href="{{ route('posts.edit',$post->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $posts->links() !!}


</x-app-layout>