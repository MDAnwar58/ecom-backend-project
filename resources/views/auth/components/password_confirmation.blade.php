<div class="mb-4">
    <div class="flex items-center border-2 py-2 px-3 rounded-2xl bg-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
        </svg>
        <input class="pl-2 outline-none border-none w-full focus:ring-0" onkeyup="passwordConfirmationOnChangeHandle()"
            type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" />
        <button type="button" onclick="passwordConfirmationHandleBtn()" class=" text-gray-400 px-[0.20rem]">
            <span id="password-confirmation-handle">
                <i class="fi fi-bs-eye"></i>
            </span>
        </button>
    </div>
    <span id="password-confirmation-error" class=" text-red-500 text-xs hidden ps-5">name</span>
</div>
