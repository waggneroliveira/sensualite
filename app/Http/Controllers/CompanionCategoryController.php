<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CompanionCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Helpers\HelperArchive;

class CompanionCategoryController extends Controller
{
    protected $pathUpload = 'admin/uploads/images/categoria/';
    public function index()
    {
        if(!Auth::user()->hasRole('Super') && !Auth::user()->can('usuario.tornar usuario master') && !Auth::user()->can('categoria.visualizar')){
            return abort(403, 'Acesso não autorizado.');
        }
        $categories = CompanionCategory::sorting()->get();

        return view('admin.blades.category.index', compact('categories'));
    }

    public function store(Request $request)
    {

        $data = $request->except('path_image');
        $helper = new HelperArchive();

        $request->validate([
            'path_image' => ['nullable', 'file', 'image', 'max:2048', 'mimes:jpg,jpeg,png,gif'],
        ]);
    
        $path_image = $request->hasFile('path_image') 
            ? $helper->renameArchiveUpload($request, 'path_image') 
            : null;

        $data['active'] = $request->active?1:0;
        $data['slug'] = Str::slug($request->title);

        try {
            DB::beginTransaction();
                if ($path_image) {
                    $data['path_image'] = $this->pathUpload . $path_image;
                    $request->file('path_image')->storeAs($this->pathUpload, $path_image);
                }
                CompanionCategory::create($data);
            DB::commit();
            Session::flash('success', 'Item cadastrado com sucesso!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar item!');
            return redirect()->back();
        }
    }

    public function update(Request $request, CompanionCategory $companionCategory)
    {
        $data = $request->except('path_image');
        $helper = new HelperArchive();
    
        // Validação do arquivo
        $request->validate([
            'path_image' => ['nullable', 'file', 'image', 'max:2048', 'mimes:jpg,jpeg,png,gif'],
        ]);
        
        // Renomeação do arquivo se houver
        $path_image = null;
        if ($request->hasFile('path_image')) {
            $path_image = $helper->renameArchiveUpload($request, 'path_image');
        }
    
        // Definição do estado ativo
        $data['active'] = $request->has('active') ? 1 : 0;
    
        // Geração do slug
        $data['slug'] = Str::slug($request->title);
    
        try {
            DB::beginTransaction();
    
            // Armazenamento do arquivo, se houver
            if ($path_image) {
                $data['path_image'] = $this->pathUpload . $path_image;
                $request->file('path_image')->storeAs($this->pathUpload, $path_image);
            }
    
            // Atualização do item
            $companionCategory->fill($data)->save();
    
            DB::commit();
            Session::flash('success', 'Item atualizado com sucesso!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
    
            // Log do erro para depuração
            Log::error('Erro ao atualizar CompanionCategory: ' . $e->getMessage());
    
            Session::flash('error', 'Erro ao atualizar item!');
            return redirect()->back();
        }
    }
    

    public function destroy(CompanionCategory $companionCategory)
    {
        Storage::delete(isset($user->path_image) ? $user->path_image : '');
        $companionCategory->delete();
        Session::flash('success', 'Item deletado com sucesso!');
        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {
        if (!Auth::user()->hasRole('Super') && !Auth::user()->can('usuario.tornar usuario master') && !Auth::user()->can(['usuario.visualizar', 'usuario.remover'])) {
            return view('admin.error.403');
        }
    
        foreach ($request->deleteAll as $companionCategoryId) {
            $companionCategory = CompanionCategory::find($companionCategoryId);
    
            if ($companionCategory) {
    
                activity()
                    ->causedBy(Auth::guard('web')->user())
                    ->performedOn($companionCategory)
                    ->event('multiple_deleted')
                    ->withProperties([
                        'attributes' => [
                            'id' => $companionCategoryId,
                            'title' => $companionCategory->name,
                            'slug' => $companionCategory->email,
                            'active' => $companionCategory->active,
                            'sorting' => $companionCategory->sorting,
                            'event' => 'multiple_deleted',
                        ]
                    ])
                    ->log('multiple_deleted');
            } else {
                \Log::warning("Item com ID $companionCategoryId não encontrado.");
            }
        }
    
        $deleted = companionCategory::whereIn('id', $request->deleteAll)->delete();
    
        if ($deleted) {
            return Response::json(['status' => 'success', 'message' => $deleted . ' '. 'Itens deletados.']);
        }
    
        return Response::json(['status' => 'error', 'message' => 'Nenhum item foi deletado.'], 500);
    }
    
    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id) {
            $companionCategory = CompanionCategory::find($id);
    
            if($companionCategory) {
                $companionCategory->sorting = $sorting;
                $companionCategory->save();

                activity()
                    ->causedBy(Auth::guard('web')->user())
                    ->performedOn($companionCategory)
                    ->event('order_updated')
                    ->withProperties([
                        'attributes' => [
                            'id' => $id,
                            'title' => $companionCategory->name,
                            'slug' => $companionCategory->email,
                            'active' => $companionCategory->active,
                            'sorting' => $companionCategory->sorting,
                            'event' => 'order_updated',
                        ]
                    ])
                    ->log('order_updated');
            } else {
                \Log::warning("Item com ID $id não encontrado.");
            }
        }
    
        return Response::json(['status' => 'success']);
    }
}
