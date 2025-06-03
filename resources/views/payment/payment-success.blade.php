<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen py-12">
<div class="container mx-auto px-4">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
        <div class="text-center mb-6">
            <div class="w-16 h-16 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-green-600">Payment Successful!</h1>
        </div>

        <div class="space-y-3 text-sm">
            <div class="flex justify-between">
                <span class="font-medium">Transaction ID:</span>
                <span class="text-gray-600">{{ $transaction->transaction_reference }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-medium">Payment Method:</span>
                <span class="text-gray-600 capitalize">{{ $payment->payment_method }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-medium">Amount:</span>
                <span
                    class="text-gray-600">{{ $transaction->currency }} {{ number_format($transaction->amount, 2) }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-medium">Status:</span>
                <span class="text-green-600 capitalize">{{ $transaction->status }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-medium">Email:</span>
                <span class="text-gray-600">{{ $transaction->payer_email }}</span>
            </div>
            @if($transaction->description)
                <div class="flex justify-between">
                    <span class="font-medium">Description:</span>
                    <span class="text-gray-600">{{ $transaction->description }}</span>
                </div>
            @endif
            <div class="flex justify-between">
                <span class="font-medium">PayPal ID:</span>
                <span class="text-gray-600 text-xs">{{ $payment->identification_number }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-medium">Completed:</span>
                <span class="text-gray-600">{{ $transaction->completed_at->format('M d, Y H:i') }}</span>
            </div>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('payment') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Make Another Payment
            </a>
        </div>
    </div>
</div>
</body>
