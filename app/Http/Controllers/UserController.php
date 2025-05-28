<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SettingTheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; 
use App\Http\Requests\RequestStoreUser;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRoleRepository;
use Illuminate\Support\Facades\Response;
use Spatie\Permission\Models\Permission;
use Illuminate\Console\View\Components\Alert;
use App\Repositories\UserPermissionRepository;
use App\Http\Controllers\Helpers\HelperArchive;

class UserController extends Controller
{
    protected $pathUpload = 'admin/uploads/images/usuario/';


    public function index(UserPermissionRepository $userPermissionRepository)
    {
        if (!Auth::user()->hasRole('Super') && !Auth::user()->can('usuario.tornar usuario master') && !Auth::user()->can('usuario.visualizar')) {
            return abort(403, 'Acesso não autorizado.');

        }
        $users = User::query();
        $filteredUsers = $userPermissionRepository->filterUsersByPermissions($users);

        $users = $filteredUsers->sorting()->get();
        $roles = (new UserRoleRepository())->userRole($users);
        $otherRoles = $roles['otherRoles'] ?? collect();
        $currentRoles = $roles['currentRoles'] ?? collect();
            
        $permissions = Permission::join('role_has_permissions', 'permissions.id', 'role_has_permissions.permission_id')
        ->groupBy('permissions.name')
        ->select('permissions.name')
        ->get();
        
        return view('admin.blades.user.index', compact('users','otherRoles','permissions','currentRoles'));
    }

    public function store(RequestStoreUser $request)
    {   
        $data = $request->except('path_image');
        $helper = new HelperArchive();

        $request->validate([
            'path_image' => ['nullable', 'file', 'image', 'max:2048', 'mimes:jpg,jpeg,png,gif'],
        ]);
    
        $path_image = null;
        if ($request->hasFile('path_image')) {
            $path_image = $helper->renameArchiveUpload($request, 'path_image');
        }

        try {
            DB::beginTransaction();

            if ($path_image) {
                $data['path_image'] = $this->pathUpload . $path_image;
            }
            $data['password'] = Hash::make($request->password);
            $data['active'] = $request->active ? 1 : 0;
            
            $userExist = User::where('email', $data['email'])->first();
            
            if ($userExist) {
                Storage::delete($this->pathUpload . $path_image);

                return redirect()->back();
            } else {
                User::create($data);

                if ($path_image) {
                    $request->file('path_image')->storeAs($this->pathUpload, $path_image);
                }
                DB::commit();
                session()->flash('success', 'Item criado com sucesso!');
                return redirect()->route('admin.dashboard.user.index');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            // Alert::success('error', 'Erro ao cadastrar item!');
            return redirect()->back();
        }
    }

    public function edit(UserPermissionRepository $usersWithPermissionsForEdit, User $user)
    {
        $userHasPermission = $usersWithPermissionsForEdit->usersWithPermissionsForEdit($user);

        if ($userHasPermission === 'forbidden') {
            return view('admin.error.403');
        }

        $currentRoles = $user->roles;
        $otherRoles = Role::where('id', '!=', 1)->whereNotIn('id', $currentRoles->pluck('id'))->get();

        return view('admin.blades.user.edit', [
            'user' => $user,
            'currentRoles' => $currentRoles,
            'otherRoles' => $otherRoles,
        ]);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->except('password','path_image');
        $helper = new HelperArchive();
        $roles = $request->input('roles', []);

        $request->validate([
            'path_image' => ['nullable', 'file', 'image', 'max:2048', 'mimes:jpg,jpeg,png,gif'],
        ]);
    
        $path_image = null;
        if ($request->hasFile('path_image')) {
            $path_image = $helper->renameArchiveUpload($request, 'path_image');
        }
    
        if (Auth::user()->hasRole('Super') && $user->id == 1) {
            $roles[] = 'Super';
        }

        try {
            DB::beginTransaction();

            if ($path_image) {
                $data['path_image'] = $this->pathUpload . $path_image;
                if ($user->path_image) { 
                    Storage::delete($user->path_image);
                }
                $request->file('path_image')->storeAs($this->pathUpload, $path_image);
            }

            if (isset($request->delete_path_image) && !$path_image) {
                if ($user->path_image) {
                    Storage::delete($user->path_image);
                }
                $data['path_image'] = null;
            }

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            } else {
                unset($data['password']);
            }

            $data['active'] = $request->active ? 1 : 0;

            $user->fill($data)->save();
            $user->syncRoles($roles);

            DB::commit();

            session()->flash('success', 'Item atualizado com sucesso!');
            return redirect()->route('admin.dashboard.user.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            // Alert::error('Erro', 'Erro ao atualizar item!');
            return redirect()->back();
        }
    }

    public function destroy(User $user)
    {
        if(!Auth::user()->hasRole('Super') && !Auth::user()->can('usuario.tornar usuario master') && !Auth::user()->can(['usuario.visualizar','usuario.remover'])){
            return view('admin.error.403');
        }
        Storage::delete(isset($user->path_image) ? $user->path_image : '');
        $user->delete();

        Session::flash('success', 'Item deletado com sucesso!');
        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {
        if (!Auth::user()->hasRole('Super') && !Auth::user()->can('usuario.tornar usuario master') && !Auth::user()->can(['usuario.visualizar', 'usuario.remover'])) {
            return view('admin.error.403');
        }
    
        foreach ($request->deleteAll as $userId) {
            $user = User::find($userId);
    
            if ($user) {
                // Log para verificar os dados do usuário
                \Log::info('Dados do usuário antes da exclusão:', [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'active' => $user->active,
                    'sorting' => $user->sorting,
                    'path_image' => $user->path_image,
                ]);
    
                activity()
                    ->causedBy(Auth::user())
                    ->performedOn($user)
                    ->event('multiple_deleted')
                    ->withProperties([
                        'attributes' => [
                            'id' => $userId,
                            'name' => $user->name,
                            'email' => $user->email,
                            'active' => $user->active,
                            'path_image' => $user->path_image,
                            'sorting' => $user->sorting,
                            'event' => 'multiple_deleted',
                        ]
                    ])
                    ->log('multiple_deleted');
            } else {
                \Log::warning("Item com ID $userId não encontrado.");
            }
        }
    
        $deleted = User::whereIn('id', $request->deleteAll)->delete();
    
        if ($deleted) {
            return Response::json(['status' => 'success', 'message' => $deleted . ' '. 'Itens deletados.']);
        }
    
        return Response::json(['status' => 'error', 'message' => 'Nenhum item foi deletado.'], 500);
    }
    
    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id) {
            $user = User::find($id);
    
            if($user) {
                $user->sorting = $sorting;
                $user->save();

                activity()
                    ->causedBy(Auth::user())
                    ->performedOn($user)
                    ->event('order_updated')
                    ->withProperties([
                        'attributes' => [
                            'id' => $id,
                            'name' => $user->name,
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
