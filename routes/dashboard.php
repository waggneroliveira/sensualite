<?php

use App\Models\Companion;
use Illuminate\Support\Carbon;
use App\Http\Middleware\Client;
use Illuminate\Support\Facades\View;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CompanionController;
use App\Http\Controllers\SubscribedController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AuditActivityController;
use App\Http\Controllers\CompanionCategoryController;
use App\Http\Controllers\CredentialPagarmeController;
use App\Http\Controllers\SolicitationforGallery;

Route::get('painel/', function () {
    return redirect()->route('admin.dashboard.painel');
});

Route::prefix('painel/')->group(function(){
    Route::get('reset-password', function(){
        return view('admin.auth.reset-password');
    })->name('admin.dashboard.reset-password');

    Route::get('forgot-password', function(){
        return view('admin.auth.forgot-password');
    })->name('admin.dashboard.forgot-password');

    Route::get('login', function(){
        return view('admin.auth.login-admin');
    })->name('admin.dashboard.painel');

    Route::get('/success-logout', function () {
        return view('admin.logout.success-logout');
    })->name('success-logout');

    Route::post('login.do', [AuthController::class, 'authenticate'])
    ->name('admin.user.authenticate');

    Route::get('solicitacoes', function(){
        return view('admin.blades.solicitation.index');
    })->name('admin.dashboard.solicitation');

    Route::middleware([Authenticate::class])->group(function(){
        Route::get('dashboard', function(){
            return view('admin.dashboard');
        })->name('admin.dashboard');

         //AUDITORIA
         Route::resource('auditorias', AuditActivityController::class)
         ->names('admin.dashboard.audit')
         ->parameters(['auditorias'=>'activitie']);
         Route::post('auditorias/{id}/mark-as-read', [AuditActivityController::class, 'markAsRead']);
         Route::post('/auditorias/mark-all-as-read', [AuditActivityController::class, 'markAllAsRead']);
 
        //GRUPOS
        Route::resource('grupos', RoleController::class)
        ->names('admin.dashboard.group')
        ->parameters(['grupos' => 'role']);
        Route::post('grupos/delete', [RoleController::class, 'destroySelected'])
        ->name('admin.dashboard.group.destroySelected');

        //USUARIOS
        Route::resource('usuario', UserController::class)
        ->names('admin.dashboard.user')
        ->parameters(['usuario'=>'user']);
        Route::post('usuario/delete', [UserController::class, 'destroySelected'])
        ->name('admin.dashboard.user.destroySelected');
        Route::post('usuario/sorting', [UserController::class, 'sorting'])
        ->name('admin.dashboard.user.sorting');
        
        //PACOTES
        Route::resource('pacotes', PackageController::class)
        ->names('admin.dashboard.package')
        ->parameters(['pacotes'=>'package']);
        Route::post('pacotes/delete', [PackageController::class, 'destroySelected'])
        ->name('admin.dashboard.package.destroySelected');
        Route::post('pacotes/sorting', [PackageController::class, 'sorting'])
        ->name('admin.dashboard.package.sorting');

        //PLANOS
        Route::resource('assinaturas', PlanController::class)
        ->names('admin.dashboard.plan')
        ->parameters(['assinaturas' => 'plan']);

        //NOTIFICACAO
        Route::resource('notificacao', NotificationController::class)
        ->names('admin.dashboard.notification')
        ->parameters(['notificacao' => 'notification']);
        Route::post('notificacao/delete', [NotificationController::class, 'destroySelected'])
        ->name('admin.dashboard.notification.destroySelected');
        Route::post('notificacao/sorting', [NotificationController::class, 'sorting'])
        ->name('admin.dashboard.notification.sorting');
        
        Route::resource('categoria', CompanionCategoryController::class)
        ->names('admin.dashboard.category')
        ->parameters(['categoria' => 'companionCategory']);
        Route::post('categoria/delete', [CompanionCategoryController::class, 'destroySelected'])
        ->name('admin.dashboard.category.destroySelected');
        Route::post('categoria/sorting', [CompanionCategoryController::class, 'sorting'])
        ->name('admin.dashboard.category.sorting');

        Route::resource('anuncios', AnnouncementController::class)
        ->names('admin.dashboard.announcement')
        ->parameters(['anuncios' => 'announcement']);
        Route::post('anuncios/delete', [AnnouncementController::class, 'destroySelected'])
        ->name('admin.dashboard.announcement.destroySelected');
        Route::post('anuncios/sorting', [AnnouncementController::class, 'sorting'])
        ->name('admin.dashboard.announcement.sorting');

        Route::post('acompanhantes/search/{slug?}', [CompanionController::class, 'indexAdmin'])->name('admin.companion.search');
        Route::get('acompanhantes', [CompanionController::class, 'indexAdmin'])->name('admin.companion.index');
        Route::put('acompanhante/update/{companion}', [CompanionController::class, 'update'])
        ->name('admin.companion.update');
        Route::put('acompanhante/statusVerificationUpdate/update/{companion}', [CompanionController::class, 'statusVerificationUpdate'])
        ->name('admin.companion.statusVerificationUpdate');
        Route::put('acompanhante/courtesyUpdate/{companion}', [CompanionController::class, 'courtesyUpdate'])
        ->name('admin.companion.courtesyUpdate');
        Route::put('acompanhante/assinatura/update/{subscribed}', [SubscribedController::class, 'update'])
        ->name('admin.subscribed.update');

        Route::put('acompanhantes/update/topLove/{companion}', [CompanionController::class, 'topLoveUpdate'])
        ->name('admin.companion.update.topLove');
        Route::put('acompanhantes/updateActive/{companion}', [CompanionController::class, 'activeCompanionUpdate'])
        ->name('admin.companion.update.activeCompanionUpdate');

        Route::get('aprovacao-de-galeria', [SolicitationforGallery::class, 'index'])
        ->name('admin.dashboard.galleryApprovalRequest');
        Route::put('aprovacao-de-galeria/aprovado/{id}', [SolicitationforGallery::class, 'approve'])
        ->name('admin.dashboard.aprove');
        Route::put('aprovacao-de-galeria/reprovado/{id}', [SolicitationforGallery::class, 'reject'])
        ->name('admin.dashboard.reprove');

        //CONFIGURACAO PAGARME
        Route::resource('configuracao-pagarme', CredentialPagarmeController::class)
        ->names('admin.dashboard.configPayment')
        ->parameters(['configuracao-pagarme'=>'credentialPagarme']);

        // LOGOUT
        Route::get('logout', [AuthController::class, 'logout'])->name('admin.dashboard.user.logout');
    });
});

