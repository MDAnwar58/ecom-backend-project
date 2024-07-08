@extends('layouts.guest-layout')
@section('title', 'Sign In')

@section('css')
    <style>
        @media only screen and (max-width: 640px) {
            .auth-card {
                transform: translate(-50%, -50%);
            }
        }
    </style>
@endsection

@section('content')
    <div class="h-[100vh] sm:flex block sm:static relative">
        @include('auth.components.auth-banner-svg')
        <div
            class="auth-card xl:w-4/12 lg:w-5/12 sm:w-6/12 2xs:w-[27rem] 4xs:w-[90%] w-[95%] order-2 sm:bg-white bg-white/80 sm:py-0 py-5 sm:rounded-none rounded-md sm:shadow-none shadow-lg sm:border-0 border flex items-center sm:relative absolute sm:top-0 top-1/2 sm:left-0 left-1/2">
            <div class=" w-full lg:px-20 2md:px-16 md:px-10 px-5">
                <form id="sign-in-form" action="{{ route('sign.in') }}" method="POST">
                    @csrf
                    @include('auth.components.auth-logo')
                    @include('auth.components.email')
                    @include('auth.components.password')
                    <div class=" text-end">
                        <a href="{{ route('forget.password') }}" class=" text-green-400 underline">forget
                            password?</a>
                    </div>
                    <button type="submit"
                        class="block w-full bg-green-400 mt-2 py-3 rounded-2xl text-white font-semibold mb-2 uppercase">Sign
                        In</button>
                </form>
                <div class="w-full flex-1">
                    <div class="my-5 border-b text-center">
                        <div
                            class="leading-none px-2 inline-block text-sm text-gray-600 tracking-wide font-medium sm:bg-white transform translate-y-1/2">
                            Or sign in with e-mail
                        </div>
                    </div>
                    @include('auth.components.google-sign-in')

                    <div class=" text-center mt-3">
                        <span class="text-sm ml-2 text-gray-500">Create an account? <a href="{{ route('sign.up') }}"
                                class=" text-green-400 hover:text-green-500 group/sign-up">Sign
                                Up <span
                                    class="hidden group-hover/sign-up:inline-flex group-hover/sign-up:transform group-hover/sign-up:translate-x-0.5 group-hover/sign-up:text-green-500">&#8594;</span></a></span>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
            const signInForm = document.getElementById('sign-in-form');
            const url = signInForm.getAttribute('action');
            const emailError = document.getElementById('email-error');
            const passwordError = document.getElementById('password-error');
            const password = document.getElementById('password');
            const passwordHandle = document.getElementById('password-handle');


            function resetForm() {
                signInForm.reset();
            }
            resetForm();

            signInForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                try {
                    const formData = new FormData(signInForm);
                    const response = await axios.post(url, formData);
                    if (response.data.status === "sign in") {
                        const signOutUrl = sessionStorage.getItem("sign_out_url");
                        if (signOutUrl === null) {
                            window.location.href = '/';
                        } else {
                            window.location.href = signOutUrl;
                        }
                    }
                    if (response.data.status === "password_fail") {
                        passwordError.classList.remove("hidden")
                        passwordError.innerText = response.data.msg;
                    }
                } catch (error) {
                    if (error.response.data.errors.email) {
                        emailError.classList.remove("hidden")
                        emailError.innerText = error.response.data.errors.email;
                    }
                    if (error.response.data.errors.password) {
                        passwordError.classList.remove("hidden")
                        passwordError.innerText = error.response.data.errors.password;
                    }
                }
            });

            function emailOnChangeHandle() {
                emailError.classList.add("hidden")
            }

            function passwordOnChangeHandle() {
                passwordError.classList.add("hidden")
            }

            function passwordHandleBtn() {
                if (password.type === 'password') {
                    passwordHandle.innerHTML = `<i class="fi fi-bs-low-vision"></i>`;
                    password.type = "text";
                } else {
                    passwordHandle.innerHTML = `<i class="fi fi-bs-eye"></i>`;
                    password.type = "password";
                }
            }
        </script>
    @endsection
