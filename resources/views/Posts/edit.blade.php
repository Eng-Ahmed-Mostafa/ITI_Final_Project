@extends('layouts.app2')

@section('content')
    <div class="container my-5">
        <h2 class="mb-4">Update Post</h2>

        <form method="post" action="{{ route('posts.update', ['lang'=>app()->getLocale(),'post'=>$post->id]) }}" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input name='title' type="text" class="form-control" id="title" placeholder="Enter title">
                @error('title')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Body</label>
                <textarea name="body" id="" class="form-control"></textarea>
                @error('body')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Image</label>
                <input name='image' type="file" class="form-control" >
                
                @error('image')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>

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
            <input type="hidden" name="published_at" value="{{ date('Y-m-d H:i:s') }}">


            {{-- <div class="mb-3">
                <label for="title" class="form-label">Category</label>
                <select name="category_id" class="form-control" id="">
                    <option value="">select</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                  </select>
                  @error('category_id')
                      <div class="alert alert-danger" role="alert">
                          {{ $message }}
                      </div>
                  @enderror
  
            </div> --}}

            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
@endsection
