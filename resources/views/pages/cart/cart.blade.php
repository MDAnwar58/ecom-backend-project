@extends('layouts.frontend-layout')
@section('title', 'Cart List')

@section('content')
    @include('components.breadcrmb')
    <section
        class=" relative z-10 after:contents-[''] after:absolute after:z-0 after:h-full xl:after:w-1/3 after:top-0 after:right-0 after:bg-gray-50 xl:pb-0 md:pb-10 pb-16">
        <div class="w-full max-w-7xl px-4 md:px-5 lg-6 mx-auto relative z-10">
            <div class="grid grid-cols-12">
                @include('pages.cart.components.shipping-cart')
                @include('pages.cart.components.order-summery')
            </div>
        </div>
    </section>


@endsection
