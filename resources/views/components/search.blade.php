<div class="relative w-full h-full max-w-xl md:h-auto" id="search">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow">
        <button type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                data-modal-hide="crypto-modal">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                      clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close modal</span>
        </button>
        <!-- Modal header -->
        <div class="px-6 py-4 border-b rounded-t">
            <form class="mr-5">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Поиск</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fas fa-search text-cyan-600"></i>
                    </div>

                    <input type="search"
                           @keyup="onKeyUp"
                           id="default-search"
                           class="block w-full p-1.5 pl-10 text-gray-900 border-2 border-cyan-500 rounded-lg bg-gray-50 outline-none hover:bg-gray-100 cursor-pointer"
                           placeholder="Поиск..."
                           autocomplete="off">
                </div>
            </form>
        </div>
        <!-- Modal body -->
        <div class="p-6">

            <ul class="space-y-3">
                <li v-for="product in products" :key="product.id">
                    <a :href="'/products/' + product.id"
                       class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow border-2">
                        <img class="h-20"
                             :src="product.image"
                             alt="">
                        <span class="flex-1 ml-4 ">@{{product.title}}</span>
                    </a>
                </li>

            </ul>

        </div>
    </div>
</div>


<script>
    const {createApp} = Vue

    createApp({
        data() {
            return {
                query: '',
                timer: null,
                products: []
            }
        },

        methods: {
            onKeyUp(e) {
                const waitTime = 500;
                const text = e.currentTarget.value;
                clearTimeout(this.timer);
                this.timer = setTimeout(() => {
                    this.search(text);
                }, waitTime);
            },
            search(query) {
                axios.get('/search?query=' + query).then(res => this.products = res.data);
            }
        }
    }).mount('#search')
</script>
