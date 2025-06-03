@extends('layouts.pending-approval')

@section('content')
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 p-6">
        <div class="w-full max-w-md bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-10 py-12">
                <div class="flex justify-center mb-8">
                    <img src="{{ asset('storage/logo/UAP-Fort-Bonifacio-Chapter-Logo%201.png') }}"
                         alt="UAP Logo"
                         class="h-20">
                </div>

                <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Application Under Review</h1>

                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                    <p class="text-blue-700">
                        Your membership application is currently being reviewed by our team.
                        Please wait for an email confirmation once your account has been approved.
                    </p>
                </div>

                <div class="flex items-center justify-center text-sm text-gray-600">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Check your email regularly for updates
                </div>

                <div class="mt-8 text-center text-sm text-gray-500">
                    <p>Didn't receive any email? Contact our support:</p>
                    <a href="mailto:membership@uap.org.ph" class="text-blue-600 hover:underline">
                        membership@uap.org.ph
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
