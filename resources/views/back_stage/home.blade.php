<x-app-layout>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div class="bg-gray-200 font-sans flex">
            @include('layouts.back.sidebar')
            <div class="container" style="padding-top:5px">
                <div class="text-3xl">首頁</div>
            </div>
        </div>
    </div>
</aside>
</x-app-layout>
