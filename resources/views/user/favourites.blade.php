<x-app-layout>
    <div class="mt-10">

        <a href="#" class="text-xl font-bold mb-3 uppercase">Товары <i class="fas fa-chevron-right text-lg"></i></a>
        <div class="mt-3 grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3">
            @foreach($favourites as $product)
                @include('components.product-card')
            @endforeach
        </div>
    </div>
</x-app-layout>
