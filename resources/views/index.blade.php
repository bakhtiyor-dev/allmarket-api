<x-app-layout>


    <div id="default-carousel" class="relative" data-carousel="static">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
            <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <span class="absolute text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 sm:text-3xl dark:text-gray-800">First Slide</span>
                <img src="https://aws-obg-image-lb-5.tcl.com/content/dam/brandsite/region/in/blog/pc/detail/new-blogs---28th-july/2022-tv-shopping-guide-time-to-get-your-next-google-tv/TimetoGetThumweb.jpg"
                     class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="https://1.bp.blogspot.com/-pbDffAW9Ays/YbHJLuVnRPI/AAAAAAAAaFw/NGhGhgeL98UV3Cq5h5aSfhScE4GA8EuDgCNcBGAsYHQ/s900/mobail-banner-design_900.jpg"
                     class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>

        </div>
        <!-- Slider indicators -->
        <div class="absolute  flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 1"
                    data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                    data-carousel-slide-to="1"></button>
        </div>

        <!-- Slider controls -->
        <button type="button"
                class="absolute top-0 left-0 z-20 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-prev>
        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                 stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 19l-7-7 7-7"></path></svg>
            <span class="sr-only">Previous</span>
        </span>
        </button>
        <button type="button"
                class="absolute top-0 right-0 z-20 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-next>
        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                 stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="sr-only">Next</span>
        </span>
        </button>
    </div>

    <div class="mt-4">
        <h4 class="text-xl uppercase font-bold mb-2">Популярные категории</h4>
        <div class="grid sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-2 bg-gray-50 p-5">
            <a href="#" class="p-3 text-center shadow bg-white hover:bg-gray-50 rounded">
                <i class="fa-solid fa-mobile-screen text-cyan-500 mr-1"></i>
                <span class="font-medium">Смартфоны</span>
            </a>

            <a href="#" class="p-3 text-center shadow bg-white hover:bg-gray-50 rounded">
                <i class="fa-solid fa-tv text-cyan-500 mr-1"></i>
                <span class="font-medium">Телевизоры</span>
            </a>

            <a href="#" class="p-3 text-center shadow bg-white hover:bg-gray-50 rounded">
                <i class="fa-solid fa-laptop text-cyan-500 mr-1"></i>
                <span class="font-medium">Компьютеры</span>
            </a>

            <a href="#" class="p-3 text-center shadow bg-white hover:bg-gray-50 rounded">
                <i class="fa-solid fa-fan text-cyan-500 mr-1"></i>
                <span class="font-medium">Кондиционеры</span>
            </a>

            <a href="#" class="p-3 text-center shadow bg-white hover:bg-gray-50 rounded">
                <i class="fa-solid fa-snowflake text-cyan-500 mr-1"></i>
                <span class="font-medium">Холодильники</span>
            </a>

            <a href="#" class="p-3 text-center shadow bg-white hover:bg-gray-50 rounded">
                <i class="fa-solid fa-tablet text-cyan-500 mr-1"></i>
                <span class="font-medium">Планшеты</span>
            </a>
        </div>

    </div>


    <div class="mt-10">

        <a href="#" class="text-xl font-bold mb-3 uppercase">Товары <i class="fas fa-chevron-right text-lg"></i></a>
        <div class="mt-3 grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3">
            @foreach($products as $product)
                @include('components.product-card')
            @endforeach
        </div>
    </div>


    <div class="mt-10">
        <h4 class="text-xl font-bold mb-3 uppercase">ПОПУЛЯРНЫЕ БРЕНДЫ</h4>

        <div class="grid grid-cols-3 lg:grid-cols-8 gap-3">
            <a href="#" class="border-2 rounded-lg p-3 flex items-center">
                <img class="w-20 mx-auto"
                     src="https://s3.amazonaws.com/cdn.designcrowd.com/blog/100-Famous-Brand%20Logos-From-The-Most-Valuable-Companies-of-2020/samsung-logo.png"
                     alt="img">
            </a>

            <a href="#" class="border-2 rounded-lg p-3 flex items-center">
                <img class="w-20 mx-auto"
                     src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRuwGYmjhovX0tjJeU6ssEfBPdQQvGuw1N64Q&usqp=CAU"
                     alt="">
            </a>


            <a href="#" class="border-2 rounded-lg p-3 flex items-center">
                <img class="w-20 mx-auto"
                     src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRuwGYmjhovX0tjJeU6ssEfBPdQQvGuw1N64Q&usqp=CAU"
                     alt="">
            </a>

            <a href="#" class="border-2 rounded-lg p-3 flex items-center">
                <img class="w-20 mx-auto"
                     src="https://upload.wikimedia.org/wikipedia/en/thumb/0/04/Huawei_Standard_logo.svg/640px-Huawei_Standard_logo.svg.png"
                     alt="">
            </a>


            <a href="#" class="border-2 rounded-lg p-3 flex items-center">
                <img class="w-20 mx-auto"
                     src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQlPhQIuQrwq6_vE1SRyTay6F6wKAOX1aLi1A&usqp=CAU"
                     alt="">
            </a>

            <a href="#" class="border-2 rounded-lg p-3 flex items-center">
                <img class="w-20 mx-auto"
                     src="https://media.designrush.com/inspiration_images/134802/conversions/_1511456315_653_apple-mobile.jpg"
                     alt="">
            </a>


            <a href="#" class="border-2 rounded-lg p-3 flex items-center">
                <img class="w-20 mx-auto"
                     src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ae/Xiaomi_logo_%282021-%29.svg/1200px-Xiaomi_logo_%282021-%29.svg.png"
                     alt="">
            </a>

        </div>

    </div>

</x-app-layout>

