<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\GroupPrivilege;
use App\Models\Privilege;


class hasAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user_group = admin()->user()->users_group_id;
        $user_privi = GroupPrivilege::where('users_group_id', $user_group )->get();
        $route_list = [];
        foreach ($user_privi as $privi) {
          $privilege_route = Privilege::where('id', $privi->privilege_id )->get();
           foreach ($privilege_route as $route) {
             $route_list[] = $route->route;
           }
        }
        $text = '';
        foreach ($route_list as $sroute) {
          $text .= $sroute . ',';
          $added_route = explode('.' , $sroute);
          if (end($added_route) == 'create') {
            $text .= str_replace('create', 'store' , $sroute) . ',';
          }elseif (end($added_route) == 'edit') {
            $text .= str_replace('edit', 'update' , $sroute) . ',';
          }
        }
        $prepared_routes = explode(',' , trim($text, ','));
        $current_route = $request->route()->getName();
        if (!in_array($current_route, $prepared_routes)) {
          abort(403, 'unauthorized action.');
        }
        return $next($request);
    }
}
