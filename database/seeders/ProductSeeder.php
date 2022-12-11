<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_exists = \DB::table('products')->where('name', 'Product title')->exists();
        if(!($user_exists)) {
            $user = Product::create([
                'type' =>0,
                'name' =>'Product title',
                'content' =>'Product content',
                'original_price' =>'250',
                'selling_price' =>'150',
                'user_id' =>1,
                'times' =>'0',
                'time_limit' =>'150',
            ]);
        } else {
            echo 'Product title of product is exists';
        }
    }
}
