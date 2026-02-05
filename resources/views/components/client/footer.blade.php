@props(['categories'])
<!-- footer -->
<footer class="bg-gray-200 py-8 mt-2">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap md:gap-4 lg:gap-0 py-4 mb-6">
            <div class="w-full md:w-full lg:w-1/3 flex flex-col gap-4 mb-6">
                <h6 class="text-lg font-semibold text-gray-800">Categories</h6>
                <div class="flex flex-wrap">
                    <div class="w-1/2">
                        <!-- list -->
                        <ul class="flex flex-col gap-2">
                            @foreach($categories as $cat)
                            <li><a href="#!" class="inline-block text-gray-600 hover:text-green-600 transition-colors duration-200">{{$cat->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    
                </div>
            </div>
            <div class="w-full md:w-full lg:w-2/3">
                <div class="flex flex-wrap">
                    <div class="w-1/2 sm:w-1/2 md:w-1/4 flex flex-col gap-4 mb-6">
                        <h6 class="text-lg font-semibold text-gray-800">Get to know us</h6>
                        <!-- list -->
                        <ul class="flex flex-col gap-2">
                            <li><a href="#!" class="inline-block text-gray-600 hover:text-green-600 transition-colors duration-200">LocalMart</a></li>
                            <li><a href="#!" class="inline-block text-gray-600 hover:text-green-600 transition-colors duration-200">Team</a></li>
                            <li><a href="#!" class="inline-block text-gray-600 hover:text-green-600 transition-colors duration-200">Blog</a></li>
                        </ul>
                    </div>
                    <div class="w-1/2 sm:w-1/2 md:w-1/4 flex flex-col gap-4">
                        <h6 class="text-lg font-semibold text-gray-800">Freshcart programs</h6>
                        <ul class="flex flex-col gap-2">
                            <!-- list -->
                            <li><a href="#!" class="inline-block text-gray-600 hover:text-green-600 transition-colors duration-200">Freshcart programs</a></li>
                            <li><a href="#!" class="inline-block text-gray-600 hover:text-green-600 transition-colors duration-200">Gift Cards</a></li>
                            <li><a href="#!" class="inline-block text-gray-600 hover:text-green-600 transition-colors duration-200">Promos & Coupons</a></li>
                            <li><a href="#!" class="inline-block text-gray-600 hover:text-green-600 transition-colors duration-200">Freshcart Ads</a></li>
                            <li><a href="#!" class="inline-block text-gray-600 hover:text-green-600 transition-colors duration-200">Careers</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t py-4 border-gray-300">
            <div class="flex flex-col md:flex-row items-center gap-3">
                <div class="md:w-1/2 text-center md:text-left">
                    <span class="text-sm text-gray-500">
                        © <span id="copyright"></span> FreshCart TailwindCSS eCommerce HTML Template. Powered by
                        <a href="https://codescandy.com/" target="_blank" class="text-green-600 hover:text-green-700 transition-colors duration-200">Codescandy</a>.
                    </span>
                </div>
                <div class="md:w-1/2 flex md:justify-end justify-center items-center">
                    <div class="flex flex-row gap-5 items-center">
                        <div class="text-gray-500">Follow us on</div>
                        <ul class="flex items-center justify-end text-sm gap-1">
                            <li>
                                <a href="#!" class="inline-flex justify-center items-center h-8 w-8 border border-gray-300 rounded text-gray-600 hover:border-green-600 hover:text-green-600 transition-all duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-facebook" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#!" class="inline-flex justify-center items-center h-8 w-8 border border-gray-300 rounded text-gray-600 hover:border-green-600 hover:text-green-600 transition-all duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-x" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 4l11.733 16h4.267l-11.733 -16z" />
                                        <path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#!" class="inline-flex justify-center items-center h-8 w-8 border border-gray-300 rounded text-gray-600 hover:border-green-600 hover:text-green-600 transition-all duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-instagram" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 4m0 4a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" />
                                        <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        <path d="M16.5 7.5l0 .01" />
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