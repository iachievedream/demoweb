<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\UserMenuPermissions;

class AccessPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$menu_permission)
    {
        if (Auth::check()) {
            // dd($menu_permission);
            $id = Auth::user()->id;
            $able = UserMenuPermissions::select('menu_small_id','able')
                // ->where('user',$menu_permission)
                // ->where('able','<=','2')
                ->get();
            // dd($able);
            if ($able["0"]->able>1) {
                return $next($request);
            }
            return redirect('/')->with('message', '無此訪問權限');
        } else {
            return redirect('login');
        }
    }
}
