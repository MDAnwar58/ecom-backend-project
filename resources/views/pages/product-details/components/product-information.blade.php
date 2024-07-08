<div class="flex justify-center items-center">
    <div class="pro-detail w-full max-lg:max-w-[608px] lg:pl-8 xl:pl-16 max-lg:mx-auto max-lg:mt-8">
        <div class="flex items-center justify-between gap-6 mb-6">
            <div class="text">
                <h2 class="font-manrope font-bold text-3xl leading-10 text-gray-900 mb-2">Yellow Summer
                    Travel
                    Bag
                </h2>
                <p class="font-normal text-base text-gray-500">ABS LUGGAGE</p>
            </div>
            @include('pages.product-details.components.favorite-btn')
        </div>

        <div class="flex flex-col min-[400px]:flex-row min-[400px]:items-center mb-8 gap-y-3">
            @include('pages.product-details.components.product-price')
            @include('pages.product-details.components.product-rating')
        </div>
        <p class="font-medium text-lg text-gray-900 mb-2">Color</p>
        @include('pages.product-details.components.product-color-select')
        <p class="font-medium text-lg text-gray-900 mb-2">Size (KG)</p>
        @include('pages.product-details.components.product-weight')
        <div class="flex items-center flex-col min-[400px]:flex-row gap-3 mb-3 min-[400px]:mb-8">
            @include('pages.product-details.components.product-increment-decrement-input')
            @include('pages.product-details.components.add-to-cart-btn')
        </div>
        @include('pages.product-details.components.buy-now-btn')
    </div>
</div>
