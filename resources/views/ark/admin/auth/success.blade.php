<x-app-layout>

    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
        <div class="text-center mb-6">
            <svg class="mx-auto h-12 w-12 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <h2 class="mt-2 text-2xl font-bold text-gray-900">Registration sent ! </h2>
        </div>

        <div class="text-center">
            <p class="text-gray-600 mb-6">
                Thanks for signing up. The admin will review your registration. Upon approval, you will receive your log
                in credentials via email. Please check your inbox or spam folder and log in when you're ready!. Note
                that the approval process may
                take 1–2 business days.
            </p>

            <a href="{{ route('member.login') }}"
               class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Go to Login
            </a>
        </div>
    </div>
</x-app-layout>