//Middleware do chat
Route::middleware(['auth:cliente, acompanhante'])->group(function () {
    Route::get('/chat', [ChatController::class, 'listConversations'])
        ->name('admin.dashboard.client.chat.index');

    Route::post('chat/acompanhante/bloquear-cliente/{blocked_id}/{blocker_id}', [ChatController::class, 'blockClient'])
        ->name('admin.dashboard.chat.blocked-client');

    Route::post('chat/cliente/bloquear-acompanhante/{blocked_id}/{blocker_id}', [ChatController::class, 'blockCompanion'])
        ->name('admin.dashboard.chat.blocked-companion');

    Route::delete('chat/desbloqueio-de-usuario/{userblock}', [ChatController::class, 'desblockUser'])
    ->name('admin.dashboard.chat.desblockUser');
    
});


View::composer('admin.dashboard', function ($view) {
    $companions = Companion::active()
    ->withCount([
        'subscribeds as pending_count' => function ($query) {
            $query->where('status', 'pending')->with('plan');
        },
        'subscribeds as paid_count' => function ($query) {
            $query->where('status', 'paid')->with('plan');
        },
    ])  
    ->get();

    $allCompanions = $companions->count();
    $pendingCompanions = $companions->where('pending_count', '>', 0)->count();

    $companionsCount = Companion::selectRaw('companion_status_verification, COUNT(*) as total')
        ->whereIn('companion_status_verification', ['pending', 'approved', 'rejected'])
        ->groupBy('companion_status_verification')
        ->pluck('total', 'companion_status_verification');
    $companionsApprovedCount = $companionsCount['approved'] ?? 0;

    $now = Carbon::now();
    $oneWeekAgo = $now->copy()->subWeek();//Cria uma cópia exata do $now e subtrai 7 dias da data copiada
    
    $newsCompanions = Companion::whereHas('subscribeds', function($query) use ($oneWeekAgo, $now) {
        $query->whereBetween('last_pagarme_webhook_at', [$oneWeekAgo, $now]);
    })
    ->with([
        'subscribeds' => function($query) use ($oneWeekAgo, $now) {
            $query->whereBetween('last_pagarme_webhook_at', [$oneWeekAgo, $now])
            ->with('plan'); 
        }
    ])
    ->active()
    ->get();

    return $view->with('pendingCompanions', $pendingCompanions)
    ->with('allCompanions', $allCompanions)
    ->with('newsCompanions', $newsCompanions)
    ->with('companionsApprovedCount', $companionsApprovedCount);
});

