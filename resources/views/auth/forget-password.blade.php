@extends('layouts.guest-layout')
@section('title', 'Forget Password')

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
                <form class="forget-form" action="{{ route('forgot.password.send') }}" method="POST">
                    @csrf
                    @include('auth.components.auth-logo')
                    <p id="send-msg" class="text-md text-gray-500 mb-3 font-medium hidden"></p>
                    @include('auth.components.email')
                    <button type="submit"
                        class="block w-full bg-green-400 mt-2 py-3 rounded-2xl text-white font-semibold mb-2 uppercase">Send
                        Email</button>
                </form>
            </div>
        </div>
    @endsection

    @section('scripts')

        <script>
            const forgetForm = document.querySelector('.forget-form');
            const url = forgetForm.getAttribute('action');
            const emailError = document.getElementById('email-error');
            const sendMsg = document.getElementById('send-msg');
            forgetForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                try {
                    const formData = new FormData(forgetForm);
                    const response = await axios.post(url, formData);
                    if (response.data.status === "success") {
                        sendMsg.classList.remove('hidden');
                        // sendMsg.classList.add('flex');
                        sendMsg.innerHTML = `<span>${response.data.msg}</span><b
                            class=" text-green-400">${response.data.data.email}</b>`;
                    }
                } catch (error) {
                    if (error.response.data.errors.email) {
                        emailError.classList.remove("hidden")
                        emailError.innerText = error.response.data.errors.email;
                    }
                }
            });

            function emailOnChangeHandle() {
                emailError.classList.add("hidden")
            }
        </script>

    @endsection
