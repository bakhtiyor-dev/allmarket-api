<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Allmarket') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
          integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js" integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif
    <div id="drawer-navigation"
         class="fixed top-0 left-0 z-40 w-64 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white"
         tabindex="-1" aria-labelledby="drawer-navigation-label">
        <h5 id="drawer-navigation-label" class="text-base font-semibold text-gray-700 uppercase">Каталог</h5>
        <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                      clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
        <div class="py-4 overflow-y-auto">
            <ul class="space-y-2">
                @foreach(\App\Models\Category::all() as $category)
                    <li>
                        <a href="{{route('product.filter',['category' => $category->id])}}"
                           class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg hover:bg-gray-100">
                            <span class="ml-3">{{$category->title}}</span>
                        </a>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>

    <div id="crypto-modal" tabindex="-1" aria-hidden="true"
         data-modal-placement="top-center"
         class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
        @include('components.search')
    </div>


    <div class="bg-yellow-400 h-7 w-full">
        <div class="md:max-w-6xl max-w-sm mx-auto flex items-center justify-between px-2">
            <div>
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                        class="text-xs font-medium text-gray-600 inline-flex items-center" type="button">
                    Русский <i class="fas fa-caret-down ml-2"></i>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdown" class="z-50 hidden  bg-white divide-y divide-gray-100 rounded shadow w-20">
                    <ul class="text-xs text-gray-700" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a href="#" class="block p-2 bg-gray-100 hover:bg-gray-100">Русский</a>
                        </li>

                        <li>
                            <a href="#" class="block p-2 hover:bg-gray-100">Узбекский</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div>
                <a href="" class="text-xs text-gray-600 font-medium">
                    <i class="fas fa-sign-in mr-1"></i> Войти
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto mb-10 px-2">
        <nav class="p-5 flex items-center sticky top-0 bg-white rounded-b z-30 shadow my-2">

            <div>
                <a href="/">
                    <img src="{{asset('assets/logo.svg')}}" class="h-6" alt="logo"/>
                </a>
            </div>

            <form class="ml-8 w-1/2 hidden md:block" data-modal-target="crypto-modal" data-modal-toggle="crypto-modal">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Поиск</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fas fa-search text-cyan-600"></i>
                    </div>

                    <div class="absolute inset-y-0 right-0 flex items-center pr-8 pointer-events-none">
                        <code class="text-sm text-gray-400">Ctrl K</code>
                    </div>
                    <input type="search" id="default-search"
                           class="block w-full p-1.5 pl-10 text-gray-900 border-2 border-cyan-500 rounded-lg bg-gray-50 outline-none hover:bg-gray-100 cursor-pointer"
                           placeholder="Поиск..." required
                           autocomplete="off">
                </div>
            </form>


            <button data-modal-target="crypto-modal" data-modal-toggle="crypto-modal"
                    class="text-cyan-500 border-2 border-cyan-500 font-medium px-3 py-1 rounded-lg ml-5 md:hidden">
                <i class="fas fa-search"></i>
            </button>

            <button class="bg-cyan-500 text-white hover:bg-cyan-600 hover:shadow font-medium px-5 py-2 rounded-lg ml-5 flex items-center"
                    data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation"
                    aria-controls="drawer-navigation">
                <i class="fas fa-bars md:mr-2"></i>
                <span class="hidden md:block">
            Каталог
            </span>
            </button>

            <div class="ml-5">
                <a href="#" class="hover:bg-gray-100  py-3 px-3 rounded-lg">
                    <i class="fa-regular fa-bookmark text-yellow-400 text-2xl"></i>
                </a>
            </div>
        </nav>

        <main>{{ $slot }}</main>

    </div>


    <footer class="p-4 p-6 bg-gray-800  w-full">
        <div class="max-w-6xl mx-auto">
            <div class="md:flex md:justify-between mb-10">
                <div class="mb-6 md:mb-0">
                    <a href="/">
                        <img src="/assets/logo.svg" class="h-6 mr-3" alt="logo"/>
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                    <div>
                        <h2 class="mb-6 text-sm font-semibold uppercase text-white">Ресурсы</h2>
                        <ul class="text-gray-400">
                            <li class="mb-4">
                                <a href="/about" class="hover:underline">О нас</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Подписывайтесь на
                            нас</h2>
                        <ul class="text-gray-600 dark:text-gray-400">
                            <li class="mb-4">
                                <a href="#" class="hover:underline ">Telegram</a>
                            </li>
                            <li>
                                <a href="#" class="hover:underline">Instagram</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white"></h2>
                        <ul class="text-gray-600 dark:text-gray-400">
                            <li class="mb-4">
                                <a href="#" class="hover:underline">Политика конфиденциальности</a>
                            </li>
                            <li>
                                <a href="#" class="hover:underline">Условия и положения</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="sm:flex sm:items-center sm:justify-between">
        <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">
            © 2023
            <a href="/"
               class="hover:underline">Allmarket.uz</a>. Все права защищены.
        </span>
                <div class="flex mt-4 space-x-6 sm:justify-center sm:mt-0">
                    <a href="#" class="text-lg text-gray-500 hover:text-white">
                        <i class="fa-brands fa-facebook"></i>
                        <span class="sr-only">Facebook page</span>
                    </a>

                    <a href="#" class="text-lg text-gray-500 hover:text-white">
                        <i class="fa-brands fa-instagram"></i>
                        <span class="sr-only">Instagram page</span>
                    </a>

                    <a href="#" class="text-lg text-gray-500 hover:text-white">
                        <i class="fa-brands fa-telegram"></i>
                        <span class="sr-only">Telegram page</span>
                    </a>

                </div>
            </div>
        </div>

    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>


</div>
</body>
</html>
