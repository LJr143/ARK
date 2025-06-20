<div>
    <button wire:click="$set('showModal', true)"
            class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-xl font-semibold hover:from-blue-700 hover:to-purple-700 transition-all duration-200">
        Compute Dues Payment
    </button>

    <div x-data="{ open: @entangle('showModal') }"
         x-show="open"
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/50 backdrop-blur-sm overflow-y-auto h-full w-full z-50 flex items-center justify-center p-4">
        <div
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="relative bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <div
                class="flex justify-between items-center border-b border-gray-200/50 p-6 bg-gradient-to-r from-blue-50/50 to-purple-50/50 rounded-t-3xl">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">Compute Dues Payment</h3>
                        @if ($selectedMember)
                            <p class="text-gray-600">{{ trim("{$selectedMember->first_name} {$selectedMember->middle_name} {$selectedMember->family_name}") }}</p>
                        @endif
                    </div>
                </div>
                <button @click="$wire.set('showModal', false); $wire.resetModal()"
                        class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-xl transition-all duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="p-6 space-y-6">
                <!-- Search Bar -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input wire:model.live="search" type="text"
                           placeholder="Search member by name, email, or PRC number..."
                           class="w-full pl-12 pr-4 py-4 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all duration-200 bg-gray-50/50 text-gray-900 placeholder-gray-500">
                </div>

                <!-- Member List -->
                @if ($search && $members->isNotEmpty())
                    <div
                        class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-200/50 p-4 max-h-48 overflow-y-auto">
                        <ul class="space-y-2">
                            @foreach ($members as $member)
                                <li wire:click="selectMember({{ $member->id }})"
                                    class="cursor-pointer hover:bg-gray-100 p-3 rounded-lg transition-all duration-200">
                                    {{ trim("{$member->first_name} {$member->middle_name} {$member->family_name}") }}
                                    (PRC: {{ $member->prc_registration_number ?? 'N/A' }})
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @elseif ($search && $members->isEmpty())
                    <p class="text-gray-500">No members found.</p>
                @endif

                <!-- Computation Result -->
                @if ($selectedMember && $unpaidComputation)
                    <div class="space-y-6">
                        <div
                            class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-6 border border-blue-200/50">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 h-14 w-14">
                                    <div
                                        class="h-14 w-14 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg">
                                        <span
                                            class="text-lg font-medium text-white">{{ substr($selectedMember->first_name, 0, 1) }}</span>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-lg font-semibold text-gray-900">{{ trim("{$selectedMember->first_name} {$selectedMember->middle_name} {$selectedMember->family_name}") }}</h4>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-600 font-medium">PRC No.</p>
                                        <p class="text-sm font-semibold text-gray-900">{{ $selectedMember->prc_registration_number ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($unpaidComputation['dues'])
                            <div class="space-y-4">
                                <h5 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                    <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                                    Unpaid Dues
                                </h5>
                                <table class="w-full border border-gray-200/50 rounded-2xl bg-gray-50/50">
                                    <thead class="bg-gradient-to-r from-gray-50 to-blue-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                            Fiscal Year
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                            Amount
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                            Penalty
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                            Total
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200/50">
                                    @foreach ($unpaidComputation['dues'] as $due)
                                        <tr>
                                            <td class="px-6 py-4 text-sm text-gray-900">{{ $due['fiscal_year'] }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                ₱{{ number_format($due['amount'], 2) }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                ₱{{ number_format($due['penalty'], 2) }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                ₱{{ number_format($due['total'], 2) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot class="bg-gradient-to-r from-gray-50 to-blue-50">
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-sm font-bold text-gray-900">Total Unpaid
                                        </td>
                                        <td class="px-6 py-4 text-sm font-bold text-gray-900">
                                            ₱{{ number_format($unpaidComputation['total_unpaid'], 2) }}</td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="flex justify-end gap-3">
                                <button wire:click="initiateWalkInPayment"
                                        class="px-6 py-3 bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white font-semibold rounded-xl transition-all duration-200 hover:shadow-lg">
                                    Pay Walk-in
                                </button>
                                <button wire:click="initiatePayPalPayment"
                                        class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hummingbird:bg-gradient-to-r hummingbird:from-blue-600 hummingbird:to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold rounded-xl transition-all duration-200 hover:shadow-lg">
                                    Pay with PayPal
                                </button>
                            </div>
                        @else
                            <p class="text-gray-500">No unpaid dues found for this member.</p>
                        @endif
                    </div>
                @endif

                @if (session()->has('message'))
                    <div class="mt-4 text-green-600 bg-green-100 p-4 rounded-lg">{{ session('message') }}</div>
                @endif
                @if (session()->has('error'))
                    <div class="mt-4 text-red-600 bg-red-100 p-4 rounded-lg">{{ session('error') }}</div>
                @endif

                @if ($recentPayment)
                    <div class="mt-6 p-4 bg-green-50 rounded-xl border border-green-200">
                        <h4 class="text-lg font-bold text-green-800 mb-2">Payment Successful!</h4>
                        <div class="flex gap-3">
                            <button wire:click="downloadReceipt({{ $recentPayment->id }})"
                                    class="px-4 py-2 bg-white border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition">
                                Download Receipt
                            </button>
                            <button onclick="window.print()"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                Print Receipt
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('redirect-to-paypal', (url) => {
                window.location.href = url;
            });
        });

        document.addEventListener('livewire:initialized', () => {
            Livewire.on('open-print-receipt', (event) => {
                const printWindow = window.open(event.url, '_blank');
                if (printWindow) {
                    printWindow.onload = function() {
                        printWindow.print();
                    };
                } else {
                    alert('Please allow popups for this website to print the receipt.');
                }
            });

            Livewire.on('open-receipt', (url) => {
                window.open(url, '_blank');
            });
        });
    </script>
</div>
