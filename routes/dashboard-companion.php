<?php

use App\Http\Middleware\Companion;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\PostFileController;
use App\Http\Controllers\CompanionController;
use App\Http\Controllers\LikedPostController;
use App\Http\Controllers\GalleryFileController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\FeedbackClientController;
use App\Http\Controllers\Auth\AuthCompanionController;
use App\Http\Controllers\DashboardCompanionController;

Route::get('acompanhante', function(){
    return redirect()->route('admin.dashboard.companion.painel');
});

Route::prefix('acompanhante/')->group(function(){
    Route::get('login', function(){
        return view('admin.auth.login-companion');
    })->name('admin.dashboard.companion.painel');

    Route::post('login-companion.do', [AuthCompanionController::class, 'authenticate'])
        ->name('admin.companion.authenticate');


    Route::middleware([Companion::class])->group(function(){
        Route::post('/checkout', [PaymentController::class, 'createCheckout'])->name('payment.checkout');

        Route::get('dashboard', [DashboardCompanionController::class, 'index'])
        ->name('admin.dashboard.companion.index');

        Route::get('dasboard/conversa-companion/conversations/filter', [ChatController::class, 'filterConversationsCompanion'])->name('admin.conversations.companion.filter');

        Route::post('dashboard/chat-companion/{conversationId}/message', [ChatController::class, 'sendMessageCompanion'])
        ->name('admin.dashboard.companion.chat.send');

        Route::get('dasboard/conversa/companion/{conversationId}', [ChatController::class, 'getMessagesCompanion'])
        ->name('admin.dashboard.companion.chat');

        Route::get('ensaios/{galery}', [GalleryController::class, 'index'])->name('admin.dashboard.companion.galleryId');
        Route::post('ensaios/solicitacao-de-aprovacao/{galleryId}', [GalleryController::class, 'requestApproval'])
        ->name('admin.dashboard.companion.gallery.requestApproval');

        Route::resource('ensaios', GalleryController::class)
        ->names('admin.dashboard.companion.gallery')
        ->parameters(['ensaios' => 'galleries']);

        Route::resource('ensaios/arquivo', GalleryFileController::class)
        ->names('admin.dashboard.companion.galleryFile')
        ->parameters(['arquivo' => 'galleryFile']);
        
        Route::get('post/{post}', [PostController::class, 'index'])->name('admin.dashboard.companion.postId');
        Route::resource('post', PostController::class)
        ->names('admin.dashboard.companion.post')
        ->parameters(['post' => 'posts']);
        Route::delete('/post/{post}/delete', [PostController::class, 'destroy'])->name('admin.dashboard.companion.post.destroy');

        Route::put('post/update/{post}', [PostController::class, 'update'])->name('admin.dashboard.companion.post.update');

        Route::resource('post/arquivo', PostFileController::class)
        ->names('admin.dashboard.companion.postFile')
        ->parameters(['arquivo' => 'postFile']);

        Route::post('{id}/curtir', [LikedPostController::class, 'toggleLiked'])->name('admin.dashboard.companion.liked');
        Route::get('{id}/curtidas', [LikedPostController::class, 'getLikeds'])->name('admin.dashboard.companion.getLiked');
        
        Route::get('/chat', [ChatController::class, 'listConversations'])->name('chat.list');
        Route::post('/chat/{conversationId}/message', [ChatController::class, 'sendMessage'])->name('chat.reply');

        Route::resource('perfil', CompanionController::class)
        ->names('admin.dashboard.companion.profile')
        ->parameters(['perfil' => 'companion']);
        
        Route::resource('review', FeedbackClientController::class)
        ->names('admin.dashboard.feedback')
        ->parameters(['review' => 'feedback']);
        Route::post('review/delete', [FeedbackClientController::class, 'destroySelected'])
        ->name('admin.dashboard.feedback.destroySelected');
        Route::post('review/sorting', [FeedbackClientController::class, 'sorting'])
        ->name('admin.dashboard.feedback.sorting');

        Route::get('plano', [PlanController::class, 'indexCompanion'])->name('admin.dashboard.companion.plan');

        Route::get('file/gallery', function(){
            return view('admin.gallery-companion');
        })->name('admin.dashboard.companion.gallery');
                
        // LOGOUT
        Route::get('logout', [AuthCompanionController::class, 'logout'])->name('admin.dashboard.companion.logout');
    });
});