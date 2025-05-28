<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Subscribed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Services\SubscriptionStatusService;

class PostController extends Controller
{
    public function index($post = null)
    {
        //Verifica assinatura antes de acessar a pagina
        $hasActiveSubscription = (new SubscriptionStatusService())->getExpiredSubscriptions();    
        $isCourtesy = Auth::guard('acompanhante')->user()->is_courtesy;    
        if (!$hasActiveSubscription && $isCourtesy == 0) {
            return abort(403, 'Sua assinatura está pendente. Atualize sua conta para continuar aproveitando nossos serviços. Caso já tenha realizado o pagamento, desconsidere esta mensagem. Assim que confirmado, seu acesso será restabelecido.');
        }

        $authUser = Auth::guard('acompanhante')->user()->id;
        $posts = Post::with('postFile')->where('companion_id', $authUser)->get();      

        $post_id = null;
        $postContent = null;
    
        if ($post) {
            session()->put('post_id', $post);
            $post_id = session()->get('post_id');

            $postContent = Post::with('postFile')
            ->where('companion_id', $authUser)
            ->where('id', $post_id)
            ->first();
            $postTitle = isset($postContent->text)?$postContent->text:'Post: '. $postContent->created_at->format('d/m/Y');
            $postId = $postContent->id;
        } else {
            $postContent = Post::with('postFile')
            ->where('companion_id', $authUser)
            ->whereHas('postFile')
            ->get();
            $postTitle = 'Todos os Posts';
            $postId = '';
        }
    
        return view('admin.blades.post.index', compact('posts', 'postContent', 'post_id', 'postTitle', 'postId'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['companion_id'] = Auth::guard('acompanhante')->user()->id;

        try {
            DB::beginTransaction();
                $post = Post::create($data);
            DB::commit();
            Session::flash('success', 'Item cadastrado com sucesso!');
            return redirect()->route('admin.dashboard.companion.postId', $post->id);
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('erro', 'Erro ao cadastrar item!');
            return redirect()->back();
        }
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->all();
        $data['companion_id'] = Auth::guard('acompanhante')->user()->id;
        // dd($data);
        try {
            DB::beginTransaction();
                $post->fill($data)->save();
            DB::commit();
            Session::flash('success', 'Item atualizado com sucesso!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('erro', 'Erro ao atualizar item!');
            return redirect()->back();
        }
    }

    public function destroy(Post $post)
    {
        $post->delete();
        Session::flash('success', 'Item deleteado com sucesso!');
        return redirect()->route('admin.dashboard.companion.post.index');
    }
}
