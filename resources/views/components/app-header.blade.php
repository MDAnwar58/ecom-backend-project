<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div
        class="sm:flex flex-wrap justify-between items-center xl:px-20 lg:px-[5.5rem] 2md:px-[5.5rem] md:px-[3rem] sm:px-[1.5rem] 4xs:px-7 px-5 sm:py-3 py-1">
        <div class="sm:flex text-md text-center text-gray-500">
            <div>anwar.saeed656@gmail.com</div>
            <div class="ms-3 sm:pt-0 pt-1">+8801918725999</div>
        </div>
        <div class="flex items-center space-x-6 rtl:space-x-reverse sm:justify-normal justify-center sm:pt-0 py-1">
            {{-- <a href="tel:5541251234" class="text-sm  text-gray-500 dark:text-white hover:underline">(555) 412-1234</a> --}}
            @if (isset($user))
                <a href="" class="text-sm  text-green-400 dark:text-green-500 hover:underline"
                    target="_blank">Facebook Page</a>
            @else
                <a href="{{ route('sign.in') }}" class="text-sm  text-green-400 dark:text-green-500 hover:underline">Sign
                    In</a>
            @endif
        </div>
    </div>
</nav>
