@extends('layouts.guest-layout')
@section('title', 'Reset Password')

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
    <div class="h-[100vh] sm:flex sm:static relative">
        @include('auth.components.auth-banner-svg')
        <div
            class="auth-card xl:w-4/12 lg:w-5/12 sm:w-6/12 2xs:w-[27rem] 4xs:w-[90%] w-[95%] order-2 sm:bg-white bg-white/80 sm:py-0 py-5 sm:rounded-none rounded-md sm:shadow-none shadow-lg sm:border-0 border flex items-center sm:relative absolute sm:top-0 top-1/2 sm:left-0 left-1/2">
            <div class=" w-full lg:px-20 2md:px-16 md:px-10 px-5">
                <form id="reset-form" action="{{ route('reset.password.request') }}" method="POST">
                    @csrf
                    @include('auth.components.auth-logo')
                    @include('auth.components.password')
                    @include('auth.components.password_confirmation')
                    <button type="submit"
                        class="block w-full bg-green-400 mt-2 py-3 rounded-2xl text-white font-semibold mb-2 uppercase">Reset</button>
                </form>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
            const resetForm = document.getElementById('reset-form');
            const url = resetForm.getAttribute('action');
            const passwordError = document.getElementById('password-error');
            const passwordConfirmationError = document.getElementById('password-confirmation-error');

            const password = document.getElementById('password');
            const passwordHandle = document.getElementById('password-handle');
            const passwordConfirmation = document.getElementById('password_confirmation');
            const passwordConfirmationHandle = document.getElementById('password-confirmation-handle');
            // Get the URL parameter 'email'
            const urlParams = new URLSearchParams(window.location.search);
            const email = urlParams.get('email');

            // function resetForm() {
            //     resetForm.reset()
            // }
            // resetForm()

            resetForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                try {
                    const formData = new FormData(resetForm);
                    const response = await axios.post(`${url}?email=${email}`, formData);
                    console.log(response.data);
                    if (response.data.status === "success") {
                        console.log(response.data.msg);
                        successMsg(response.data.msg);
                        setTimeout(() => {
                            window.location.href = '/sign-in';
                        }, 2000);
                    }
                } catch (error) {
                    console.error(error.response);
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
