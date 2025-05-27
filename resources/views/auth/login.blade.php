@extends('layouts.app')

@section('title', 'Login - LIBRAIN')
@if(session('success'))
<div class="bg-green-100 text-green-700 p-4 rounded mb-6">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="bg-red-100 text-red-700 p-4 rounded mb-6">
    {{ session('error') }}
</div>
@endif

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8 p-8 bg-white rounded-xl shadow-md">
        <div class="text-center">
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                Welcome to <span class="text-blue-600">LIBRAIN</span>
            </h2>
            <p class="mt-2 text-sm text-gray-600">Please login into your account!</p>
        </div>

        <!-- Alert Error -->
        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form Login -->
        <form action="{{ route('login') }}" method="POST" class="mt-8 space-y-6">
            @csrf

            <!-- Email Input -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                <input id="email" name="email" type="email" required autocomplete="off"
                    value="{{ old('email') }}"
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Password Input -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" name="password" type="password" required
                    class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Password" autocomplete="current-password">
            </div>

            <!-- Remember Me & Recovery Link -->
            <div class="flex items-center justify-between">
                <label class="flex items-center text-sm text-gray-600">
                    <input type="checkbox" name="remember"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <span class="ml-2">Remember Me</span>
                </label>
                <a href="#" class="text-sm text-blue-600 hover:text-blue-800">Recovery Password</a>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Login
                </button>
            </div>

            <!-- Google Sign In Button -->
            <div>
                <button type="button"
                    class="w-full flex items-center justify-center gap-2 py-3 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12.545,10.24v3.3h4.74c-0.401,2.23-1.822,4.16-3.586,5.07l2.847,2.207c1.874-1.745,2.963-4.304,2.963-7.277c0-0.746-0.093-1.465-0.26-2.144H12.545z" fill="#4285F4"/>
                        <path d="M7.612,10.275h4.933v3.3H7.612c-0.266,0.838-0.401,1.705-0.401,2.59v2.039h9.203c0.379-0.632,0.6-1.353,0.6-2.122c0-0.769-0.221-1.49-0.6-2.122h-4.933v-0.245h9.012v-3.06H12.545c0.416-2.18,1.717-4.02,3.586-5.07L7.612,5.185C7.17,6.215,6.963,7.333,6.963,8.5c0,0.769,0.135,1.51,0.389,2.275V10.275z" fill="#34A853"/>
                        <path d="M3.004,12.562c0-1.472,0.545-2.844,1.481-3.967l-1.481-1.149C1.27,8.064,1,9.38,1,10.764c0,1.381,0.465,2.68,1.235,3.765l1.484-1.152C3.27,13.06,3.004,12.562,3.004,12.562z" fill="#FBBC05"/>
                        <path d="M6.963,5.185c1.071-0.336,2.215-0.518,3.397-0.518c1.182,0,2.326,0.182,3.397,0.518l2.543-2.543C11.45,2.96,9.51,2,7.566,2C4.712,2,2.133,3.676,1,6.06l2.962,2.284C5.422,6.589,6.963,5.185,6.963,5.185z" fill="#EA4335"/>
                    </svg>
                    Sign in with Google
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
