<div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
    <ul class="flex items-center">
        <li class="me-5 pt-2">
            <a data-drawer-target="drawer-right-cart" data-drawer-show="drawer-right-cart" data-drawer-placement="right"
                aria-controls="drawer-right-cart"
                class="relative inline-flex items-center p-[0.1rem] text-sm font-medium text-center text-gray-700 focus:outline-none">
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                    clip-rule="evenodd">
                    <path
                        d="M12 21.593c-5.63-5.539-11-10.297-11-14.402 0-3.791 3.068-5.191 5.281-5.191 1.312 0 4.151.501 5.719 4.457 1.59-3.968 4.464-4.447 5.726-4.447 2.54 0 5.274 1.621 5.274 5.181 0 4.069-5.136 8.625-11 14.402m5.726-20.583c-2.203 0-4.446 1.042-5.726 3.238-1.285-2.206-3.522-3.248-5.719-3.248-3.183 0-6.281 2.187-6.281 6.191 0 4.661 5.571 9.429 12 15.809 6.43-6.38 12-11.148 12-15.809 0-4.011-3.095-6.181-6.274-6.181" />
                </svg>
                <span class="sr-only">Favorite</span>
                <div style="font-size: 10px;  line-height: 1rem;"
                    class="absolute inline-flex items-center justify-center py-[0.05rem] px-[0.20rem] font-bold text-white bg-green-400 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">
                    20</div>
            </a>

        </li>
        <li class="me-5 pt-2">
            <a href="{{ route('cart') }}"
                class="relative inline-flex
                        items-center p-[0.1rem] text-sm font-medium text-center text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path
                        d="M4.559 7l4.701-4.702c.198-.198.459-.298.72-.298.613 0 1.02.505 1.02 1.029 0 .25-.092.504-.299.711l-3.26 3.26h-2.882zm12 0h2.883l-4.702-4.702c-.198-.198-.459-.298-.72-.298-.613 0-1.02.505-1.02 1.029 0 .25.092.504.299.711l3.26 3.26zm3.703 4l-.016.041-3.598 8.959h-9.296l-3.597-8.961-.016-.039h16.523zm3.738-2h-24v2h.643c.535 0 1.021.304 1.256.784l4.101 10.216h12l4.102-10.214c.234-.481.722-.786 1.256-.786h.642v-2zm-14 5c0-.552-.447-1-1-1s-1 .448-1 1v3c0 .552.447 1 1 1s1-.448 1-1v-3zm3 0c0-.552-.447-1-1-1s-1 .448-1 1v3c0 .552.447 1 1 1s1-.448 1-1v-3zm3 0c0-.552-.447-1-1-1s-1 .448-1 1v3c0 .552.447 1 1 1s1-.448 1-1v-3z" />
                </svg>
                <span class="sr-only">Cart</span>
                <div style="font-size: 10px;  line-height: 1rem;"
                    class="absolute inline-flex items-center justify-center py-[0.05rem] px-[0.20rem] font-bold text-white bg-green-400 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">
                    20</div>
            </a>

        </li>
        @if ($user)
            <li>
                <button type="button"
                    class="flex text-sm bg-gray-800 border-2 border-green-500 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                    data-dropdown-placement="bottom-end">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full"
                        src="https://images.unsplash.com/flagged/photo-1556470234-36a5389f905a?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="user photo">
                </button>
                <!-- Dropdown menu -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                    id="user-dropdown">
                    <div class="px-4 py-3">
                        <span
                            class="block text-sm font-semibold text-gray-900 dark:text-white">{{ $user->name }}</span>
                        <span
                            class="block text-sm  text-green-500 underline font-semibold truncate dark:text-gray-400">{{ $user->email }}</span>
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Earnings</a>
                        </li>
                        <li>
                            <a href="{{ route('sign.out') }}" onclick="getUrl()"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                                out</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif
    </ul>
</div>
