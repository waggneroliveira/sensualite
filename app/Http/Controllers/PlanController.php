<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PlanController extends Controller
{

    public function indexCompanion(){
        $plans = Plan::with('subscribeds')->active()->get();
        
        return view('admin.blades.plan.index', compact('plans'));
    }


    public function index()
    {
        if(!Auth::user()->hasRole('Super') && !Auth::user()->can('usuario.tornar usuario master') && !Auth::user()->can('assinatura.visualizar')){
            return abort(403, 'Acesso não autorizado.');
        }
        $plans = Plan::with('subscribeds')->get();

        return view('admin.blades.plan.index-admin', compact('plans'));
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $price = $request->price;
        $discount = $request->discount;

        $newPrice = str_replace(['.', ','], ['', '.'], $price);
        $newDiscount = str_replace(['.', ','], ['', '.'], $discount);

        $data['price'] = (float) $newPrice;
        $data['discount'] = (float) $newDiscount;

        try {
            DB::beginTransaction();
                $data['status'] = $request->active?1:0;
                Plan::create($data);
            DB::commit();
            Session::flash('success', 'Item cadastrado com successo!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('success', 'Erro ao cadastrar item!');
            return redirect()->back();
        }
    }

    public function update(Request $request, Plan $plan)
    {
        $data = $request->all();
        $price = $request->price;
        $discount = $request->discount;
        $status = $request->status;

        // Verifica se o preço já está no formato numérico correto
        if (!is_numeric(str_replace(',', '.', $price))) {
            $newPrice = str_replace(['.', ','], ['', '.'], $price);
            $data['price'] = (float) $newPrice;
        } else {
            $data['price'] = (float) $price;
        }

        $newDiscount = str_replace(['.', ','], ['', '.'], $discount);
        
        if($status == 'on'){
            $data['status'] = 1;
        }else{
            $data['status'] = 0;
        }

        $data['discount'] = (float) $newDiscount;

        try {
            DB::beginTransaction();
                $plan->fill($data)->save();
            DB::commit();
            Session::flash('success', 'Item atualizado com successo!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('success', 'Erro ao atualizar item!');
            return redirect()->back();
        }
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        Session::flash('success', 'Item deletado com sucesso!');
        return redirect()->back();
    }
}
