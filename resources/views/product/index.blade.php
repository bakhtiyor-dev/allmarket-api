<x-app-layout>
    <div class="bg-white p-2">
        <div class="flex justify-between p-5">
            <h4 class="text-xl font-medium">{{$category?->title}}</h4>
            <div>

            </div>
        </div>
        <hr class="mb-3">
        <div class="grid grid-cols-4">
            <div class="p-5">
                <form action="{{route('product.filter')}}" method="GET">
                    <div class="mb-10">
                        <h3 class="text-lg font-medium mb-2">Цена</h3>
                        <div class="flex mb-3">

                            <input type="text"
                                   class="bg-gray-50 mr-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                   value="{{request()->price ? request()->price[0] : ''}}"
                                   placeholder="От:"
                                   name="price[]">
                            <input type="text"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                   placeholder="До:"
                                   value="{{request()->price ? request()->price[1] : ''}}"
                                   name="price[]">
                        </div>
                        <button type="submit"
                                class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">
                            Применить
                        </button>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium mb-2">Бренд</h3>

                        <div>
                            @foreach(\App\Models\Brand::all() as $brand)
                                <div class="flex items-center mb-4">
                                    <input id="checkbox{{$brand->id}}"
                                           type="checkbox"
                                           name="brands[]"
                                           @if(collect(request()->brands)->contains($brand->id)) checked @endif
                                           value="{{$brand->id}}"
                                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                    <label for="checkbox{{$brand->id}}"
                                           class="ml-2 text-sm font-medium text-gray-900">{{$brand->title}}</label>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">
                        Применить
                    </button>


                </form>
            </div>
            <div class="col-span-3">
                <div class="grid grid-cols-4 gap-4">
                    @foreach($products as $product)
                        @include('components.product-card')
                    @endforeach
                </div>
                <div class="my-5">
                    {!! $products->links() !!}
                </div>
            </div>
        </div>

    </div>

</x-app-layout>
