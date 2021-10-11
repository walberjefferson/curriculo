<?php

namespace Authentication\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

/**
 * @Authentication\Annotations\Mapping\ControllerAnnotation(name="admin-comandos", description="Administração de Comandos")
 */
class CommandsController extends Controller
{

    /**
     * @Authentication\Annotations\Mapping\ActionAnnotation(name="refresh_permissions", description="Recarregar Permissões")
     */
    public function refresh_permissions()
    {
        if(request()->expectsJson()) {
            Artisan::call('authentication:make-permission');
            return response()->json('', 204);
        }
        return response()->json('Requisição inválida', 500);
    }
}
