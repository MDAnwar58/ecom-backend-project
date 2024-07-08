@extends('layouts.frontend-layout')
@section('title', 'Products')

@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}" />
@endsection

@section('content')
    @include('components.breadcrmb')
    <div class=" xl:px-20 2lg:px-5 2md:px-20 md:px-10 px-5 py-10 flex gap-5">
        <div class=" 2lg:w-[20%] 2lg:block hidden">
            @include('pages.products.components.sidebar')
        </div>
        <div class=" 2lg:w-[80%] w-full">
            <div class="grid xl:grid-cols-3 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 lg:gap-3 gap-5">
                <div class=" sm:mx-0 mx-auto">
                    @include('components.product')
                </div>
                <div class=" sm:mx-0 mx-auto">
                    @include('components.product')
                </div>
                <div class=" sm:mx-0 mx-auto">
                    @include('components.product')
                </div>
                <div class=" sm:mx-0 mx-auto">
                    @include('components.product')
                </div>
                <div class=" sm:mx-0 mx-auto">
                    @include('components.product')
                </div>
                <div class=" sm:mx-0 mx-auto">
                    @include('components.product')
                </div>
                <div class=" sm:mx-0 mx-auto">
                    @include('components.product')
                </div>
                <div class=" sm:mx-0 mx-auto">
                    @include('components.product')
                </div>
                <div class=" sm:mx-0 mx-auto">
                    @include('components.product')
                </div>
                <div class=" sm:mx-0 mx-auto">
                    @include('components.product')
                </div>
                <div class=" sm:mx-0 mx-auto">
                    @include('components.product')
                </div>
                <div class=" sm:mx-0 mx-auto">
                    @include('components.product')
                </div>
                <div class=" sm:mx-0 mx-auto">
                    @include('components.product')
                </div>
            </div>
            <div class=" sm:flex justify-between items-center pt-3 sm:pb-0 pb-5 text-center">
                <span class="text-sm text-gray-700 dark:text-gray-400">
                    Showing <span class="font-semibold text-gray-900 dark:text-white">1</span> to <span
                        class="font-semibold text-gray-900 dark:text-white">10</span> of <span
                        class="font-semibold text-gray-900 dark:text-white">100</span> Entries
                </span>
                @include('pages.products.components.pagination')
            </div>
        </div>
    </div>

    @include('pages.products.components.drewar-sidebar')
    @include('components.product-details-modal')
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/product-detials-slider.js') }}"></script>
@endsection
