<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="w-full p-5 flex flex-col gap-5 justify-center items-center overflow-hidden">
        <div class="w-full p-5 flex flex-col gap-5 justify-center items-center overflow-hidden border border-gray-200 bg-white">
            <div class="w-1/2 p-5">
                <img src="{{ asset('images/img_instalite.png') }}"
                    alt="Instagram Mobile Mockup"
                    class="h-full w-full object-contain object-right" />
            </div>
            <div class="w-full">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="w-full flex flex-col gap-4 items-center justify-end mt-4">
                        <x-primary-button class="w-full flex justify-center text-center">
                            {{ __('Log in') }}
                        </x-primary-button>

                        @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        <div class="w-full p-5 flex gap-5 justify-center items-center overflow-hidden border border-gray-200 bg-white">
            <p>Dont't Have an Account?</p>
            <a
                href="{{ route('register') }}"
                class="inline-block text-blue-400">
                Register
            </a>
        </div>
    </div>
</x-guest-layout>