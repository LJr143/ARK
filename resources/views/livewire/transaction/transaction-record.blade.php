<div>
    <div x-data="{
    showFilters: false,
    selectedRows: [],
    toggleAllRows: false,
    animateCards: true
}"
         x-init="setTimeout(() => animateCards = true, 100)"
         class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">

        <!-- Animated Background Elements -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-blue-400 to-purple-600 rounded-full opacity-10 animate-pulse"></div>
            <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-gradient-to-tr from-indigo-400 to-cyan-500 rounded-full opacity-10 animate-pulse" style="animation-delay: 1s;"></div>
        </div>

        <div class="relative z-10 container mx-auto px-4 py-8 space-y-8">

            <!-- Enhanced Header -->
            <div class="relative overflow-hidden bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 p-8 transition-all duration-500 hover:shadow-3xl group">
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600/10 via-purple-600/10 to-indigo-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                <div class="relative flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                    <div class="space-y-2">
                        <div class="flex items-center gap-3">
                            <div class="p-3 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-gray-900 via-blue-800 to-purple-800 bg-clip-text text-transparent">
                                    Transaction History
                                </h1>
                                <p class="text-gray-600 font-medium">Comprehensive financial transaction overview</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-3">
                        <button
                            @click="showFilters = !showFilters"
                            :class="showFilters ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/30' : 'bg-white/80 text-gray-700 hover:bg-white'"
                            class="px-6 py-3 rounded-2xl font-semibold transition-all duration-300 flex items-center gap-2 border border-gray-200/50 backdrop-blur-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"/>
                            </svg>
                            Filters
                        </button>

                        <button
                            wire:click="export"
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-75 cursor-not-allowed"
                            class="group bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 text-white px-6 py-3 rounded-2xl font-semibold transition-all duration-300 flex items-center gap-2 shadow-lg shadow-emerald-600/30 hover:shadow-xl hover:shadow-emerald-600/40 hover:-translate-y-0.5">

                        <span wire:loading.remove wire:target="export">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                        </span>

                            <span wire:loading wire:target="export">
                            <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </span>

                            <span>Export Data</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Enhanced Search and Filters -->
            <div
                x-show="showFilters"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform -translate-y-4"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform -translate-y-4"
                class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 p-6" x-cloak>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Enhanced Search -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Search Transactions</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input
                                wire:model.live="search"
                                type="text"
                                placeholder="Search by ID, reference, method, amount..."
                                class="w-full pl-12 pr-4 py-4 border-2 border-gray-200/50 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 bg-white/80 backdrop-blur-sm text-gray-900 placeholder-gray-500 shadow-sm hover:shadow-md">
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status Filter</label>
                        <select wire:model.live="statusFilter" class="w-full px-4 py-4 border-2 border-gray-200/50 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 bg-white/80 backdrop-blur-sm text-gray-900 shadow-sm hover:shadow-md">
                            <option value="">All Status</option>
                            <option value="completed">Completed</option>
                            <option value="pending">Pending</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Enhanced Flash Messages -->
            @if (session()->has('message'))
                <div
                    class="bg-gradient-to-r from-emerald-50 to-green-50 border-l-4 border-emerald-500 rounded-2xl p-6 shadow-lg"
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
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
                <div
                    class="bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 rounded-2xl p-6 shadow-lg"
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
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

            <!-- Enhanced Transactions Table -->
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 overflow-hidden">
                <!-- Table Header with Stats -->
                <div class="bg-gradient-to-r from-gray-50/80 to-blue-50/80 p-6 border-b border-gray-200/50">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Recent Transactions</h3>
                            <p class="text-gray-600">{{ $transactions->total() }} total transactions found</p>
                        </div>
                        <div class="flex gap-4">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-emerald-600">{{ $transactions->where('status', 'completed')->count() }}</div>
                                <div class="text-xs text-gray-500">Completed</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-yellow-600">{{ $transactions->where('status', 'pending')->count() }}</div>
                                <div class="text-xs text-gray-500">Pending</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Responsive Table -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gradient-to-r from-gray-50/50 to-blue-50/50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <span>ID</span>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"/>
                                    </svg>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider hidden sm:table-cell">Reference</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider hidden lg:table-cell">External ID</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider hidden xl:table-cell">Method</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase tracking-wider hidden md:table-cell">Payer</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase tracking-wider hidden lg:table-cell">Date</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200/50">
                        @forelse($transactions as $index => $transaction)
                            <tr
                                class="group hover:bg-gradient-to-r hover:from-blue-50/50 hover:to-indigo-50/50 transition-all duration-300 hover:shadow-md"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform translate-y-4"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                style="transition-delay: {{ $index * 50 }}ms;">

                                <td class="px-6 py-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                            <span class="text-white font-bold text-sm">#{{ substr($transaction->id, -2) }}</span>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900">{{ $transaction->id }}</div>
                                            <div class="text-xs text-gray-500 sm:hidden">{{ $transaction->payment_method }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-6 hidden sm:table-cell">
                                    <div class="font-mono text-sm text-gray-700 bg-gray-100/50 px-3 py-1 rounded-lg">
                                        {{ Str::limit($transaction->transaction_reference, 15) }}
                                    </div>
                                </td>

                                <td class="px-6 py-6 hidden lg:table-cell">
                                    <div class="font-mono text-xs text-gray-600">
                                        {{ Str::limit($transaction->external_transaction_id, 20) }}
                                    </div>
                                </td>

                                <td class="px-6 py-6 hidden xl:table-cell">
                                    <div class="flex items-center gap-2">
                                        @if($transaction->payment_method === 'credit_card')
                                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"/>
                                                </svg>
                                            </div>
                                        @elseif($transaction->payment_method === 'bank_transfer')
                                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm5 3a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                                </svg>
                                            </div>
                                        @else
                                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        @endif
                                        <span class="text-sm capitalize text-gray-700 font-medium">{{ str_replace('_', ' ', $transaction->payment_method) }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-6 text-right">
                                    <div class="text-lg font-bold text-gray-900">₱{{ number_format($transaction->amount, 2) }}</div>
                                </td>

                                <td class="px-6 py-6 text-center">
                                    @if($transaction->status === 'completed')
                                        <span class="inline-flex items-center px-3 py-2 rounded-full text-xs font-bold bg-gradient-to-r from-emerald-100 to-green-100 text-emerald-800 shadow-sm">
                                            <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2 animate-pulse"></span>
                                            Completed
                                        </span>
                                    @elseif($transaction->status === 'pending')
                                        <span class="inline-flex items-center px-3 py-2 rounded-full text-xs font-bold bg-gradient-to-r from-yellow-100 to-orange-100 text-yellow-800 shadow-sm">
                                            <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2 animate-pulse"></span>
                                            Pending
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-2 rounded-full text-xs font-bold bg-gradient-to-r from-red-100 to-rose-100 text-red-800 shadow-sm">
                                            <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                                            Failed
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-6 text-right hidden md:table-cell">
                                    <div class="text-sm font-medium text-gray-900">{{ $transaction->payer_id }}</div>
                                </td>

                                <td class="px-6 py-6 text-right hidden lg:table-cell">
                                    <div class="text-sm text-gray-700">{{ \Carbon\Carbon::parse($transaction->completed_at)->format('M j, Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($transaction->completed_at)->format('g:i A') }}</div>
                                </td>

                                <td class="px-6 py-6 text-center">
                                    <button
                                        wire:click="openViewModal({{ $transaction->id }})"
                                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white text-sm font-semibold rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-blue-600/30 hover:-translate-y-0.5 group">
                                        <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        View
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-24 h-24 bg-gradient-to-r from-gray-200 to-gray-300 rounded-3xl flex items-center justify-center mb-6">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                            </svg>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-700 mb-2">No transactions found</h3>
                                        <p class="text-gray-500 max-w-md">Payment transactions will appear here once they are processed</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Enhanced Pagination -->
                @if($transactions->hasPages())
                    <div class="bg-gradient-to-r from-gray-50/50 to-blue-50/50 px-6 py-4 border-t border-gray-200/50">
                        {{ $transactions->links('ark.components.pagination.tailwind-pagination') }}
                    </div>
                @endif
            </div>

            <!-- Enhanced Modal -->
            @if($showViewModal)
                <div
                    class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full z-50 flex items-center justify-center p-4"
                    x-data="{ open: true }"
                    x-show="open"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0">

                    <div
                        class="relative bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 w-full max-w-2xl max-h-[90vh] overflow-y-auto"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95">

                        <!-- Modal Header -->
                        <div class="flex justify-between items-center border-b border-gray-200/50 p-6 bg-gradient-to-r from-blue-50/50 to-purple-50/50 rounded-t-3xl">
                            <div class="flex items-center gap-4">
                                <div class="p-3 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900">Transaction Details</h3>
                                    <p class="text-gray-600">Complete transaction information</p>
                                </div>
                            </div>
                            <button
                                type="button"
                                wire:click="closeModal"
                                class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-xl transition-all duration-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>

                        <!-- Modal Content -->
                        <div class="p-6 space-y-8">

                            <!-- Transaction Overview Card -->
                            <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-6 border border-blue-200/50">
                                <div class="flex items-center justify-between mb-4">
                                    <h4 class="text-lg font-bold text-gray-900">Transaction Overview</h4>
                                    <div class="flex items-center gap-2">
                                        @if($transactionDetails['status'] === 'completed')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-emerald-100 text-emerald-800">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            Completed
                                        </span>
                                        @elseif($transactionDetails['status'] === 'pending')
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
                                            Failed
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div class="text-center p-4 bg-white/80 rounded-xl">
                                        <div class="text-3xl font-bold text-blue-600">${{ number_format($transactionDetails['amount'] ?? 0, 2) }}</div>
                                        <div class="text-sm text-gray-600 font-medium">Transaction Amount</div>
                                    </div>
                                    <div class="text-center p-4 bg-white/80 rounded-xl">
                                        <div class="text-2xl font-bold text-purple-600">#{{ $transactionDetails['ID'] ?? 'N/A' }}</div>
                                        <div class="text-sm text-gray-600 font-medium">Transaction ID</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Transaction Details Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                <!-- Primary Details -->
                                <div class="space-y-4">
                                    <h5 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                        <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                                        Primary Details
                                    </h5>

                                    <div class="space-y-3">
                                        <div class="p-4 bg-gray-50/80 rounded-xl">
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Transaction Reference</label>
                                            <p class="text-sm font-mono text-gray-900 bg-white px-3 py-2 rounded-lg">{{ $transactionDetails['transaction_reference'] ?? 'N/A' }}</p>
                                        </div>

                                        <div class="p-4 bg-gray-50/80 rounded-xl">
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">External Transaction ID</label>
                                            <p class="text-sm font-mono text-gray-900 bg-white px-3 py-2 rounded-lg">{{ $transactionDetails['external_transaction_id'] ?? 'N/A' }}</p>
                                        </div>

                                        <div class="p-4 bg-gray-50/80 rounded-xl">
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Payment Method</label>
                                            <div class="flex items-center gap-2 mt-1">
                                                @if($transactionDetails['payment_method'] === 'credit_card')
                                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                                        <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"/>
                                                        </svg>
                                                    </div>
                                                @elseif($transactionDetails['payment_method'] === 'bank_transfer')
                                                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                                        <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm5 3a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                                        </svg>
                                                    </div>
                                                @else
                                                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                                        <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                                                        </svg>
                                                    </div>
                                                @endif
                                                <span class="text-sm font-semibold text-gray-900 capitalize">{{ str_replace('_', ' ', $transactionDetails['payment_method'] ?? 'N/A') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Secondary Details -->
                                <div class="space-y-4">
                                    <h5 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                        <div class="w-2 h-2 bg-purple-600 rounded-full"></div>
                                        Additional Information
                                    </h5>

                                    <div class="space-y-3">
                                        <div class="p-4 bg-gray-50/80 rounded-xl">
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Payer ID</label>
                                            <p class="text-sm text-gray-900 bg-white px-3 py-2 rounded-lg">{{ $transactionDetails['payer_id'] ?? 'N/A' }}</p>
                                        </div>

                                        <div class="p-4 bg-gray-50/80 rounded-xl">
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Transaction Date</label>
                                            <p class="text-sm text-gray-900 bg-white px-3 py-2 rounded-lg">{{ $transactionDetails['completed_at'] ? \Carbon\Carbon::parse($transactionDetails['completed_at'])->format('F j, Y g:i A') : 'N/A' }}</p>
                                        </div>

                                        <div class="p-4 bg-gray-50/80 rounded-xl">
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Last Updated</label>
                                            <p class="text-sm text-gray-900 bg-white px-3 py-2 rounded-lg">{{ $transactionDetails['updated_at'] ? \Carbon\Carbon::parse($transactionDetails['updated_at'])->format('F j, Y g:i A') : 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Transaction Timeline -->
                            <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-2xl p-6 border border-gray-200/50">
                                <h5 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Transaction Timeline
                                </h5>
                                <div class="space-y-3">
                                    <div class="flex items-center gap-3 p-3 bg-white/80 rounded-lg">
                                        <div class="w-3 h-3 bg-blue-600 rounded-full"></div>
                                        <div class="flex-1">
                                            <div class="text-sm font-semibold text-gray-900">Transaction Initiated</div>
                                            <div class="text-xs text-gray-600">{{ $transactionDetails['payment_date'] ? \Carbon\Carbon::parse($transactionDetails['payment_date'])->format('M j, Y g:i A') : 'N/A' }}</div>
                                        </div>
                                    </div>
                                    @if($transactionDetails['status'] === 'completed')
                                        <div class="flex items-center gap-3 p-3 bg-white/80 rounded-lg">
                                            <div class="w-3 h-3 bg-emerald-600 rounded-full"></div>
                                            <div class="flex-1">
                                                <div class="text-sm font-semibold text-gray-900">Payment Completed</div>
                                                <div class="text-xs text-gray-600">{{ $transactionDetails['completed_at'] ? \Carbon\Carbon::parse($transactionDetails['completed_at'])->format('M j, Y g:i A') : 'N/A' }}</div>
                                            </div>
                                        </div>
                                    @elseif($transactionDetails['status'] === 'pending')
                                        <div class="flex items-center gap-3 p-3 bg-yellow-50 rounded-lg border border-yellow-200">
                                            <div class="w-3 h-3 bg-yellow-600 rounded-full animate-pulse"></div>
                                            <div class="flex-1">
                                                <div class="text-sm font-semibold text-yellow-800">Processing Payment</div>
                                                <div class="text-xs text-yellow-600">Transaction is being processed</div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="flex justify-end gap-3 p-6 border-t border-gray-200/50 bg-gray-50/50 rounded-b-3xl">
                            <button
                                type="button"
                                wire:click="closeModal"
                                class="px-6 py-3 bg-white hover:bg-gray-50 text-gray-700 font-semibold rounded-xl border border-gray-200 transition-all duration-200 hover:shadow-md">
                                Close
                            </button>
                            <button
                                type="button"
                                class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold rounded-xl transition-all duration-200 hover:shadow-lg hover:shadow-blue-600/30">
                                Export Details
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <style>
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #2563eb, #7c3aed);
        }

        @keyframes shimmer {
            0% { background-position: -200px 0; }
            100% { background-position: calc(200px + 100%) 0; }
        }

        .shimmer {
            animation: shimmer 1.5s ease-in-out infinite;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200px 100%;
        }

        .glass {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        /* Hover animations */
        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
    </style>

    <script>

        document.addEventListener('alpine:init', () => {
            Alpine.data('transactionTable', () => ({
                selectedRows: [],
                selectAll: false,

                toggleRow(id) {
                    if (this.selectedRows.includes(id)) {
                        this.selectedRows = this.selectedRows.filter(rowId => rowId !== id);
                    } else {
                        this.selectedRows.push(id);
                    }
                    this.updateSelectAll();
                },

                toggleAllRows() {
                    if (this.selectAll) {
                        this.selectedRows = [];
                    } else {
                        this.selectedRows = Array.from(document.querySelectorAll('[data-row-id]'))
                            .map(el => parseInt(el.dataset.rowId));
                    }
                    this.selectAll = !this.selectAll;
                },

                updateSelectAll() {
                    const totalRows = document.querySelectorAll('[data-row-id]').length;
                    this.selectAll = this.selectedRows.length === totalRows && totalRows > 0;
                }
            }));
        });

        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('a[href^="#"]');
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const targetSection = document.querySelector(targetId);
                    if (targetSection) {
                        targetSection.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>

</div>
