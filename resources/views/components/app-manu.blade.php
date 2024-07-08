<nav class=" bg-green-400 dark:bg-green-700 md:block hidden shadow-md">
    <div class="px-20 py-3">
        <div class="flex items-center justify-end">
            <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                <li>
                    <a href="{{ route('home') }}"
                        class="{{ Route::is('home') ? 'text-white font-semibold' : 'text-gray-900 dark:text-white hover:text-white hover:underline' }} dark:text-white text-[1.13rem]"
                        aria-current="page">Home</a>
                </li>
                <li>
                    <a href="{{ route('products') }}"
                        class="{{ Route::is('products') || Route::is('product.show') ? 'text-white font-semibold' : 'text-gray-900 dark:text-white hover:text-white hover:underline' }} text-[1.13rem]">Products</a>
                </li>
                <li>
                    <a href="{{ route('offers') }}"
                        class="{{ Route::is('offers') ? 'text-white font-semibold' : 'text-gray-900 dark:text-white hover:text-white hover:underline' }} text-[1.13rem]">Offers</a>
                </li>
                <li>
                    <a href="{{ route('contact') }}"
                        class="{{ Route::is('contact') ? 'text-white font-semibold' : 'text-gray-900 dark:text-white hover:text-white hover:underline' }} text-[1.13rem]">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
