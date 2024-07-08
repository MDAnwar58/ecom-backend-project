<div class=" col-span-12 xl:col-span-4 bg-gray-50 w-full max-xl:px-6 max-w-3xl xl:max-w-lg mx-auto lg:pl-8 py-24">
    <h2 class="font-manrope font-bold text-3xl leading-10 text-black pb-8 border-b border-gray-300">
        Order Summary</h2>
    <div class="mt-8">
        <div class="flex items-center justify-between pb-6">
            <p class="font-normal text-lg leading-8 text-black">3 Items</p>
            <p class="font-medium text-lg leading-8 text-black">$480.00</p>
        </div>
        <form>
            <label class="flex  items-center mb-1.5 text-gray-600 text-sm font-medium">Shipping
            </label>
            <div class="flex pb-6">
                <div class="relative w-full">
                    <div class=" absolute left-0 top-0 py-3 px-4">
                        <span class="font-normal text-base text-gray-300">Second Delivery</span>
                    </div>
                    <input type="text"
                        class="block w-full h-11 pr-10 pl-36 min-[500px]:pl-52 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-white border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-gray-400"
                        placeholder="$5.00">
                    <button id="dropdown-button" data-target="dropdown-delivery"
                        class="dropdown-toggle flex-shrink-0 z-10 inline-flex items-center py-4 px-4 text-base font-medium text-center text-gray-900 bg-transparent  absolute right-0 top-0 pl-2 "
                        type="button">
                        <svg class="ml-2 my-auto" width="12" height="7" viewBox="0 0 12 7" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1 1.5L4.58578 5.08578C5.25245 5.75245 5.58579 6.08579 6 6.08579C6.41421 6.08579 6.74755 5.75245 7.41421 5.08579L11 1.5"
                                stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>
                    </button>
                    <div id="dropdown-delivery" aria-labelledby="dropdown-delivery"
                        class="z-20 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 absolute top-10 bg-white right-0">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Shopping</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Images</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">News</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Finance</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <label class="flex items-center mb-1.5 text-gray-400 text-sm font-medium">Promo Code
            </label>
            <div class="flex pb-4 w-full">
                <div class="relative w-full ">
                    <div class=" absolute left-0 top-0 py-2.5 px-4 text-gray-300">

                    </div>
                    <input type="text"
                        class="block w-full h-11 pr-11 pl-5 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-white border border-gray-300 rounded-lg placeholder-gray-500 focus:outline-gray-400 "
                        placeholder="xxxx xxxx xxxx">
                    <button id="dropdown-button" data-target="dropdown"
                        class="dropdown-toggle flex-shrink-0 z-10 inline-flex items-center py-4 px-4 text-base font-medium text-center text-gray-900 bg-transparent  absolute right-0 top-0 pl-2 "
                        type="button"><svg class="ml-2 my-auto" width="12" height="7" viewBox="0 0 12 7"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1 1.5L4.58578 5.08578C5.25245 5.75245 5.58579 6.08579 6 6.08579C6.41421 6.08579 6.74755 5.75245 7.41421 5.08579L11 1.5"
                                stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>
                    </button>
                    <div id="dropdown"
                        class="absolute top-10 right-0 z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Shopping</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Images</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">News</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Finance</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="flex items-center border-b border-gray-200">
                <button
                    class="rounded-full w-full bg-black py-3 px-4 text-white text-sm font-semibold text-center mb-8 transition-all duration-500 hover:bg-black/80">Apply</button>
            </div>
            <div class="flex items-center justify-between py-8">
                <p class="font-medium text-xl leading-8 text-black">3 Items</p>
                <p class="font-semibold text-xl leading-8 text-green-600">$485.00</p>
            </div>
            <button
                class="w-full text-center bg-green-400 rounded-full py-4 px-6 font-semibold text-lg text-white transition-all duration-500 hover:bg-green-500">Checkout</button>
        </form>
    </div>
</div>
