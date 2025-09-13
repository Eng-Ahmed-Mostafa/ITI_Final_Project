@extends('layouts.app2')

@section('content')
    <div class="container my-5">
        <h2 class="mb-4">Posts Table</h2>
        <table class="table table-bordered table-hover">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Body</th>
                <th scope="col">Image</th>
                <th scope="col">published_at</th>
                <th scope="col">Category</th>

                @if (auth()->check() && auth()->user()->responsible === 'ADM')  
                    <th scope="col">Actions</th>
                @endif
            </tr>
            @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->body }}</td>
                    <td><img src="{{ asset('storage/'.$post->image) }}" width="100" alt="post image"></td>
                    <td>{{ $post->published_at }}</td>
                    <td>{{ $post->category->title }}</td>
                    {{-- <td>{{ $post->category->title }}</td> --}}
                    @if (auth()->user()->responsible == "ADM")
                    
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('posts.edit', ['lang' => App::getLocale(),'post' => $post->id]) }}" type="button" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{ route('posts.show', ['lang' => App::getLocale(),'post' => $post->id]) }}" type="button" class="btn btn-info btn-sm text-white">Show</a>
                                <form method="post" action="{{ route('posts.destroy', [ 'lang' => App::getLocale(),'post'=>$post->id]) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    @endif
                </tr>
            @endforeach
        </table>
        {{ $posts->links('pagination::bootstrap-5') }}
    </div>
@endsection
