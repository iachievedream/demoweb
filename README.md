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