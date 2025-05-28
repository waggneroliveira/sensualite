<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AuditActivity extends Model
{
    use HasFactory;

    public static function getModelName($subjectType)
    {
        switch ($subjectType) { 
           
            case AnnouncementCategory::class:
                return 'Categorias de Anuncios';
            case Gallery::class:
                return 'Ensaio Fotográfico';
            case GalleryFile::class:
                return 'Arquivo de Ensaio Fotográfico';
            case Client::class:
                return 'Clientes';
            case Companion::class:
                return 'Acompanhantes';
            case Notification::class:
                return 'Notificações';
            case Package::class:
                return 'Pacotes';
            case Permission::class:
                return 'Permissões';
            case Plan::class:
                return 'planos';
            case Role::class:
                return 'Grupos';
            case User::class:
                return 'Usuários';
            default:
                return 'Sistema';

        }
    }
}
