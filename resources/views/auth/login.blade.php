<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="">
        <h2 class="text-2xl font-semibold text-center mb-6">{{ __('Log In') }}</h2>
        
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input 
                id="email" 
                class="block mt-1 w-full" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                autocomplete="username" 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input 
                id="password" 
                class="block mt-1 w-full"
                type="password"
                name="password"
                required 
                autocomplete="current-password" 
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me and Forgot Password -->
        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input 
                    id="remember_me" 
                    type="checkbox" 
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" 
                    name="remember"
                />
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a 
                    class="text-sm text-gray-600 hover:text-gray-900" 
                    href="{{ route('password.request') }}"
                >
                    {{ __('Forgot pwd?') }}
                </a>
            @endif
        </div>

        <!-- Log In Button -->
        <div class="mt-6 flex justify-center ">
            <x-primary-button class="w-full py-2">
                {{ __('Log In') }}
            </x-primary-button>
        </div>

        <!-- Register Link -->
        <div class="text-center mt-6 text-sm text-gray-600">
            {{ __("Don't have an account?") }} 
            <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-900">
                {{ __('Sign Up') }}
            </a>
        </div>
    </form>
</x-guest-layout>

