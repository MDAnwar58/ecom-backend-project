@extends('layouts.frontend-layout')
@section('title', 'Contact')

@section('content')
    @include('components.breadcrmb')
    <div class=" xl:px-20 lg:px-[5.5rem] 2md:px-[5.5rem] md:px-[3rem] sm:px-[1.5rem] 4xs:px-7 px-5 pt-10 pb-20">
        <div class="lg:flex gap-5">
            @include('pages.contact.components.contact-information')

            @include('pages.contact.components.contact-form')
        </div>
    </div>
@endsection
