@extends('layouts.frontend-layout')

@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/collection-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}" />
@endsection
@section('content')
    @include('pages.home.components.banner')
    <div class=" xl:px-20 lg:px-[5.5rem] 2md:px-[5.5rem] md:px-[3rem] sm:px-[1.5rem] 4xs:px-7 px-5 sm:py-3 py-1">
        @include('pages.home.components.our-category')
        @include('pages.home.components.offer-banner')
        @include('pages.home.components.product-conllection')
    </div>


    @include('components.product-details-modal')
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/product-detials-slider.js') }}"></script>

    <script>
        $('.owl-offer-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            items: 1,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            animateOut: 'slideOutDown',
            animateIn: 'flipInX',
            dots: false,
            autoHeight: false,
        })

        $('.owl-collection-carousel').owlCarousel({
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
