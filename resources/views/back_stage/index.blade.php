<x-app-layout>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div class="bg-gray-200 font-sans flex">
            @include('layouts.back.sidebar')
            <div class="container" style="padding-top:5px">
                <div class="text-3xl" >{{$contents['page_information']['title']}}</div>
                <div class="row">
                    <div class="col-md-6">
                    @if (isset($id))
                        <a href="/backstage/{{$contents['page_information']['title_url']}}/{{$id}}/create">
                            <button class="btn btn-success">新增</button>
                        </a>
                    @else
                        <a href="/backstage/{{$contents['page_information']['title_url']}}/create">
                            <button class="btn btn-success">新增</button>
                        </a>
                    @endif
                    </div>
                    @if (isset($contents['page_information']['search']))
                        <form action="/backstage/{{$contents['page_information']['title_url']}}/" method="get">
                            @foreach($contents['page_information']['search'] as $k => $search)
                            　  {{$search}}<input type="text" id="{{$contents['page_information']['search_url'][$k]}}" name="{{$contents['page_information']['search_url'][$k]}}" style="width:100px;height:30px;">
                            @endforeach
                            <input type="submit" value="查詢">
                        </form>
                    @endif
                </div>
                @if (isset($contents['table']))
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-fixed border border-gray-900">
                        <!-- <table class="table table-fixed border-black"> -->
                            <thead class="divide-y border border-gray-900 divide-gray-900">
                                <th>勾選</th>
                            @foreach($contents['table']['field'] as $field)
                                <th class="border border-gray-900 p-2" scope="col" >
                                    {{$field}}
                                </th>
                            @endforeach
                            @if (isset($contents['table']['note']))
                                <th class="border border-gray-900" scope="col" colspan="@php echo count($contents['table']['note'])+1; @endphp">
                                    備註
                                </th>
                            @else
                                <th class="border border-gray-900" scope="col" colspan="1">
                                    備註
                                </th>
                            @endif
                            </thead>
                                <tbody class="divide-y border border-gray-900 divide-gray-900 ">
                                    <!-- dd($contents['table']['content']) //打印-->
                                    @if (isset($contents['table']['content']))
                                        @foreach($contents['table']['content'] as $k1 => $names)
                                        <tr>
                                            <td class="border border-gray-900 p-2">
                                                <input type="checkbox" value="{{$contents['table']['content'][$k1][0]}}"/>
                                            </td>
                                            @foreach($names as $k2 => $name)
                                                @if ($contents['table']['content_type'][$k1][$k2] == 'image')
                                                    <td class="border border-gray-900 p-2">
                                                        <img src="{{$name}}" width="200">
                                                    </td>
                                                @else
                                                    <td class="border border-gray-900 p-2">{{$name}}</td>
                                                @endif
                                            @endforeach
                                            @if (isset($contents['table']['note']))
                                                @foreach($contents['table']['note'] as $k => $note)
                                                    <td class="border border-gray-900 p-2">
                                                        <a href="/backstage/{{$contents['table']['note_url'][$k]}}/{{$contents['table']['content'][$k1][0]}}/">
                                                            <button class="btn btn-success">{{$note}}</button>
                                                        </a>
                                                    </td>
                                                @endforeach                                                
                                            @endif
                                            <td class="border border-gray-900 p-2">
                                                <script type="text/javascript" language="javascript"> 
                                                    function confirmAct{{$contents['table']['content'][$k1][0]}}() 
                                                    { 
                                                        if(confirm('確定要刪除嗎?')) 
                                                        { 
                                                            return true; 
                                                        } 
                                                        return false; 
                                                    } 
                                                </script> 
                                                <a href="/backstage/{{$contents['page_information']['title_url']}}/delete/{{$contents['table']['content'][$k1][0]}}" 
                                                    onclick="return confirmAct{{$contents['table']['content'][$k1][0]}}();">
                                                    <button class="btn btn-success">刪除</button>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                        </table>
                        <br><br><br>
                    </div>
                </div>
                @else
                <br><br>
                <div class="text-3xl" >未有資料，請新增</div>
                @endif
            </div>
        </div>
    </div>
</aside>
</x-app-layout>
