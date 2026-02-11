@props(['categories'])
<!-- footer -->
<footer class="bg-gray-200 py-8 mt-2">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap md:gap-4 lg:gap-0 py-4 mb-6">
            <div class="w-full md:w-full lg:w-1/2 flex flex-col gap-4 mb-6">
                <h6 class="text-lg font-semibold text-gray-900">Categories</h6>
                <div class="flex flex-wrap">
                    <div class="w-full flex flex-row gap-2">
                        <!-- list -->
                        @foreach($categories as $cat)
                        <a href="{{ route('client.categorieProducts', $cat->id) }}" class="flex items-center justify-center text-gray-600 hover:text-green-600 transition-colors duration-200 border border-green-400 hover:border-none px-3 py-1 rounded-md">{{$cat->name}}</a>
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="w-full md:w-full lg:w-1/2 flex flex-col gap-2 mb-6">
                <div class="text-lg font-semibold text-gray-900">Support</div>

                <div class="w-full flex flex-row gap-2 flex-wrap">

                    <!-- Help Center -->
                    <span
                        class="relative my-3 block px-3 py-1 border rounded-md border-green-600
                   text-gray-400 cursor-not-allowed select-none">
                        Help Center
                        <span class="absolute -top-2 -right-2 text-[10px] bg-gray-300 text-gray-700 px-1 rounded">
                            Soon
                        </span>
                    </span>

                    <!-- Privacy Policy -->
                    <span
                        class="relative my-3 block px-3 py-1 border rounded-md border-green-600
                   text-gray-400 cursor-not-allowed select-none">
                        Privacy Policy
                        <span class="absolute -top-2 -right-2 text-[10px] bg-gray-300 text-gray-700 px-1 rounded">
                            Soon
                        </span>
                    </span>

                    <!-- Conditions -->
                    <span
                        class="relative my-3 block px-3 py-1 border rounded-md border-green-600
                   text-gray-400 cursor-not-allowed select-none">
                        Conditions
                        <span class="absolute -top-2 -right-2 text-[10px] bg-gray-300 text-gray-700 px-1 rounded">
                            Soon
                        </span>
                    </span>

                </div>
            </div>

            <div class="border-t py-4 border-gray-300">
                <div class="flex flex-col md:flex-row items-center gap-3">
                    <div class="md:w-1/2 text-center md:text-left">
                        <span class="text-sm text-gray-500">
                            © <span id="copyright"></span> LocalMarket eCommerce plateforme. The trademarks LocalMarket and the LocalMarket Spark design are registered with the MA Patent and Trademark Office. All Rights Reserved.

                            <a href="https://youcode.ma/" target="_blank" class="text-green-600 hover:text-green-700 transition-colors duration-200">Youcode</a>.
                        </span>
                    </div>
                    <div class="md:w-1/2 flex md:justify-end justify-center items-center">
                        <div class="flex flex-row gap-5 items-center">
                            <div class="text-gray-500">Follow us on</div>
                            <ul class="flex items-center justify-end text-sm gap-1">
                                <li>
                                    <a href="https://github.com/yassinesekkah/Localmart-Ecommerce" class="inline-flex justify-center items-center h-8 w-8 border border-gray-300 rounded text-gray-600 hover:border-green-600 hover:text-green-600 transition-all duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-6 h-6"
                                            viewBox="0 0 24 24"
                                            fill="currentColor">
                                            <path d="M12 .5C5.73.5.5 5.74.5 12.02c0 5.11 3.29 9.44 7.86 10.97.57.11.78-.25.78-.56v-2.02c-3.2.7-3.87-1.55-3.87-1.55-.52-1.32-1.27-1.67-1.27-1.67-1.04-.71.08-.7.08-.7 1.15.08 1.75 1.19 1.75 1.19 1.02 1.75 2.68 1.24 3.34.95.1-.74.4-1.24.73-1.52-2.55-.29-5.23-1.28-5.23-5.71 0-1.26.45-2.29 1.19-3.1-.12-.29-.52-1.46.11-3.04 0 0 .97-.31 3.18 1.18a10.96 10.96 0 0 1 5.79 0c2.21-1.49 3.18-1.18 3.18-1.18.63 1.58.23 2.75.11 3.04.74.81 1.19 1.84 1.19 3.1 0 4.44-2.69 5.42-5.25 5.7.41.35.77 1.04.77 2.1v3.11c0 .31.21.67.79.56A11.52 11.52 0 0 0 23.5 12C23.5 5.74 18.27.5 12 .5z" />
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</footer>