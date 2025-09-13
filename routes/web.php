<?php

// use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->prefix('{lang}')->middleware(['auth','language', 'verified'])->name('dashboard');

Route::prefix('{lang}')->middleware(['auth','language'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Route::model('post', Post::class);
Route::prefix('{lang}')->middleware(['language'])->group(function () {
    Route::get('posts', [PostController::class, 'index'])->name('posts');
    Route::get('categories', [CategoryController::class, 'index'])->name('categories');
});

Route::group([
    'prefix' => '{lang}',
    'middleware' => ['auth', 'language']
], function () {
    Route::resource('posts', PostController::class)->except(['index'])->scoped(['post' => 'id']);
    Route::resource('categories', CategoryController::class)->except(['index'])->scoped(['category' => 'id']);
});




Route::get('/auth/github', function () {
    return Socialite::driver('github')->redirect();
})->prefix('{lang}')->name('github.login');

Route::get('/auth/github/callback', function () {
    $githubUser = Socialite::driver('github')->user();

    // dd($githubUser);
    $user = User::firstOrCreate(
    [
            'porvider_id'   => $githubUser->getId(),
            'porvider_name' => "github",
        ],
        [
            'name'  => $githubUser->getName() ?? $githubUser->getNickname(),
            'email' => $githubUser->getEmail() ?? $githubUser->getId().'@github.local',
        ]
    );


    Auth::login($user);

    return redirect()->route('dashboard', app()->getLocale());

});

require __DIR__.'/auth.php';
