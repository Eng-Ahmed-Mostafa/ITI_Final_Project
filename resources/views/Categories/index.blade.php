@extends('layouts.app2')

@section('content')
    <div class="container my-5">
        <h2 class="mb-4">Categories Table</h2>
        <table class="table table-bordered table-hover">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>

                @if (auth()->check() && auth()->user()->responsible === 'ADM')  
                    <th scope="col">Actions</th>
                @endif
            </tr>
            @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td>{{ $category->title }}</td>
                    @if (auth()->user()->responsible == "ADM")
                    
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('categories.edit', ['lang' => App::getLocale(),'category' => $category->id]) }}" type="button" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{ route('categories.show', ['lang' => App::getLocale(),'category' => $category->id]) }}" type="button" class="btn btn-info btn-sm text-white">Show</a>
                                <form method="category" action="{{ route('categories.destroy', [ 'lang' => App::getLocale(),'category'=>$category->id]) }}">
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
        {{ $categories->links('pagination::bootstrap-5') }}
    </div>
@endsection
