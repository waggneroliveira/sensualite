<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserPermissionRepository
{
    public function filterUsersByPermissions($users)
    {
        $user = Auth::user();

        // Verificação de permissão de acesso
        if (!$user->hasRole('Super') && !$user->can('usuario.tornar usuario master') && !$user->can('usuario.visualizar')) {
            return 'forbidden';
        }

        // Filtragem dos usuários conforme as permissões do usuário autenticado
        if ($user->can(['usuario.visualizar', 'usuario.visualizar outros usuarios'])) {
            $users = $users->where('id', '<>', 1);
        } elseif ($user->can('usuario.visualizar') && !$user->can('usuario.visualizar outros usuarios')) {
            $users = $users->where('id', '<>', 1)
                           ->where('id', $user->id);
        } elseif ($user->hasRole('Super') || $user->can('usuario.tornar usuario master')) {
            $users = $users->where('id', '<>', 1);
        }

        return $users;
    }

    public function usersWithPermissionsForEdit(){

        if(!Auth::user()->hasRole('Super') && !Auth::user()->can('usuario.tornar usuario master') && !Auth::user()->can(['usuario.visualizar','usuario.editar'])){
            return 'forbidden';
        }
    }
}
