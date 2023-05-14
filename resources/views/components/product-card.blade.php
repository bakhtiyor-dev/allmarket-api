<div class="bg-white rounded-lg border-2 relative">

    <div class="p-3">
        <a href="#">
            <img class="h-48 object-cover mx-auto rounded-t-lg"
                 src="{{$product->image}}"
                 alt="product image"/>
        </a>
    </div>

    <div class="px-5 pb-5">
        <a href="{{route('product.show',$product)}}" class="">
            <h5 class="font-medium tracking-tight text-gray-900 hover:text-cyan-500">{{$product->title}}</h5>
        </a>
        <div class="flex items-center mt-2.5 mb-5">
            <i class="fas fa-star text-yellow-300 text-xs"></i>
            <i class="fas fa-star text-yellow-300 text-xs"></i>
            <i class="fas fa-star text-yellow-300 text-xs"></i>
            <i class="fas fa-star text-yellow-300 text-xs"></i>
            <i class="fas fa-star text-yellow-300 text-xs"></i>
            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded ml-2">5.0</span>
        </div>
        <div class="font-bold text-gray-900 mb-2">{{number_format($product->price)}} UZS</div>
        <span class="text-xs bg-yellow-400 px-2 py-0.5 font-semibold rounded-lg ">{{$product->shop->title}}</span>
    </div>
</div>
