<div class="{{ Route::is('sign.in') ? '' : 'mb-4' }}">
    <div class="flex items-center border-2 py-2 px-3 rounded-2xl bg-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                clip-rule="evenodd" />
        </svg>
        <input class="pl-2 outline-none border-none w-full focus:ring-0  focus:bg-white"
            onkeyup="passwordOnChangeHandle()" type="password" name="password" id="password"
            placeholder={{ Route::is('reset.password') ? 'New Password' : 'Password' }} />
        <button type="button" onclick="passwordHandleBtn()" class=" text-gray-400 px-[0.20rem]">
            <span id="password-handle">
                <i class="fi fi-bs-eye"></i>
            </span>
        </button>
    </div>
    <span id="password-error" class=" text-red-500 text-xs hidden ps-5">name</span>
</div>
