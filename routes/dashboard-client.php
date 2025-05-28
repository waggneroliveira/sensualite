<?php

use App\Http\Middleware\Client;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\LikedController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FeedbackClientController;
use App\Http\Controllers\Auth\AuthClientController;

// CLIENT
Route::get('cliente/', function () {
    return redirect()->route('admin.dashboard.client.painel');
});

Route::prefix('cliente/')->group(function() {
    Route::get('login', function() {
        return view('admin.auth.login-client');
    })->name('admin.dashboard.client.painel');

    Route::post('login-client.do', [AuthClientController::class, 'authenticate'])
        ->name('admin.client.authenticate');

    Route::middleware([Client::class])->group(function () {
        Route::get('dashboard/{companionId}', [ClientController::class, 'index'])
        ->name('admin.dashboard.client.index');

        Route::resource('dashboard', ClientController::class)
        ->names('admin.dashboard.client')
        ->parameters(['dashboard' => 'client']);

        Route::get('dasboard/conversa-client/conversations/filter', [ChatController::class, 'filterConversationsClient'])->name('admin.conversations.client.filter');

        Route::post('dashboard/chat-client/{conversationId}/message', [ChatController::class, 'sendMessage'])
        ->name('admin.dashboard.client.chat.send');

        Route::get('dasboard/conversa-client/{conversationId}', [ChatController::class, 'getMessages'])
        ->name('admin.dashboard.client.chat');

        Route::post('/acompanhante/{id}/curtir', [LikedController::class, 'toggleLiked'])->name('admin.dashboard.client.liked');
        Route::get('/acompanhante/{id}/curtidas', [LikedController::class, 'getLikeds'])->name('admin.dashboard.client.getLiked');

        Route::post('feedback', [FeedbackClientController::class, 'store'])->name('admin.dashboard.client.feedback.store');
        Route::put('feedback/{id}/response', [FeedbackClientController::class, 'update'])->name('admin.dashboard.client.feedback.update');

        Route::post('/chat/start', [ChatController::class, 'startConversation'])->name('admin.dashboard.client.chat.start');

        Route::post('/messages/{id}/delete-image', [ChatController::class, 'deleteImage'])->name('admin.dashboard.client.delete-image');
        // Route::get('/view-temp-image/{id}', [ChatController::class, 'viewTempImage'])->name('view.temp.image');

        Route::get('/secure-image/{id}', [ChatController::class, 'showSecureImage'])
            ->name('secure.image'); 

        // LOGOUT
        Route::get('logout', [AuthClientController::class, 'logout'])->name('admin.dashboard.client.logout');
    });    
});


