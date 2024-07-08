@extends('layouts.guest-layout')
@section('title', 'Sign Up')

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
    <div class="h-[100vh] flex">
        @include('auth.components.auth-banner-svg')
        <div
            class="auth-card xl:w-4/12 lg:w-5/12 sm:w-6/12 2xs:w-[27rem] 4xs:w-[90%] w-[95%] order-2 sm:bg-white bg-white/80 sm:py-0 py-5 sm:rounded-none rounded-md sm:shadow-none shadow-lg sm:border-0 border flex items-center sm:relative absolute sm:top-0 top-1/2 sm:left-0 left-1/2">
            <div class="w-full lg:px-20 2md:px-16 md:px-10 px-5">
                <form id="sign-up-form" action="{{ route('sign.up') }}" method="POST">
                    @csrf
                    <h1 class="text-gray-800 font-bold text-2xl">Hello Again!</h1>
                    <p class="text-sm font-normal text-gray-600 mb-3">Welcome Back</p>
                    @include('auth.components.name')
                    @include('auth.components.email')
                    @include('auth.components.password')
                    @include('auth.components.password_confirmation')
                    <button type="submit"
                        class="block w-full bg-green-400 mt-4 py-3 rounded-2xl text-white font-semibold mb-2 uppercase">Sign
                        Up</button>
                </form>


                <div class="w-full flex-1">
                    <div class="my-5 border-b text-center">
                        <div
                            class="leading-none px-2 inline-block text-sm text-gray-600 tracking-wide font-medium sm:bg-white transform translate-y-1/2">
                            Or sign up with e-mail
                        </div>
                    </div>
                    @include('auth.components.google-sign-up')

                    <div class=" text-center mt-3">
                        <span class="text-sm ml-2 text-gray-500">Already have an account? <a href="{{ route('sign.in') }}"
                                class=" text-green-400 hover:text-green-500 group/sign-in">Sign
                                In <span
                                    class="hidden group-hover/sign-in:inline-flex group-hover/sign-in:transform group-hover/sign-in:translate-x-0.5 group-hover/sign-in:text-green-500">&#8594;</span></a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const signUpForm = document.getElementById('sign-up-form');
        const url = signUpForm.getAttribute('action');
        const nameError = document.getElementById('name-error');
        const emailError = document.getElementById('email-error');
        const passwordError = document.getElementById('password-error');
        const passwordConfirmationError = document.getElementById('password-confirmation-error');

        const password = document.getElementById('password');
        const passwordHandle = document.getElementById('password-handle');
        const passwordConfirmation = document.getElementById('password_confirmation');
        const passwordConfirmationHandle = document.getElementById('password-confirmation-handle');

        function resetForm() {
            signUpForm.reset();
        }
        resetForm();

        signUpForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            try {
                const formData = new FormData(signUpForm);
                const response = await axios.post(url, formData);
                if (response.data.status === "success") {
                    successMsg(response.data.msg)
                    setTimeout(() => {
                        window.location.href = '/';
                    }, 2000);
                }
            } catch (error) {
                console.log(error.response);
                if (error.response.data.errors.name) {
                    nameError.classList.remove("hidden");
                    nameError.innerText = error.response.data.errors.name;
                }
                if (error.response.data.errors.email) {
                    emailError.classList.remove("hidden")
                    emailError.innerText = error.response.data.errors.email;
                }
                if (error.response.data.errors.password) {
                    passwordError.classList.remove("hidden")
                    passwordError.innerText = error.response.data.errors.password;
                }
                if (error.response.data.errors.password_confirmation) {
                    passwordConfirmationError.classList.remove("hidden")
                    passwordConfirmationError.innerText = error.response.data.errors.password_confirmation;
                }
            }
        });

        function nameOnChangeHandle() {
            nameError.classList.add("hidden")
        }

        function emailOnChangeHandle() {
            emailError.classList.add("hidden")
        }

        function passwordOnChangeHandle() {
            passwordError.classList.add("hidden")
        }

        function passwordConfirmationOnChangeHandle() {
            passwordConfirmationError.classList.add("hidden")
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

        function passwordConfirmationHandleBtn() {
            if (passwordConfirmation.type === 'password') {
                passwordConfirmationHandle.innerHTML = `<i class="fi fi-bs-low-vision"></i>`;
                passwordConfirmation.type = "text";
            } else {
                passwordConfirmationHandle.innerHTML = `<i class="fi fi-bs-eye"></i>`;
                passwordConfirmation.type = "password";
            }
        }
    </script>

@endsection
