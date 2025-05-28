<?php

namespace App\Http\Controllers;

use Log;
use App\Mail\SendCode;

use App\Models\Companion;
use Illuminate\Support\Str;
use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;
use App\Models\CompanionCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Services\SubscriptionStatusService;
use App\Http\Controllers\Helpers\HelperArchive;

class CompanionController extends Controller
{
    protected $pathUpload = 'admin/uploads/images/acompanhante/';

    public function indexAdmin(Request $request){
        if(!Auth::user()->hasRole('Super') && !Auth::user()->can('usuario.tornar usuario master') && !Auth::user()->can('acompanhantes.visualizar')){
            return abort(403, 'Acesso não autorizado.');
        }
        $name = $request->name;
        $paymentStatus = $request->payment_status;
        $interviewPending = $request->companion_status_verification;
        $active = $request->active;
        $courtesy = $request->courtesy;
        $inactive = $request->inactive;
        $hasSubscription = $request->has_subscription;
        $noSubscription = $request->no_subscription;

        $companions = Companion::with(['subscribeds.plan']); // assumindo que subscribed tem relação com plan
        if ($name) {
            $companions = $companions->where('name', 'like', '%' . $name . '%');
        }
        
        if ($paymentStatus) {
            $companions = $companions->whereHas('subscribeds', function ($query) use ($paymentStatus) {
                $query->where('status', $paymentStatus);
            });
        }
        
        if ($active) {
            $companions = $companions->where('active', 1);
        }
        
        if ($courtesy) {
            $companions = $companions->where('is_courtesy', 1);
        }

        if ($interviewPending) {            
            $companions = $companions->where('companion_status_verification', $interviewPending);
        }
        
        if ($inactive) {
            $companions = $companions->where('active', 0);
        }
        
        if ($hasSubscription) {
            $companions = $companions->whereHas('subscribeds');
        }
        
        if ($noSubscription) {
            $companions = $companions->whereDoesntHave('subscribeds');
        }
        
        if ($noSubscription) {
            $companions = $companions->whereDoesntHave('subscribeds');
        }
        
        $companions = $companions->orderBy('name', 'asc')->get();
        $companionsCount = Companion::selectRaw('companion_status_verification, COUNT(*) as total')
        ->whereIn('companion_status_verification', ['pending', 'approved', 'rejected'])
        ->groupBy('companion_status_verification')
        ->pluck('total', 'companion_status_verification');

        $companionsPendingCount = $companionsCount['pending'] ?? 0;
        $companionsReprovedCount = $companionsCount['rejected'] ?? 0;
        $companionsApprovedCount = $companionsCount['approved'] ?? 0;


        return view('admin.blades.companion.index', compact('companions', 'companionsPendingCount', 'companionsReprovedCount', 'companionsApprovedCount'));
    }

    public function profile(){
        //Verifica assinatura antes de acessar a pagina
        $hasActiveSubscription = (new SubscriptionStatusService())->getExpiredSubscriptions(); 
        $isCourtesy = Auth::guard('acompanhante')->user()->is_courtesy;

        if (!$hasActiveSubscription && $isCourtesy == 0) {
            return abort(403, 'Sua assinatura está pendente. Atualize sua conta para continuar aproveitando nossos serviços. Caso já tenha realizado o pagamento, desconsidere esta mensagem. Assim que confirmado, seu acesso será restabelecido.');
        }
        return view('admin.blades.companion.profile.index');
    }
    
