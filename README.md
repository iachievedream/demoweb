# README
## installed
composer create-project laravel/laravel demoweb

composer require laravel/jetstream
php artisan jetstream:install livewire

npm install && npm run dev
if it doesn't work
use the following instruction
npm ci && npm run dev
> docker會遇見下列兩個問題，用以下方式解決就好

### Q bash: nvm: command not found
A.[Node Version Manager install - nvm command not found](https://stackoverflow.com/questions/16904658/node-version-manager-install-nvm-command-not-found)

~~~
curl -o- https://raw.githubusercontent.com/creationix/nvm/v0.33.1/install.sh | bash
source ~/.nvm/nvm.sh
nvm --version
~~~

### Q.Error: You are using an unsupported version of Node. Please update to at least Node v12.14
A.[Upgrading Node.js to latest version](https://stackoverflow.com/questions/10075990/upgrading-node-js-to-latest-version)
~~~
nvm install v16.17.1
~~~

### Q.A.[JetStream CSS and JS not working and showing @vite(['resources/css/app.css', 'resources/js/app.js'])](https://stackoverflow.com/questions/73180945/jetstream-css-and-js-not-working-and-showing-viteresources-css-app-css-re)

~~~
Removing 
@vite(['resources/css/app.css', 'resources/js/app.js'])

and replacing it with

<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="{{ asset('js/app.js') }}" defer></script>
~~~

## git
git init
git add .
git commit -m "origin"

git branch dev
git branch test

git checkout test

## laravel

php artisan migrate

php artisan serve --host=0.0.0.0 --port=81

## db

~~~
php artisan make:migration add_users_table
users
---
profile_photo_path
address
self_introduction
role

php artisan make:migration create_products_table
產品 products
---
type 產品的種類 文章 artical，影片movie，物品object
name
content
original_price
selling_price
user_id 作者或擁有者
time(frequency)

php artisan make:migration create_product_message_boards_table
產品留言板 product_message_boards
---
idproduct_id
content
user_id

# php artisan make:migration create_orders_table
# 訂單 orders
# ---
# user_id
# type(付款方式)
# third_party_cash_flow_order
# price
# address
# state

### 後臺書籤 menu
php artisan make:migration create_menus_table
menu
---
title
menu_permission

php artisan make:migration create_menu_smalls_table
menu_small
---
title
menu_id
route

php artisan make:migration create_user_menu_permissions_table
user_menu_permissions
---
user_id
menu_small_id
able

~~~
## seed

新增檔案
php artisan make:seeder MenuSeeder
執行檔案
php artisan db:seed --class=MenuSeeder

## model
php artisan make:model Product
php artisan make:model ProductMessageBoards
php artisan make:model Menu
php artisan make:model MenuSmall
php artisan make:model UserMenuPermissions

## seed
php artisan make:seeder UserSeeder
php artisan db:seed --class=UserSeeder

php artisan make:seeder ProductSeeder
php artisan db:seed --class=ProductSeeder

## HomeController

php artisan make:controller HomeController

## livewire
php artisan make:livewire replies

[不寫 JavaScript，就讓網站變成 SPA！Laravel Livewire 初體驗（上）](https://docfunc.com/posts/35/%E4%B8%8D%E5%AF%AB-javascript%E5%B0%B1%E8%AE%93%E7%B6%B2%E7%AB%99%E8%AE%8A%E6%88%90-spalaravel-livewire-%E5%88%9D%E9%AB%94%E9%A9%97%E4%B8%8A-post)

php artisan make:livewire product/index
