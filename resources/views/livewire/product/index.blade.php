<div class="pt-3 md:pt-8 pb-6 bg-white">
    <div class="mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8"> 
        <div class="heading">
            商品列表
        </div>
		<div class="container">
		<div class="flex items-stretch ">
			@foreach ($products as $product)
				<!-- <div class="py-12 content-center"> -->
				<div class="h-56 grid grid-cols-3 gap-4 content-start ...">
					@include('web.includes.product', $product)
				</div>
			@endforeach
		</div>
	</div>	
</div>