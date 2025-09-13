@extends('layouts.app2')

@section('content')
    <div class="container my-5">
        <h2 class="mb-4">Create New Post</h2>

        <form method="POST" action="{{ route('posts.store',['lang'=>App::getLocale()]) }}" enctype="multipart/form-data">
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

            {{-- Body --}}
            <div class="mb-3">
                <label for="body" class="form-label">Body</label>
                <textarea name="body" id="body" class="form-control">{{ old('body') }}</textarea>
                
                @error('body')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Image --}}
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input name="image" type="file" class="form-control" id="image">
                
                @error('image')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Categories --}}
            <div class="mb-3">
                <label for="image" class="form-label">Category</label>
                <select name="category_id" class="form-control" id="">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{$category->title}}</option>
                        
                    @endforeach
                </select>
                
                @error('category_id')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Published At --}}
            <input type="hidden" name="published_at" value="{{ date('Y-m-d') }}">

            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
@endsection
