@extends('layouts.frontend-layout')
@section('title', 'Offer')

@section('content')
    @include('components.breadcrmb')
    <div class=" w-full xl:px-20 lg:px-[5.5rem] 2md:px-[5.5rem] md:px-[3rem] sm:px-[1.5rem] 4xs:px-7 px-5 py-10">
        <div class="flex justify-center">
            <div class="grid xl:grid-cols-3 lg:grid-cols-2 grid-cols-1 gap-x-5 gap-y-7">
                @include('pages.offer.components.offer-items')
                @include('pages.offer.components.offer-items')
                @include('pages.offer.components.offer-items')
                @include('pages.offer.components.offer-items')
                @include('pages.offer.components.offer-items')
                @include('pages.offer.components.offer-items')
                @include('pages.offer.components.offer-items')
                @include('pages.offer.components.offer-items')
                @include('pages.offer.components.offer-items')
            </div>
        </div>
        <div class="text-center pt-5">
            <button type="button" class="text-lg text-white bg-green-500/70 hover:bg-green-500/90 px-5 py-2 rounded-xl">
                Load More
            </button>
        </div>
    </div>
@endsection
