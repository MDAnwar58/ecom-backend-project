@extends('layouts.admin-layout');
@section('title', 'Brand')


@section('content')
    <div class="px-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="flex items-center justify-between pb-3">
                <span>@yield('title') List</span>


                <button class=" bg-gray-500 text-white px-5 py-2 rounded-lg">Create</button>
            </div>
            @include('admin.brand.components.table')
        </div>
    </div>
@endsection
