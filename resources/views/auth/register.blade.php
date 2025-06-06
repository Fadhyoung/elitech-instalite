<x-guest-layout>

    <div class="w-full p-5 flex flex-col gap-5 justify-center items-center overflow-hidden">
        <div class="w-full p-5 flex flex-col gap-5 justify-center items-center overflow-hidden border border-gray-200 bg-white">
            <div class="w-1/2 p-5">
                <img src="{{ asset('images/img_instalite.png') }}"
                    alt="Instagram Mobile Mockup"
                    class="h-full w-full object-contain object-right" />
            </div>
            <div class="w-full">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Username -->
                    <div class="mt-4">
                        <label for="username">Username</label>
                        <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" required autofocus />
                    </div>

                    <div class="flex flex-col gap-4 items-center justify-end mt-4">
                        <x-primary-button class="w-full flex justify-center items-center">
                            {{ __('Register') }}
                        </x-primary-button>                       
                    </div>
                </form>
            </div>
        </div>
        <div class="w-full p-5 flex gap-5 justify-center items-center overflow-hidden border border-gray-200 bg-white">
            <p>Already have account?</p>
            <a
                href="{{ route('login') }}"
                class="inline-block text-blue-400">
                Login
            </a>
        </div>
    </div>
</x-guest-layout>