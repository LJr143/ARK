<div x-data="{ showFilters: false }" class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <!-- Animated Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-blue-400 to-purple-600 rounded-full opacity-10 animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-gradient-to-tr from-indigo-400 to-cyan-500 rounded-full opacity-10 animate-pulse" style="animation-delay: 1s;"></div>
    </div>

    <div class="relative z-10 container mx-auto px-4 py-8 space-y-8">
        <!-- Enhanced Header -->
        <div class="relative overflow-hidden bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 p-6 sm:p-8 transition-all duration-500 hover:shadow-3xl group">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600/10 via-purple-600/10 to-indigo-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="relative flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl sm:text-4xl font-bold bg-gradient-to-r from-gray-900 via-blue-800 to-purple-800 bg-clip-text text-transparent">
                            Membership Payments Management
                        </h1>
                        <p class="text-gray-600 font-medium mt-1">Manage membership payments</p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-3 w-full sm:w-auto">
                    <button wire:click="export"
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-75 cursor-not-allowed"
                            wire:target="export"
                            class="flex-1 sm:flex-none px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold rounded-2xl transition-all duration-300 flex items-center justify-center gap-2 shadow-lg hover:shadow-xl hover:-translate-y-0.5 border border-white/20">

                            <span wire:loading.remove wire:target="export">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                            </span>

                                                <span wire:loading wire:target="export">
                                <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </span>

                        Export
                    </button>

                </div>
            </div>
        </div>

        <!-- Enhanced Search and Filters -->
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 p-6">
            <div class="flex flex-col sm:flex-row items-center gap-4">
                <div class="w-full">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Search Payments</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input wire:model.live="search"
                               type="text"
                               placeholder="Search payments by name, email, or PRC number..."
                               class="w-full pl-12 pr-4 py-4 border-2 border-gray-200/50 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 bg-white/80 backdrop-blur-sm text-gray-900 placeholder-gray-500 shadow-sm hover:shadow-md">
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Flash Messages -->
        @if (session()->has('message'))
            <div class="bg-gradient-to-r from-emerald-50 to-green-50 border-l-4 border-emerald-500 rounded-2xl p-6 shadow-lg mb-6"
                 x-data="{ show: true }"
                 x-show="show"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-4"
                 x-init="setTimeout(() => show = false, 5000)">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="p-2 bg-emerald-500 rounded-xl mr-4">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="font-semibold text-emerald-800">{{ session('message') }}</p>
                    </div>
                    <button @click="show = false" class="text-emerald-600 hover:text-emerald-800 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 rounded-2xl p-6 shadow-lg mb-6"
                 x-data="{ show: true }"
                 x-show="show"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-4"
                 x-init="setTimeout(() => show = false, 5000)">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="p-2 bg-red-500 rounded-xl mr-4">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <p class="font-semibold text-red-800">{{ session('error') }}</p>
                    </div>
                    <button @click="show = false" class="text-red-600 hover:text-red-800 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        <!-- Enhanced Payments Table -->
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full divide-y divide-gray-200/50">
                    <thead class="bg-gradient-to-r from-gray-50/50 to-blue-50/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Member
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Identification No.
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider hidden sm:table-cell">
                            Fiscal Year
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider hidden xl:table-cell">
                            Reference No.
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider hidden xl:table-cell">
                            Timestamp
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200/50">
                    @forelse($payments as $index => $payment)
                        <tr class="group hover:bg-gradient-to-r hover:from-blue-50/50 hover:to-indigo-50/50 transition-all duration-300 hover:shadow-md"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform translate-y-4"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            style="transition-delay: {{ $index * 50 }}ms;">
                            <td class="px-6 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                        <span class="text-sm font-medium text-white">{{ substr($payment->user->first_name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900">{{ trim("{$payment->user->first_name} {$payment->user->middle_name} {$payment->user->family_name}") }}</div>
                                        <div class="text-xs text-gray-500">PRC No. {{ $payment->user->prc_registration_number }}</div>
                                        <div class="sm:hidden mt-1">
                                            @if($payment->user->status === 'active')
                                                <span class="inline-flex items-center px-3 py-2 rounded-full text-xs font-bold bg-gradient-to-r from-emerald-100 to-green-100 text-emerald-800 shadow-sm">
                                                        <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2 animate-pulse"></span>
                                                        Active
                                                    </span>
                                            @elseif($payment->user->status === 'pending')
                                                <span class="inline-flex items-center px-3 py-2 rounded-full text-xs font-bold bg-gradient-to-r from-yellow-100 to-orange-100 text-yellow-800 shadow-sm">
                                                        <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2 animate-pulse"></span>
                                                        Pending
                                                    </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-2 rounded-full text-xs font-bold bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 shadow-sm">
                                                        <span class="w-2 h-2 bg-gray-500 rounded-full mr-2"></span>
                                                        Inactive
                                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-6">
                                <div class="text-sm text-gray-900">{{ $payment->identification_number }}</div>
                            </td>
                            <td class="px-6 py-6 hidden sm:table-cell">
                                <div class="text-sm text-gray-900">
                                    @php
                                        $fiscalYears = $payment->transaction?->dues?->pluck('fiscalYear.name')?->filter()?->unique()?->implode(', ') ?? 'None';
                                    @endphp
                                    @if($fiscalYears)
                                        {{ $fiscalYears }}
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-6 hidden xl:table-cell">
                                <div class="text-sm text-gray-900">{{ $payment->transaction?->transaction_reference }}</div>
                            </td>
                            <td class="px-6 py-6 hidden xl:table-cell">
                                <div class="text-sm text-gray-700">{{ \Carbon\Carbon::parse($payment->transaction?->completed_at)->format('M j, Y') }}</div>
                                <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($payment->transaction?->completed_at)->format('g:i A') }}</div>
                            </td>
                            <td class="px-6 py-6 text-right">
                                <button wire:click="openViewModal({{ $payment->id }})"
                                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white text-sm font-semibold rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-blue-600/30 hover:-translate-y-0.5 group">
                                    <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    View
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-24 h-24 bg-gradient-to-r from-gray-200 to-gray-300 rounded-3xl flex items-center justify-center mb-6">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-700 mb-2">No payments found</h3>
                                    <p class="text-gray-500 max-w-md">Shows all payments transactions</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            @if($payments->hasPages())
                <div class="bg-gradient-to-r from-gray-50/50 to-blue-50/50 px-6 py-4 border-t border-gray-200/50">
                    {{ $payments->links('ark.components.pagination.tailwind-pagination') }}
                </div>
            @endif
        </div>
    </div>
    <!-- Enhanced View Modal -->
    @if($showViewModal)
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full z-50 flex items-center justify-center p-4"
             x-data="{ open: true }"
             x-show="open"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <div class="relative bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 w-full max-w-2xl max-h-[90vh] overflow-y-auto"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95">
                <div class="flex justify-between items-center border-b border-gray-200/50 p-6 bg-gradient-to-r from-blue-50/50 to-purple-50/50 rounded-t-3xl">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">Membership Payment Details</h3>
                            <p class="text-gray-600">{{ trim("{$paymentDetails['user']['first_name']} {$paymentDetails['user']['family_name']}") }}</p>
                        </div>
                    </div>
                    <button type="button" wire:click="closeModal" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-xl transition-all duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <div class="p-6 space-y-8">
                    <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-6 border border-blue-200/50">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 h-14 w-14">
                                <div class="h-14 w-14 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg">
                                    <span class="text-lg font-medium text-white">{{ substr($paymentDetails['user']['first_name'], 0, 1) }}</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-semibold text-gray-900">{{ trim("{$paymentDetails['user']['first_name']} {$paymentDetails['user']['family_name']}") }}</h4>
                                <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">PRC No.</p>
                                        <p class="text-sm font-semibold text-gray-900">{{ $paymentDetails['user']['prc_registration_number'] }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">Status</p>
                                        @if($paymentDetails['user']['status'] === 'active')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-emerald-100 text-emerald-800">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Active
                                                </span>
                                        @elseif($paymentDetails['user']['status'] === 'pending')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Pending
                                                </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Inactive
                                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <h5 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                                Payment & Transaction Details
                            </h5>
                            <div class="space-y-3">
                                <div class="p-4 bg-gray-50/80 rounded-xl">
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Payer Identification Number</label>
                                    <p class="text-sm font-mono text-gray-900 bg-white px-3 py-2 rounded-lg">{{ $paymentDetails['identification_number'] }}</p>
                                </div>
                                <div class="p-4 bg-gray-50/80 rounded-xl">
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Payment Method</label>
                                    <p class="text-sm font-mono text-gray-900 bg-white px-3 py-2 rounded-lg">{{ $paymentDetails['payment_method'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <h5 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                <div class="w-2 h-2 bg-purple-600 rounded-full"></div>
                                Amount Paid
                            </h5>
                            <div class="space-y-3">
                                <div class="p-4 bg-gray-50/80 rounded-xl">
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Total Amount Paid</label>
                                    <p class="text-sm font-mono text-gray-900 bg-white px-3 py-2 rounded-lg">{{ $paymentDetails['transaction']['amount'] }}</p>
                                </div>
                                <div class="p-4 bg-gray-50/80 rounded-xl">
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Transaction Date</label>
                                    <p class="text-sm font-mono text-gray-900 bg-white px-3 py-2 rounded-lg">{{ \Carbon\Carbon::parse($paymentDetails['transaction']['completed_at'])->format('F j, Y g:i A') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3 p-6 border-t border-gray-200/50 bg-gray-50/50 rounded-b-3xl">
                    <button type="button" wire:click="closeModal" class="px-6 py-3 bg-white hover:bg-gray-50 text-gray-700 font-semibold rounded-xl border border-gray-200 transition-all duration-200 hover:shadow-md">
                        Close
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
