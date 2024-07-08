<nav class=" bg-gray-100 sticky bottom-0 pb-3 pt-4 md:hidden block sm:px-20 xs:px-16 px-5 relative z-50">
    <ul class="flex justify-between">
        <li>
            <a href="{{ route('home') }}"
                class="{{ Route::is('home') ? 'bg-green-400 text-white' : ' hover:bg-green-400 hover:text-white' }}  px-3 pb-1 pt-2 rounded-xl text-3xl">
                <i class="fi fi-bs-home"></i>
            </a>
        </li>
        <li>
            <a href="{{ route('products') }}"
                class="{{ Route::is('products') ? 'bg-green-400 text-white' : ' hover:bg-green-400 hover:text-white' }} px-3 pb-1 pt-2 rounded-xl  text-3xl">
                <i class="fi fi-bs-boxes"></i>
            </a>
        </li>
        <li>
            <a href="{{ route('home') }}"
                class="{{ Route::is('home') ? 'bg-green-400 text-white' : ' hover:bg-green-400 hover:text-white' }} px-3 pb-1 pt-2 rounded-xl  text-3xl">
                <i class="fi fi-bs-category"></i>
            </a>
        </li>
        <li>
            <a href="{{ route('offers') }}"
                class="{{ Route::is('offers') ? 'bg-green-400 text-white' : ' hover:bg-green-400 hover:text-white' }} px-3 pb-1 pt-2 rounded-xl  text-3xl">
                <i class="fi fi-bs-badge-percent"></i>
            </a>
        </li>
    </ul>
    <a href="{{ route('cart') }}"
        class=" absolute 2xs:top-[-30px] top-[-35px] left-1/2 bg-gray-200 hover:bg-gray-300 border-[3px] border-green-500 pt-[1rem] pb-3 px-5 rounded-full"
        style=" transform: translateX(-50%)">
        <i class="fi fi-bs-cart-shopping-fast text-2xl"></i>

        <div class=" relative">
            <span class="sr-only">Cart</span>
            <div style="font-size: 10px;  line-height: 1rem;"
                class="inline-flex absolute items-center justify-center py-[0.05rem] px-[0.20rem] font-bold text-white bg-green-500 border-2 border-white rounded-full -top-10 -end-3 dark:border-gray-900">
                20</div>
        </div>
    </a>
</nav>
