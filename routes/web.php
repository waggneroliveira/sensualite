<?php

use App\Models\CompanionCategory;
use App\Http\Middleware\Companion;
use App\Models\CompanionHasCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikedController;
use App\Repositories\CompanionRepository;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PaymentController;
use App\Models\Companion as ModelsCompanion;
use App\Http\Controllers\CompanionController;
use App\Http\Controllers\Auth\AuthClientController;
use App\Http\Controllers\Client\FeedPageController;
use App\Http\Controllers\Client\HomePageController;
use App\Http\Controllers\Client\CompanionPageController;
use App\Http\Controllers\ClientController;

require __DIR__ . '/dashboard.php';
require __DIR__ . '/dashboard-client.php';
require __DIR__ . '/dashboard-companion.php';


Route::get('/', function () {
    return redirect()->route('client.home');
});
Route::get('home', [HomePageController::class, 'index'])->name('client.home');
Route::get('acompanhantes', [CompanionPageController::class, 'index'])->name('client.escort');
Route::get('acompanhantes/categoria/{category}', [CompanionPageController::class, 'index'])->name('client.escort.category');
Route::get('acompanhante/{slug}', [CompanionPageController::class, 'companion'])->name('client.post');
Route::post('/acompanhante/{id}/seguir', [FollowController::class, 'toggleFollow'])->name('admin.client.follow');
Route::post('/acompanhante/post/{id}/curtir', [FollowController::class, 'togglePostLiked'])->name('admin.client.likedPost');
Route::post('/home/{id}/curtir', [HomePageController::class, 'toggleLiked'])->name('admin.dashboard.client.liked');
Route::post('/home/set-genero', [HomePageController::class, 'setGenero'])->name('client.set.genero');

Route::get('logout', [AuthClientController::class, 'logoutClient'])->name('admin.client.logout');

Route::post('feedback', [CompanionPageController::class, 'feedback'])->name('admin.client.feedback.store');

Route::post('/acompanhante/pagamento/consulta', [PaymentController::class, 'handleWebhook'])
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])
    ->withoutMiddleware('web');
    
Route::get('/contato', function () {
    return view('client.pages.contact');
})->name('client.contact');

Route::get('/sobre', function () {
    return view('client.pages.about');
})->name('client.about');


Route::get('/feed', [FeedPageController::class, 'index'])->name('client.feed');

Route::get('/cadastro', function () {
    return view('client.pages.register');
})->name('client.register');

Route::post('cadastro/cliente/store', [ClientController::class, 'store'])->name('client.register-client.store');

Route::post('cadastro/store', [CompanionController::class, 'store'])->name('client.register.store');

Route::get('/confirmacao', function () {
    return view('client.pages.confirmation');
})->name('client.confirmation');


View::composer('client.core.client', function ($view) {
    $categories = (new CompanionRepository)->allCategories();

    $view->with('categories', $categories);
});
