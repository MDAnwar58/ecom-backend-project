@extends('layouts.frontend-layout')
@section('title', 'Product Details')

@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/collection-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/product-related-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}" />
    <style>
        .nav-for-slider .swiper-slide-thumb-active img {
            border-color: #0E9F6E;
        }
    </style>
@endsection
@section('content')
    @include('components.breadcrmb')

    <section class="py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                @include('pages.product-details.components.product-image-slider')
                @include('pages.product-details.components.product-information')
            </div>
        </div>

        <div class="xl:px-20 lg:px-[5.5rem] 2md:px-[5.5rem] md:px-[3rem] sm:px-[1.5rem] 4xs:px-7 px-5 pt-20">
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                @include('pages.product-details.components.tab')
            </div>
            <div id="default-styled-tab-content">
                @include('pages.product-details.components.product-description')
                @include('pages.product-details.components.product-reviews')
                @include('pages.product-details.components.product-comments')
            </div>

            <div class=" pt-10">
                <div class=" relative">
                    <div class=" text-2xl text-gray-500 font-bold">Related Products</div>
                    <span class=" w-[191px] h-[2px] bg-green-500 inline-flex absolute bottom-0 start-0"></span>
                </div>
                <div class="pt-5">
                    <div class="owl-carousel owl-related-product-carousel owl-theme">
                        <div class="item sm:block flex justify-center">
                            @include('components.product')
                        </div>
                        <div class="item">
                            @include('components.product')
                        </div>
                        <div class="item">
                            @include('components.product')
                        </div>
                        <div class="item">
                            @include('components.product')
                        </div>
                        <div class="item">
                            @include('components.product')
                        </div>
                        <div class="item">
                            @include('components.product')
                        </div>
                        <div class="item">
                            @include('components.product')
                        </div>
                        <div class="item">
                            @include('components.product')
                        </div>
                        <div class="item">
                            @include('components.product')
                        </div>
                        <div class="item">
                            @include('components.product')
                        </div>
                        <div class="item">
                            @include('components.product')
                        </div>
                        <div class="item">
                            @include('components.product')
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/product-detials-slider.js') }}"></script>

    <script>
        $('.owl-related-product-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                610: {
                    items: 2
                },
                1020: {
                    items: 3
                },
                1275: {
                    items: 4
                }
            }
        })
    </script>
@endsection
