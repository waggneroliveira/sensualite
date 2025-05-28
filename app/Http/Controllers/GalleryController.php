<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Services\SubscriptionStatusService;

class GalleryController extends Controller
{

    public function index($galery = null)
    {
        //Verifica assinatura antes de acessar a pagina
        $hasActiveSubscription = (new SubscriptionStatusService())->getExpiredSubscriptions();  
        $isCourtesy = Auth::guard('acompanhante')->user()->is_courtesy;
              
        if (!$hasActiveSubscription && $isCourtesy == 0) {
            return abort(403, 'Sua assinatura está pendente. Atualize sua conta para continuar aproveitando nossos serviços. Caso já tenha realizado o pagamento, desconsidere esta mensagem. Assim que confirmado, seu acesso será restabelecido.');
        }
        
        $authUser = Auth::guard('acompanhante')->user()->id;
        $galleries = Gallery::with('galleryFile')->where('companion_id', $authUser)->get();
    
        $gallery_id = null;
        $galleryContent = null;
    
        if ($galery) {
            session()->put('gallery_id', $galery);
            $gallery_id = session()->get('gallery_id');

            $galleryContent = Gallery::with('galleryFile')
            ->where('companion_id', $authUser)
            ->where('id', $gallery_id)
            ->first();
            $galleryTitle = $galleryContent->title;
        } else {
            $galleryContent = Gallery::with('galleryFile')
            ->where('companion_id', $authUser)
            ->whereHas('galleryFile')
            ->get();
            $galleryTitle = 'Todos os arquivos';
        }
    
        return view('admin.blades.gallery.index', compact('galleries', 'galleryContent', 'gallery_id', 'galleryTitle'));
    }
    


    public function store(Request $request)
    {
        $data = $request->all();
        $authUser = Auth::guard('acompanhante')->user()->id;

        try {
            DB::beginTransaction();
                $data['companion_id'] = $authUser;

                $gallery = Gallery::create($data);
            DB::commit();
            Session::flash('success', 'Item cadastrado com sucesso!');
            return redirect()->route('admin.dashboard.companion.galleryId', $gallery->id);
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('erro', 'Erro ao cadastrar item!');
            return redirect()->back();
        }
    }

    public function update(Request $request, Gallery $gallery)
    {
        $data = $request->all();
        $authUser = Auth::guard('acompanhante')->user()->id;

        try {
            DB::beginTransaction();                
                $data['companion_id'] = $authUser;
                $gallery->fill($data)->save();
            DB::commit();
            Session::flash('success', 'Item atualizado com sucesso!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('erro', 'Erro ao atualizar item!');
            return redirect()->back();
        }
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        Session::flash('success', 'Item deleteado com sucesso!');
        return redirect()->back();
    }

    public function requestApproval($galleryId)
    {
        $authUser = Auth::guard('acompanhante')->user()->id;

        $gallery = Gallery::where('id', $galleryId)->where('companion_id', $authUser)->firstOrFail();
        $gallery->status = 'pending';
        $gallery->requested_at = now();
        // dd($gallery, $authUser, $gallery->requested_at);
        $gallery->save();

        return back()->with('success', 'Solicitação de aprovação enviada com sucesso!');
    }

    public function approveGallery($galleryId)
    {
        $gallery = Gallery::findOrFail($galleryId);
        $gallery->status = 'approved';
        $gallery->approved_at = now();
        $gallery->save();

        // notificar acompanhante se desejar
    }

}
