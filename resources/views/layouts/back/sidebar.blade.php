<!-- <div class="flex flex-col sm:flex-row sm:justify-around"> -->
    <div class="w-64 h-screen bg-white">
        <!-- <nav class="mt-10"> -->
        @foreach($menus as $menu)
        @php
            // dd($menu)
        @endphp            
            @if(isset($menu['title']))
            <nav class="mt-0">
                <div x-data="{ open: false }">
                    <!-- <button @click="open = !open" class="w-full flex justify-between items-center py-3 px-6 text-gray-600 cursor-pointer hover:bg-gray-100 hover:text-gray-700 focus:outline-none"> -->
                    <button @click="open = !open" class="w-full flex justify-between items-center py-3 px-3 text-gray-600 cursor-pointer hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                        <span class="flex items-center">
                            <!-- <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 5V7M15 11V13M15 17V19M5 5C3.89543 5 3 5.89543 3 7V10C4.10457 10 5 10.8954 5 12C5 13.1046 4.10457 14 3 14V17C3 18.1046 3.89543 19 5 19H19C20.1046 19 21 18.1046 21 17V14C19.8954 14 19 13.1046 19 12C19 10.8954 19.8954 10 21 10V7C21 5.89543 20.1046 5 19 5H5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg> -->
                            <span class="mx-4 font-medium">{{$menu['title']}}</span>
                        </span>

                        <span>
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path x-show="! open" d="M9 5L16 12L9 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;"></path>
                                <path x-show="open" d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </button>

                    <div x-show="open" class="bg-gray-100">
                    @foreach($menu['small_menu'] as $small_menu)
                        <!-- <a class="py-2 px-16 block text-sm text-gray-600 hover:bg-blue-500 hover:text-white" href="{{route($small_menu->route)}}">{{$small_menu->title}}</a> -->
                        <a class="py-2 px-5 block text-sm text-gray-600 hover:bg-blue-500 hover:text-white" href="{{route($small_menu->route)}}">{{$small_menu->title}}</a>
                    @endforeach
                    </div>
                </div>
            </nav>
            @endif
        @endforeach
        <!-- </nav> -->
    </div>
<!-- </div> -->