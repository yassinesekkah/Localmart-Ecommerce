<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
       <div class="min-h-screen flex items-center justify-center ">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h1 class="text-2xl font-bold mb-6 text-[#235338]">Inscription</h1>
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" class="text-[#235338]" />
                <x-text-input id="name"
                              class="block mt-1 w-full h-12 border-2 border-[#235338] rounded  placeholder-[#235338]"
                              type="text"
                              name="name"
                              :value="old('name')"
                              required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-[#235338]" />
                <x-text-input id="email"
                              class="block mt-1 w-full h-12 border-2 border-[#235338] rounded  placeholder-[#235338]"
                              type="email"
                              name="email"
                              :value="old('email')"
                              required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" class="text-[#235338]" />
                <x-text-input id="password"
                              class="block mt-1 w-full h-12 border-2 border-[#235338] rounded  placeholder-[#235338]"
                              type="password"
                              name="password"
                              required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-[#235338]" />
                <x-text-input id="password_confirmation"
                              class="block mt-1 w-full h-12 border-2 border-[#235338] rounded  placeholder-[#235338]"
                              type="password"
                              name="password_confirmation"
                              required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Footer -->
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-[#235338] hover:text-[#1b442c] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#235338]"
                   href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ms-4 h-12 bg-[#235338] hover:bg-[#1b442c]">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>

    </form>
</x-guest-layout>
