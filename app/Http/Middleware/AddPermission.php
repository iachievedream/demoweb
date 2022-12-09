<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use App\Models\UserMenuPermissions;
use App\Models\MenuSmall;

class AddPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $able = UserMenuPermissions::where('user_id', $id)
                ->select('menu_small_id', 'able')
                ->get();
            $small_menus = MenuSmall::select('id', 'title', 'menu_id')
                ->get();
            foreach ($small_menus as $small_menu) {
                if (isset($able)) {
                    UserMenuPermissions::create([
                        'user_id' => $id,
                        'menu_small_id' => $small_menu->id,
                        'able' => '3',
                    ]);
                }
            }
            // //更改權限
            // $user_menu = $request->route('id');
            // if(isset($user_menu)){
            //     DB::table('users')
            //         ->where('id', $id)
            //         ->update([
            //             'user_authority' => $user_menu,
            //     ]);
            // }
            return $next($request);
        } else {
            // return route('login');  //有錯誤，錯誤內容:Trying to get property 'headers' of non-object
            return redirect('login');
        }
    }
}
