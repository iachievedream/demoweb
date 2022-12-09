<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\AdvertiseLog;
use App\Models\Log;

class CommonService {
	public function menu() {
		if (Auth::check()) {
			$menu = DB::table('menus')
				->get();
			$small_menu = DB::table('menu_smalls')
				->join('user_menu_permissions', 'menu_smalls.id', '=', 'user_menu_permissions.menu_small_id')
				->where('user_id', Auth::user()->id)
				->get();
			foreach ($menu as $k1 => $v1) {
				$menu_title = $v1->title;
				$small_menu_title = [];
				foreach ($small_menu as $k2 => $v2) {
					if ($v1->id == $v2->menu_id) {
						$small_menu_title[] = $v2;
					}
				}
				$totle[] = ['title' => $menu_title, 'small_menu' => $small_menu_title];
			}
			// dd($totle);
			return $totle;
		} else {
			return redirect('login');
		}
	}
}
