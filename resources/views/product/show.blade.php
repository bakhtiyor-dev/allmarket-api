<x-app-layout>
    <div class="bg-white p-3">
        <section class="pt-12 pb-24 bg-blueGray-100 rounded-b-10xl overflow-hidden">
            <div class="container px-4 mx-auto">
                <div class="flex flex-wrap -mx-4">
                    <div class="w-full px-4">
                        <ul class="flex flex-wrap items-center mb-16">
                            <li class="mr-6">
                                <a class="flex items-center text-sm font-medium text-gray-400 hover:text-gray-500"
                                   href="/">
                                    <span>Главная</span>
                                    <svg class="ml-6" width="4" height="7" viewbox="0 0 4 7" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.150291 0.898704C-0.0500975 0.692525 -0.0500975 0.359292 0.150291 0.154634C0.35068 -0.0507836 0.674443 -0.0523053 0.874831 0.154634L3.7386 3.12787C3.93899 3.33329 3.93899 3.66576 3.7386 3.8727L0.874832 6.84594C0.675191 7.05135 0.35068 7.05135 0.150292 6.84594C-0.0500972 6.63976 -0.0500972 6.30652 0.150292 6.10187L2.49888 3.49914L0.150291 0.898704Z"
                                              fill="currentColor"></path>
                                    </svg>
                                </a>
                            </li>
                            <li class="mr-6">
                                <a class="flex items-center text-sm font-medium text-gray-400 hover:text-gray-500"
                                   href="{{route('product.filter',['category' => $product->category->id])}}">
                                    <span>{{$product->category?->title}}</span>
                                    <svg class="ml-6" width="4" height="7" viewbox="0 0 4 7" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.150291 0.898704C-0.0500975 0.692525 -0.0500975 0.359292 0.150291 0.154634C0.35068 -0.0507836 0.674443 -0.0523053 0.874831 0.154634L3.7386 3.12787C3.93899 3.33329 3.93899 3.66576 3.7386 3.8727L0.874832 6.84594C0.675191 7.05135 0.35068 7.05135 0.150292 6.84594C-0.0500972 6.63976 -0.0500972 6.30652 0.150292 6.10187L2.49888 3.49914L0.150291 0.898704Z"
                                              fill="currentColor"></path>
                                    </svg>
                                </a>
                            </li>

                            <li>
                                <a class="text-sm font-medium text-indigo-500 hover:text-indigo-600"
                                   href="#">{{$product->title}}</a>
                            </li>
                        </ul>
                    </div>

                    <div class="w-full lg:w-1/2 px-4 mb-16 lg:mb-0">
                        <div class="flex -mx-4 flex-wrap items-center justify-between lg:justify-start lg:items-start xl:items-center">
                            <img src="{{$product->image}}" alt="image">
                        </div>
                    </div>

                    <div class="w-full lg:w-1/2 px-4">
                        <div class="max-w-md mb-6">
                            <span class="text-xs text-gray-400 tracking-wider">{{$product->brand?->title}}</span>
                            <h4 class="mt-6 mb-4 text-xl font-heading font-medium">{{$product->title}}</h4>
                            <p class="flex items-center mb-6">
                                <span class="mr-2 text-sm text-blue-500 font-medium">UZS</span>
                                <span class="text-3xl text-blue-500 font-medium">{{number_format($product->price)}}</span>
                            </p>
                        </div>

                        <div class="flex flex-wrap -mx-2 mb-12">
                            <div class="w-full md:w-2/3 px-2 mb-2 md:mb-0">
                                <a class="block py-4 px-2 leading-8 font-heading font-medium tracking-tighter text-xl text-white text-center bg-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 hover:bg-blue-600 rounded-xl"
                                   target="_blank" href="{{$product->shop_link}}">
                                    В магазин
                                </a>
                            </div>
                            <div class="w-full md:w-1/3 px-2">

                                @if(auth()->check() && auth()->user()->favourites()->where('product_id',$product->id)->exists())
                                    <form action="/favourites/{{$product->id}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="text-xl bg-gray-100 p-3 rounded">
                                            <i class="fas fa-bookmark text-yellow-500"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="/favourites/{{$product->id}}" method="post">
                                        @csrf
                                        <button type="submit" class="text-xl hover:bg-gray-100 p-3 rounded">
                                            <i class="fas fa-bookmark text-yellow-500"></i>
                                        </button>
                                    </form>
                                @endif

                            </div>
                        </div>
                        <div>
                            {{--                            <h4 class="mb-6 font-heading font-medium">Описание:</h4>--}}
                            {!! $product->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="bg-white p-3 mt-5">
        <h5 class="text-lg font-bold mb-2">Cравнить с другими</h5>
        @foreach($similarProducts as $product)
            <div class="border p-3 flex items-center">
                <img src="{{$product->image}}" alt="" class="h-40">
                <p class="text-lg font-bold mr-5">{{$product->title}}</p>
                <p class="font-bold font-mono mr-5">{{$product->price}} UZS</p>
                <span class="text-xs bg-yellow-400 px-2 py-0.5 font-semibold rounded-lg ">{{$product->shop->title}}</span>
            </div>
        @endforeach

    </div>
</x-app-layout>
