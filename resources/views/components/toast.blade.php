@props(['type' => 'info', 'message' => ''])

@if($message)
    <div x-data="{ show: true }"
         x-show="show"
         x-transition
         x-init="setTimeout(() => show = false, 5000)"
         class="fixed bottom-4 right-4 z-50">
        <div @class([
        'flex items-center p-4 rounded-lg shadow-lg',
        'bg-red-500 text-white' => $type === 'error',
        'bg-green-500 text-white' => $type === 'success',
        'bg-blue-500 text-white' => $type === 'info'
    ])>
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                @if($type === 'error')
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                @else
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                @endif
            </svg>
            <span>{{ $message }}</span>
        </div>
    </div>
@endif
