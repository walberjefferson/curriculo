<?php

namespace Authentication\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Authentication\Facade\PermissionReader;

class AuthorizationResource
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws AuthorizationException
     */
    public function handle(Request $request, Closure $next)
    {
        $currentAction = \Route::currentRouteAction();
        list($controller, $action) = explode('@', $currentAction);
        $permission = PermissionReader::getPermission($controller, $action);
        if (count($permission)) {
            $permission = $permission[0];
            if (!\Gate::allows("{$permission['name']}/{$permission['resource_name']}")) {
                throw new AuthorizationException('Usuário não autorizado', 403);
            }
        }
        return $next($request);
    }
}
