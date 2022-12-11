<x-app-layout>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div class="bg-gray-200 font-sans flex">
            @include('layouts.back.sidebar')
            <div class="container" style="padding-top:5px">
                <div class="text-3xl" >{{$contents['page_information']['title']}}</div>
                    <div class="row">
                        <div class="col-md-12">
                            @if (isset($id))
                            <form action="/backstage/{{$contents['page_information']['title_url']}}/{{$id}}" method="POST" enctype="multipart/form-data">
                            @else
                            <form action="/backstage/{{$contents['page_information']['title_url']}}/" method="POST" enctype="multipart/form-data">
                            @endif
                                @csrf
                                <table class="table table-fixed border border-gray-900">
                                    <!-- <thead class="divide-y border border-gray-900 divide-gray-900">
                                        <th class="border border-gray-900 p-2" scope="col" ></th>
                                    </thead> -->
                                    <tbody class="divide-y border border-gray-900 divide-gray-900 ">
                                        @foreach($contents['table'] as $k1 => $v1)
                                            <tr>
                                                <td class="border border-gray-900 p-2">
                                                    {{$v1['front_text']}}：
                                                </td>
                                                <td class="border border-gray-900 p-2">
                                                    @if ($v1['name_type']=='text')
                                                        <input type="text" name="{{$v1['name']}}" value="{{$v1['value']}}"><br>
                                                    @elseif($v1['name_type']=='password')
                                                        <input type="password" name="{{$v1['name']}}" value="{{$v1['value']}}"><br>
                                                    @elseif($v1['name_type']=='select')
                                                        <select name="{{$v1['name']}}">
                                                            @foreach($v1['value'] as $k2 => $v2)
                                                                @if ($v1['selected'] == $v2['value'])
                                                                    <option value="{{$v2['value']}}" selected>{{$v2['value_text']}}</option>
                                                                @else
                                                                    <option value="{{$v2['value']}}">{{$v2['value_text']}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select><br>
                                                    @elseif($v1['name_type']=='image')
                                                        <!-- <input type="file" name="{{$v1['name']}}" value="{{$v1['value']}}"><br> -->
                                                        <input type="file" name="{{$v1['name']}}" onchange="readURL(this)" targetID="{{$v1['name']}}" accept="image/gif, image/jpeg, image/png"/ >
                                                        <img id="{{$v1['name']}}" src="#" />
                                                        <script>
                                                            function readURL(input){
                                                                if(input.files && input.files[0]){
                                                                    var imageTagID = input.getAttribute("targetID");
                                                                    var reader = new FileReader();
                                                                    reader.onload = function (e) {
                                                                    var img = document.getElementById(imageTagID);
                                                                    img.setAttribute("src", e.target.result)
                                                                    }
                                                                    reader.readAsDataURL(input.files[0]);
                                                                }
                                                            }
                                                        </script>
                                                        <!-- if ($v1['value'] != '') -->
                                                        {{$v1['value']}}
                                                        <!-- endif -->
                                                    @elseif($v1['name_type']=='date')
                                                        <input type="date" name="{{$v1['name']}}" value="{{$v1['value']}}"><br>
                                                    @elseif($v1['name_type']=='textarea')
                                                        <textarea name="{{$v1['name']}}">{{$v1['value']}}</textarea>
                                                        <script>
                                                                CKEDITOR.replace( '{{$v1['name']}}' );
                                                        </script>
                                                    @else
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>
</x-app-layout>
