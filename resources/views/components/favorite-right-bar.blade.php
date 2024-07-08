<div id="drawer-right-cart"
    class="fixed top-0 right-0 z-40 h-screen overflow-y-auto transition-transform translate-x-full bg-white sm:w-[30rem] w-full dark:bg-gray-800"
    tabindex="-1" aria-labelledby="drawer-right-label">
    <div class=" bg-green-500 px-5">
        <h5 id="drawer-right-label"
            class="inline-flex items-center mb-4 text-base font-semibold text-white dark:text-gray-400 pt-3">
            <svg class="w-7 h-7 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="text-xl font-semibold">Your cart</span>
        </h5>
        <button type="button" data-drawer-hide="drawer-right-cart" aria-controls="drawer-right-cart"
            class="text-white bg-transparent hover:bg-red-500 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
    </div>
    <div class=" pb-20">
        <div class="flex flex-col max-w-3xl p-6 space-y-4 sm:p-10 dark:bg-gray-50 dark:text-gray-800">
            <ul class="flex flex-col divide-y dark:divide-gray-300">
                @include('components.favorite-items')
                @include('components.favorite-items')
                @include('components.favorite-items')
                @include('components.favorite-items')
                @include('components.favorite-items')
            </ul>
            {{-- <div class="space-y-1 text-right">
                <p>Total amount:
                    <span class="font-semibold">357 €</span>
                </p>
                <p class="text-sm dark:text-gray-600">Not including taxes and shipping costs</p>
            </div> --}}
            {{-- <div class="flex justify-end space-x-4">
                <button type="button" class="px-6 py-2 border rounded-md dark:border-violet-600">Back
                    <span class="sr-only sm:not-sr-only">to shop</span>
                </button>
                <button type="button"
                    class="px-6 py-2 border rounded-md dark:bg-violet-600 dark:text-gray-50 dark:border-violet-600">
                    <span class="sr-only sm:not-sr-only">Continue to</span>Checkout
                </button>
            </div> --}}
        </div>
    </div>
</div>
