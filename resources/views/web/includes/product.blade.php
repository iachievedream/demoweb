<div class="flex flex-col shadow-lg overflow-hidden transition duration-500 transform hover:-translate-y-1 hover:scale-10">
        {{$product->name}}
    <div class="flex-1 bg-white p-4 flex flex-col justify-between">
        <div class="flex-1"> 
        <p class="text-sky-500 display-3 mb-3">{{$product->time}}</p>
    </div>
    <div>
        <div class="flex justify-between items-center">
            <div>
                購買
            </div>
        </div>
        <div class="mx-2 mt-2 grid lg:grid-cols-6 sm:grid-cols-4 gap-3">
            @foreach($products as $item)
                <livewire:product.index />
            @endforeach
        </div>
    </div>
</div>