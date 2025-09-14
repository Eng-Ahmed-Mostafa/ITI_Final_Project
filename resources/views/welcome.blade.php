<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light min-vh-100 d-flex flex-column">

    <!-- Header -->
    <header class="container my-3">
        @if (Route::has('login'))
            <nav class="d-flex justify-content-end gap-2">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary btn-sm">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-success btn-sm">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <!-- Main Content -->
    <main class="container flex-grow-1 py-3">
        <div class="row">
            <div class="col-md-9">
                <div class="table-responsive shadow rounded bg-white p-3">
                    <table class="table table-bordered table-hover align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Body</th>
                                <th scope="col">Image</th>
                                <th scope="col">Published At</th>
                                <th scope="col">Category</th>
                                @if (auth()->check() && auth()->user()->responsible === 'ADM')  
                                    <th scope="col">Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <th scope="row">{{ $post->id }}</th>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ Str::limit($post->body, 80) }}</td>
                                    <td>
                                        @if($post->image)
                                            <img src="{{ asset('storage/'.$post->image) }}" width="100" class="img-thumbnail" alt="post image">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $post->published_at }}</td>
                                    <td>{{ $post->category->title ?? 'N/A' }}</td>

                                    @if (auth()->user()?->responsible === "ADM")
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('posts.edit', ['lang' => App::getLocale(),'post' => $post->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <a href="{{ route('posts.show', ['lang' => App::getLocale(),'post' => $post->id]) }}" class="btn btn-info btn-sm text-white">Show</a>
                                                <form method="post" action="{{ route('posts.destroy', ['lang' => App::getLocale(),'post'=>$post->id]) }}" onsubmit="return confirm('Are you sure you want to delete this post?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-3">
                <div class="shadow rounded bg-white p-3">
                    <h5 class="mb-3">Categories</h5>
                    <ul class="list-group">
                        @foreach ($categories as $cat)
                            <li class="list-group-item">
                                <a href="{{ route('categories.show',['lang'=>App::getLocale(),'category'=>$cat->id]) }}">
                                    {{ $cat->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </main>

   

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
 