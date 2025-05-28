<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Permission;
class RoleController extends Controller
{
    public function index()
    {

        if(!Auth::user()->hasRole('Super') && !Auth::user()->can('usuario.tornar usuario master') && !Auth::user()->can('grupo.visualizar')){
            return abort(403, 'Acesso não autorizado.');
        }

        $roles = Role::get();

        $permissions = Permission::get(); 

        return view('admin.blades.group.index', [
            'roles'=>$roles,
            'permissions'=>$permissions
        ]);
    }
    public function store(Request $request)
    {   
        $data = $request->all();

        try {
            DB::beginTransaction();
                $role = Role::create($data);
                $role->syncPermissions($request->permissions);
                Session::flash('success', 'Item cadastrad com sucesso!');
            DB::commit();
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar item!');
            return redirect()->back();
        }

    }

    public function update(Request $request,Role $role)
    {
        try{
            DB::beginTransaction();
            $role->update([
                'name'=>$request->name,
            ]);
            $role->syncPermissions($request->permissions);

            DB::commit();
            Session::flash('success', 'Item deletado com sucesso!');
            return redirect()->back();
        }catch (\Exception $exception){
            DB::rollBack();
            Session::flash('success', 'Erro ao atualizar item!');
            return redirect()->back();
        }
    }

    public function destroy(Request $request, Role $role)
    {
        // if(!Auth::user()->hasRole('Super') && !Auth::user()->can('usuario.tornar usuario master') && !Auth::user()->can(['grupo.visualizar','grupo.remover'])){
        //     return view('admin.error.403');
        // } 

        $role->delete();
        Session::flash('success', 'Item deletado com sucesso!');
        return redirect()->back();
    }
}
