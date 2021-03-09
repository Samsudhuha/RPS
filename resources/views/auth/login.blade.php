<x-guest-layout>
    <!-- <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot> -->

    <x-jet-validation-errors class="mb-4" />
    <div class="p-10 min-h-screen flex items-center justify-center bg-teal-500">
        <div class="mx-auto w-full max-w-sm space-y-6">

            @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
            @endif
            <div class="p-8 bg-white shadow-2xl rounded-lg">
                <h2 class="text-center text-3xl leading-9 font-extrabold text-black mb-10">Login MIS</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <x-jet-label for="username" value="{{ __('Username') }}" />
                        <x-jet-input id="username" class="block mt-1 w-full" type="email" name="username" :value="old('username')" required autofocus />
                    </div>

                    <div class="mt-4">

                        <x-jet-label for="password" value="{{ __('Password') }}" />
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>

                    <!-- <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <x-jet-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div> -->

                    <div class="flex items-center justify-end mt-4">
                        <!-- @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                        @endif -->

                        <button class="text-center w-full bg-blue-700 rounded-full text-white py-3 font-medium">Login</button>
                        <!-- <x-jet-button class="ml-4">
                            {{ __('Log in') }}
                        </x-jet-button> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- </x-jet-authentication-card> -->
</x-guest-layout>