<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h1 class="text-2xl font-bold mb-6 text-[#235338]">Connexion</h1>
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-[#235338]" />
                <x-text-input id="email"
                              class="block mt-1 w-full h-12 border-2 border-[#235338] rounded  placeholder-[#235338]"
                              type="email"
                              name="email"
                              :value="old('email')"
                              required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" class="text-[#235338]" />
                <x-text-input id="password"
                              class="block mt-1 w-full h-12 border-2 border-[#235338] rounded  placeholder-[#235338]"
                              type="password"
                              name="password"
                              required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                           class="rounded border-[#235338] text-[#235338] shadow-sm focus:ring-[#235338]"
                           name="remember">
                    <span class="ms-2 text-sm text-[#235338]">{{ __('Remember me') }}</span>
                </label>
            </div>

            <!-- Buttons -->
    <div class="flex items-center justify-between mt-4">
    <!-- Forgot Password -->
    @if (Route::has('password.request'))
        <a class="underline text-sm text-[#235338] hover:text-[#1b442c] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#235338]"
           href="{{ route('password.request') }}">
            {{ __('Forgot your password?') }}
        </a>
    @endif

    <!-- Register Link -->
    <a class="underline text-sm text-[#235338] hover:text-[#1b442c] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#235338]"
       href="{{ route('register') }}">
        {{ __('S’inscrire') }}
    </a>

    <!-- Login Button -->
    <x-primary-button class="ms-3 h-12 bg-[#235338] hover:bg-[#1b442c]">
        {{ __('Log in') }}
    </x-primary-button>
</div>


            </div>
        </form>
    </div>
</div>


    
</x-guest-layout>
