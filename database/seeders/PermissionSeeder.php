<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'auditoria'=>[
                'Visualizar',
            ],
            'acompanhantes'=>[
                'Visualizar',
                'Aprovar perfil',
                'Reprovar perfil',
                'Conceder cortesia',                
                'Mudar status de pagamento',
                'Ativar Desativar acompanhante', 
                'Adicionar Remover acompanhante do top love',
            ],
            'Pagarme'=>[
                'Editar',
                'Visualizar',
            ],
            'Ensaio'=>[
                'Aprovar',
                'Reprovar',
                'Visualizar',
                'Remover foto ou video de ensaio',
            ],
            'Anuncio'=>[
                'Criar',
                'Editar',                
                'Visualizar',
                'Remover'
            ],
            'Categoria'=>[
                'Criar',
                'Editar',                
                'Visualizar',
                'Remover'
            ],
            'Assinatura'=>[
                'Criar',
                'Editar',                
                'Visualizar',
                'Remover'
            ],
            'Pacote'=>[
                'Criar',
                'Editar',                
                'Visualizar',
                'Remover'
            ],
            'grupo'=>[
                'Criar',
                'Editar',                
                'Visualizar',
                'Remover'
            ],
            'notificacao'=>[               
                'Visualizar',
                'Notificacao de auditoria',
            ],
            'usuario'=>[
                'Criar',
                'Editar',
                'Visualizar',
                'Remover',
                'Visualizar outros usuarios',
                'Atribuir grupos',
                'Tornar usuario master'
            ],
        ];
        
        foreach($permissions as $key => $permission){
            foreach($permission as $value){
                $perm = Permission::create([
                    'name'=>strtolower("{$key}.{$value}")
                ]);

                activity('permission')
                ->event('created')
                ->withProperties([
                    'attributes' => [
                        'name' => $perm->name,
                        'guard_name' => 'web'
                    ],
                ])                
                ->performedOn($perm)
                ->log("created");
            }
        }
    }
}