    public function index()
    {
        //Verifica assinatura antes de acessar a pagina
        $hasActiveSubscription = (new SubscriptionStatusService())->getExpiredSubscriptions(); 
        $isCourtesy = Auth::guard('acompanhante')->user()->is_courtesy;
               
        if (!$hasActiveSubscription && $isCourtesy == 0) {
            return abort(403, 'Sua assinatura está pendente. Atualize sua conta para continuar aproveitando nossos serviços. Caso já tenha realizado o pagamento, desconsidere esta mensagem. Assim que confirmado, seu acesso será restabelecido.');
        }

        $auth = Auth::guard('acompanhante')->user()->id;

        $companion = Companion::where('id', $auth)->where(function($query) {
            $query->whereHas('subscribeds', function($status) {
                $status->where('status', 'paid');
            })->orWhere('is_courtesy', 1);
        })->active()->with(['subscribeds' => function($status) {
            $status->where('status', 'paid');
        }])->first();
        
        $categories =  CompanionCategory::active()->get();
   
        return view('admin.blades.companion.profile.index', compact('companion', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['active'] = 0;
        $data['password'] = Hash::make('password');
        $data['slug'] = Str::slug($request->name);
        try {
            DB::beginTransaction();
                Companion::create($data);
            DB::commit();
            return redirect()->route('client.confirmation');
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function update(Request $request, Companion $companion)
    {
        $data = $request->except(['path_file_profile', 'path_file_horizontal_cover', 'path_file_vertical_cover']);
        $categories = $request->companion_category_id;
        $helper = new HelperArchive();

        $request->validate([
            'path_file_profile' => ['sometimes', 'nullable', 'file', 'image', 'max:2048', 'mimes:jpg,jpeg,png,gif'],
            'path_file_horizontal_cover' => ['sometimes', 'nullable', 'file', 'image', 'max:2048', 'mimes:jpg,jpeg,png,gif'],
            'path_file_vertical_cover' => ['sometimes', 'nullable', 'file', 'image', 'max:2048', 'mimes:jpg,jpeg,png,gif'],
        ]);
        
        $path_file_profile = $request->hasFile('path_file_profile') 
            ? $helper->renameArchiveUpload($request, 'path_file_profile') 
            : null;
        $path_file_horizontal_cover = $request->hasFile('path_file_horizontal_cover') 
            ? $helper->renameArchiveUpload($request, 'path_file_horizontal_cover') 
            : null;
        $path_file_vertical_cover = $request->hasFile('path_file_vertical_cover') 
            ? $helper->renameArchiveUpload($request, 'path_file_vertical_cover') 
            : null;
        
        try {
            DB::beginTransaction();
        
            if ($path_file_profile) {
                $data['path_file_profile'] = $this->pathUpload . $path_file_profile;
                $request->file('path_file_profile')->storeAs($this->pathUpload, $path_file_profile);
            }
            if ($path_file_horizontal_cover) {
                $data['path_file_horizontal_cover'] = $this->pathUpload . $path_file_horizontal_cover;
                $request->file('path_file_horizontal_cover')->storeAs($this->pathUpload, $path_file_horizontal_cover);
            }
            if ($path_file_vertical_cover) {
                $data['path_file_vertical_cover'] = $this->pathUpload . $path_file_vertical_cover;
                $request->file('path_file_vertical_cover')->storeAs($this->pathUpload, $path_file_vertical_cover);
            }

            if ($request->has('is_courtesy')) {
                $data['is_courtesy'] = in_array($request->is_courtesy, [1, '1', true, 'on'], true) ? 1 : 0;
            } else {
                unset($data['is_courtesy']); 
            }

            if ($request->has('top_love')) {
                $data['top_love'] = in_array($request->top_love, [1, '1', true, 'on'], true) ? 1 : 0;
            } else {
                unset($data['top_love']); 
            }

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            } else {
                unset($data['password']); 
            }
            
            if (!$request->filled('active')) {
                unset($data['active']); 
            }
            if (!$request->filled('companion_category_id')) {
                unset($data['companion_category_id']); 
            }
            
            $data['available_for_travel'] = $request->available_for_travel?1:0;
            $data['slug'] = Str::slug($companion->name);

            $companion->fill($data)->save();
            $companion->categories()->sync($categories);

            DB::commit();
        
            session()->flash('success', 'Item atualizado com sucesso!');
            if(Route::currentRouteName() === 'admin.companion.search'){
                return redirect()->route('admin.companion.index');
                
            }else{
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Erro ao atualizar acompanhante: ' . $e->getMessage());
        
            session()->flash('error', 'Erro ao atualizar item!');
            return redirect()->back();
        }
    }
    public function statusVerificationUpdate(Request $request, Companion $companion){
        try {
            DB::beginTransaction();

            $statusVerificationUpdate = $request->companion_status_verification;
            $data['companion_status_verification'] = $statusVerificationUpdate;

            if ($statusVerificationUpdate === 'approved') {
                $passwordRandon = Str::random(16);
                $data['password'] = Hash::make($passwordRandon);
            }

            $companion->fill($data)->save();

            DB::commit();

            session()->flash('success', 'Item atualizado com sucesso!');

            if (Route::currentRouteName() === 'admin.companion.statusVerificationUpdate' &&
                $statusVerificationUpdate === 'approved') {
                try {
                    if (filter_var($companion->email, FILTER_VALIDATE_EMAIL)) {
                        Mail::to($companion->email)->send(new SendCode($companion, $passwordRandon));
                        Session::flash('success', 'Perfil aprovado com sucesso e dados de acesso da acompanhante enviados!');
                    } else {
                        Session::flash('error', 'E-mail da acompanhante inválido!');
                    }
                } catch (\Exception $e) {
                    Log::error('Erro ao enviar e-mail: ' . $e->getMessage());
                    Session::flash('error', 'Erro ao enviar os dados de acesso da acompanhante!');
                }

                return redirect()->route('admin.companion.index');
            }

            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Erro ao atualizar acompanhante: ' . $e->getMessage());

            session()->flash('error', 'Erro ao atualizar item!');
            return redirect()->back();
        }


    }
    public function courtesyUpdate(Request $request, Companion $companion){
        $is_courtesy = $request->input('is_courtesy', 0);
        $data['is_courtesy'] = $is_courtesy;

        try {
            DB::beginTransaction();
                $companion->fill($data)->save();
            DB::commit();            

            session()->flash('success', 'Item atualizado com sucesso!');

            if(Route::currentRouteName() === 'admin.companion.courtesyUpdate'){
                return redirect()->route('admin.companion.index');                
            }else{
                return redirect()->back();
            }
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            \Log::error('Erro ao atualizar acompanhante: ' . $e->getMessage());
        
            session()->flash('error', 'Erro ao atualizar item!');
            return redirect()->back();
        }

    }
    public function topLoveUpdate(Request $request, Companion $companion){
        $top_love = $request->input('top_love', 0);
        $data['top_love'] = $top_love;
        
        try {
            DB::beginTransaction();
                $companion->fill($data)->save();
            DB::commit();            
            
            session()->flash('success', 'Item atualizado com sucesso!');
            if(Route::currentRouteName() === 'admin.companion.update.topLove'){
                return redirect()->route('admin.companion.index');
                
            }else{
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Erro ao atualizar acompanhante: ' . $e->getMessage());
        
            session()->flash('error', 'Erro ao atualizar item!');
            return redirect()->back();
        }

    }
    public function activeCompanionUpdate(Request $request, Companion $companion){
        $active = $request->active;
        $data['active'] = $active;
        try {
            DB::beginTransaction();
                $companion->fill($data)->save();
            DB::commit();            

            session()->flash('success', 'Item atualizado com sucesso!');
            if(Route::currentRouteName() === 'admin.companion.update.activeCompanionUpdate'){
                return redirect()->route('admin.companion.index');
                
            }else{
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Erro ao atualizar acompanhante: ' . $e->getMessage());
        
            session()->flash('error', 'Erro ao atualizar item!');
            return redirect()->back();
        }

    }
    public function destroy(Companion $companion)
    {
        //
    }
}
