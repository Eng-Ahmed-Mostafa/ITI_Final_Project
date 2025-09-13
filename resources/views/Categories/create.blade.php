@extends('layouts.app2')

@section('content')
    <div class="container my-5">
        <h2 class="mb-4">Create New Category</h2>

        <form method="POST" action="{{ route('categories.store',['lang'=>App::getLocale()]) }}" enctype="multipart/form-data">
            @csrf
            {{-- Title --}}
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input name="title" type="text" class="form-control" id="title" placeholder="Enter title" value="{{ old('title') }}">
                
                @error('title')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
@endsection
