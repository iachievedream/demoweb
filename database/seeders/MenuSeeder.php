<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\MenuSmall;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [];
        $menus[] = ['會員中心', 0];
        $menus[] = ['產品內容', 0];
        $menus[] = ['報表資訊', 1];
        $menus[] = ['介面管理', 1];
        // $menus[] = ['分析資訊', 0];
        if (!empty($menus)) {
            foreach ($menus as $menu) {
                $product = Menu::create([
                    'title' => $menu[0],
                    'menu_permission' => $menu[1],
                ]);
            }
        }
        // $small_menu = SmallMenu::get();
        $small_menus = [];
        $small_menus[] = ['會員管理1', 1,'user'];
        $small_menus[] = ['會員管理2', 1,'user'];
        $small_menus[] = ['產品管理1', 2,'product'];
        $small_menus[] = ['產品管理2', 2,'product'];
        $small_menus[] = ['訂單管理', 3,'order'];
        $small_menus[] = ['側欄管理', 4,'menu'];
        if (!empty($small_menus)) {
            foreach ($small_menus as $small_menu) {
                $products = MenuSmall::create([
                    'title' => $small_menu[0],
                    'menu_id' => $small_menu[1],
                    'route' => $small_menu[2],
                ]);
            }
        }
    }
}
