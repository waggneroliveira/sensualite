<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

class PackageController extends Controller
{

    public function index()
    {
        if(!Auth::user()->hasRole('Super') && !Auth::user()->can('usuario.tornar usuario master') && !Auth::user()->can('pacote.visualizar')){
            return abort(403, 'Acesso não autorizado.');
        }
        $packages = Package::sorting()->get();

        return view('admin.blades.package.index', compact('packages'));
    }

    public function store(Request $request)
    {
        $data = $request->except(['price', 'discount']);
        $price = $request->price;
        $discount = $request->discount;

        $newPrice = str_replace(['.', ','], ['', '.'], $price);
        $newDiscount = str_replace(['.', ','], ['', '.'], $discount);

        $data['price'] = (float) $newPrice;
        $data['discount'] = (float) $newDiscount;

        try {
            DB::beginTransaction();
                Package::create($data);
            DB::commit();
            Session::flash('success','Item cadastrado com sucesso!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error','Erro ao cadastrar item!');
            return redirect()->back();
        }
    }

    public function update(Request $request, Package $package)
    {
        $data = $request->except(['price', 'discount']);
        $price = $request->price;
        $discount = $request->discount;

        $newPrice = str_replace(['.', ','], ['', '.'], $price);
        $newDiscount = str_replace(['.', ','], ['', '.'], $discount);

        $data['price'] = (float) $newPrice;
        $data['discount'] = (float) $newDiscount;

        try {
            DB::beginTransaction();
                $package->fill($data)->save();
            DB::commit();
            Session::flash('success','Item atualizado com sucesso!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('erro','Erro ao atualizar item!');
            return redirect()->back();
        }
    }

    public function destroy(Package $package)
    {
        if(!Auth::user()->hasRole('Super') && !Auth::user()->can('usuario.tornar usuario master') && !Auth::user()->can(['usuario.visualizar','usuario.remover'])){
            return view('admin.error.403');
        }

        $package->delete();
        Session::flash('sucesso','Item deletado com sucesso!');
        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {
        if (!Auth::user()->hasRole('Super') && !Auth::user()->can('usuario.tornar usuario master') && !Auth::user()->can(['usuario.visualizar', 'usuario.remover'])) {
            return view('admin.error.403');
        }
    
        foreach ($request->deleteAll as $packageId) {
            $package = Package::find($packageId);
    
            if ($package) {
                // Log para verificar os dados do usuário
                \Log::info('Dados do usuário antes da exclusão:', [
                    'id' => $package->id,
                    'title' => $package->name,
                    'description' => $package->email,
                    'price' => $package->active,
                    'discount' => $package->sorting,
                    'package' => $package->path_image,
                ]);
    
                activity()
                    ->causedBy(Auth::user())
                    ->performedOn($package)
                    ->event('multiple_deleted')
                    ->withProperties([
                        'attributes' => [
                            'id' => $packageId,
                            'title' => $package->title,
                            'description' => $package->description,
                            'price' => $package->price,
                            'discount' => $package->discount,
                            'package' => $package->package,
                            'sorting' => $package->sorting,
                            'event' => 'multiple_deleted',
                        ]
                    ])
                    ->log('multiple_deleted');
            } else {
                \Log::warning("Item com ID $packageId não encontrado.");
            }
        }
    
        $deleted = Package::whereIn('id', $request->deleteAll)->delete();
    
        if ($deleted) {
            return Response::json(['status' => 'success', 'message' => $deleted . ' '. 'Itens deletados com sucesso!']);
        }
    
        return Response::json(['status' => 'error', 'message' => 'Nenhum item foi deletado.'], 500);
    }
    
    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id) {
            $package = Package::find($id);

            if($package) {
                
                $package->sorting = $sorting;
                $package->save();

                \Log::info('Dados do package antes da ordenação:', [
                    'id' => $package->id,
                    'title' => $package->title,
                    'sorting' => $package->sorting,
                ]);
                
                activity()
                    ->causedBy(Auth::user())
                    ->performedOn($package)
                    ->event('order_updated')
                    ->withProperties([
                        'attributes' => [
                            'id' => $id,
                            'title' => $package->title,
                            'sorting' => $sorting,
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
