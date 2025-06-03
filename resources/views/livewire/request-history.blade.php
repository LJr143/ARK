<div x-data="{
    openDetails: @entangle('showDetails'),
    selectedDues: [],
    paymentProcessing: false,
    paymentError: null,
    paymentSuccess: false,
    totalAmount: 0
}" class="space-y-4">
    <!-- Header Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-xl font-bold text-gray-800">Request History</h1>
                <p class="text-sm text-gray-500 mt-1">Track your computation requests and responses</p>
            </div>
            <a href="{{ route('admin.dashboard') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                New Request
            </a>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search -->
            <div class="md:col-span-2">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text"
                           wire:model.live.debounce.300ms="search"
                           id="search"
                           placeholder="Search requests..."
                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Status Filter -->
            <div>
                <label for="statusFilter" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select wire:model.live="statusFilter"
                        id="statusFilter"
                        class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-lg">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                    <option value="completed">Completed</option>
                </select>
            </div>

            <!-- Clear Filters -->
            <div class="flex items-end">
                <button wire:click="clearFilters"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Reset Filters
                </button>
            </div>
        </div>
    </div>

    <!-- Payment Status Messages -->
    <template x-if="paymentError">
        <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-red-700" x-text="paymentError"></p>
                </div>
            </div>
        </div>
    </template>

    <template x-if="paymentSuccess">
        <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">Payment processed successfully! Your dues have been updated.</p>
                </div>
            </div>
        </div>
    </template>

    <!-- Requests List -->
    <div class="space-y-3">
        @forelse($requests as $request)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition-all duration-200 hover:shadow-md"
                 x-data="{ isOpen: openDetails[{{ $request->id }}] || false }">
                <!-- Request Header -->
                <div class="p-5 border-b border-gray-100">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 pt-1">
                                <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center space-x-2 mb-1">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        {{ $request->reference_number }}
                                    </p>
                                    {!! $request->status_badge !!}
                                </div>
                                <p class="text-sm text-gray-500">
                                    Submitted {{ $request->created_at->diffForHumans() }}
                                </p>
                                @if($request->notes)
                                    <p class="text-sm text-gray-500 mt-1 truncate">
                                        <span class="font-medium">Note:</span> {{ Str::limit($request->notes, 60) }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center space-x-3 w-full sm:w-auto mt-3 sm:mt-0">
                            @if($request->replies->count() > 0)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $request->replies->count() }} {{ Str::plural('reply', $request->replies->count()) }}
                                </span>
                            @endif

                            <button @click="isOpen = !isOpen; $wire.set('showDetails.{{ $request->id }}', isOpen)"
                                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <span x-text="isOpen ? 'Hide Details' : 'View Details'"></span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="-mr-0.5 ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-bind:class="{ 'rotate-180': isOpen }">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Request Details -->
                <div x-show="isOpen" x-transition x-cloak class="bg-gray-50 divide-y divide-gray-200">
                    <div class="px-5 py-4">
                        <h3 class="text-sm font-medium text-gray-900">Request Information</h3>
                        <dl class="mt-2 grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Reference Number</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $request->reference_number }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                <dd class="mt-1">{!! $request->status_badge !!}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Submitted</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $request->created_at->format('M j, Y g:i A') }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $request->updated_at->format('M j, Y g:i A') }}</dd>
                            </div>
                            @if($request->notes)
                                <div class="sm:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500">Notes</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $request->notes }}</dd>
                                </div>
                            @endif
                        </dl>
                    </div>

                    <!-- Replies Section -->
                    <div class="px-5 py-4">
                        <h3 class="text-sm font-medium text-gray-900 mb-3">Administrator Replies</h3>

                        @if($request->replies->count() > 0)
                            <div class="space-y-4">
                                @foreach($request->replies as $reply)
                                    <div class="bg-white p-4 rounded-lg shadow-xs border-l-4
                                    @if($reply->reply_type === 'approved') border-green-500
                                    @elseif($reply->reply_type === 'rejected') border-red-500
                                    @elseif($reply->reply_type === 'completed') border-blue-500
                                    @else border-gray-400 @endif">

                                        <div class="flex items-start justify-between">
                                            <div class="flex items-center space-x-2">
                                                {!! $reply->reply_type_icon !!}
                                                <span class="text-sm font-medium text-gray-900">
                                                {{ ucfirst($reply->reply_type) }} Response
                                            </span>
                                            </div>
                                            <span class="text-xs text-gray-500">
                                            {{ $reply->replied_at->format('M j, Y g:i A') }}
                                        </span>
                                        </div>

                                        <div class="mt-2 text-sm text-gray-700 whitespace-pre-wrap">
                                            {{ $reply->reply_message }}
                                        </div>

                                        @if($reply->admin)
                                            <div class="mt-3 text-xs text-gray-500">
                                                Replied by: {{ $reply->admin->first_name }} {{ $reply->admin->family_name }}
                                            </div>
                                        @endif

                                        @if($reply->has_computation && $reply->computation_data)
                                            <div class="mt-4">
                                                <h4 class="text-xs font-semibold text-gray-700 uppercase tracking-wider mb-2">Computation Results</h4>
                                                <div class="overflow-x-auto">
                                                    <table class="min-w-full divide-y divide-gray-200">
                                                        <thead class="bg-gray-50">
                                                        <tr>
                                                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                <input type="checkbox"
                                                                       @change="
                                                                   if($event.target.checked) {
                                                                       selectedDues = [];
                                                                       totalAmount = 0;
                                                                       Array.from(document.querySelectorAll('input[name=\'due_ids[]\']')).forEach(el => {
                                                                           if(!el.disabled) {
                                                                               el.checked = true;
                                                                               selectedDues.push(el.value);
                                                                               totalAmount += parseFloat(el.dataset.amount);
                                                                           }
                                                                       });
                                                                   } else {
                                                                       selectedDues = [];
                                                                       totalAmount = 0;
                                                                       Array.from(document.querySelectorAll('input[name=\'due_ids[]\']')).forEach(el => el.checked = false);
                                                                   }
                                                                   "
                                                                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                                            </th>
                                                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fiscal Year</th>
                                                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penalty</th>
                                                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="bg-white divide-y divide-gray-200">
                                                        @foreach($reply->computation_data['dues'] as $due)
                                                            <tr class="{{ $due['is_past_fiscal_year'] ? 'bg-red-50' : '' }}">
                                                                <td class="px-3 py-2 whitespace-nowrap">
                                                                    <input type="checkbox"
                                                                           name="due_ids[]"
                                                                           value="{{ $due['id'] ?? $loop->index }}"
                                                                           data-amount="{{ ($due['amount'] + $due['penalty']) ?? 0 }}"
                                                                           @if($due['status'] === 'paid') disabled @endif
                                                                           @click="
                                                                   if($event.target.checked) {
                                                                       selectedDues.push($event.target.value);
                                                                       totalAmount += parseFloat($event.target.dataset.amount);
                                                                   } else {
                                                                       selectedDues = selectedDues.filter(id => id !== $event.target.value);
                                                                       totalAmount -= parseFloat($event.target.dataset.amount);
                                                                   }
                                                                   "
                                                                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                                                </td>
                                                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-900">{{ $due['fiscal_year'] }}</td>
                                                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-900">₱{{ number_format($due['amount'], 2) }}</td>
                                                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-900">₱{{ number_format($due['penalty'], 2) }}</td>
                                                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-900">₱{{ number_format($due['total'], 2) }}</td>
                                                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-900">
                                                                    @if($due['status'] === 'paid')
                                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Paid</span>
                                                                    @else
                                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Unpaid</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                        <tr class="bg-gray-50">
                                                            <td colspan="3" class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                                                Selected Total
                                                            </td>
                                                            <td colspan="3" class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                                                <span x-text="'₱' + totalAmount.toFixed(2)"></span>
                                                            </td>
                                                        </tr>
                                                        <tr class="border-t">
                                                            <td colspan="3" class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                                                Total Amount
                                                            </td>
                                                            <td colspan="3" class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                                                ₱{{ number_format($reply->computation_data['total_amount'], 2) }}
                                                            </td>
                                                        </tr>
                                                        @if(isset($reply->computation_data['total_unpaid']) && $reply->computation_data['total_unpaid'] > 0)
                                                            <tr class="border-t">
                                                                <td colspan="3" class="px-3 py-2 whitespace-nowrap text-sm font-medium text-red-700">
                                                                    Total Unpaid
                                                                </td>
                                                                <td colspan="3" class="px-3 py-2 whitespace-nowrap text-sm font-medium text-red-700">
                                                                    ₱{{ number_format($reply->computation_data['total_unpaid'], 2) }}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        </tfoot>
                                                    </table>
                                                </div>

                                                <!-- Payment Button -->
                                                <div class="mt-4 flex justify-end" x-show="selectedDues.length > 0">
                                                    <button
                                                        @click="
                                                paymentProcessing = true;
                                                paymentError = null;
                                                paymentSuccess = false;
                                                $wire.initiatePaypalPayment(selectedDues, totalAmount, 'Payment for dues: ' + selectedDues.join(', '))
                                                    .then(result => {
                                                        paymentProcessing = false;
                                                        if (result.success) {
                                                            window.location.href = result.approval_url;
                                                        } else {
                                                            paymentError = result.message || 'Payment processing failed';
                                                        }
                                                    })
                                                    .catch(error => {
                                                        paymentProcessing = false;
                                                        paymentError = 'An unexpected error occurred';
                                                    });
                                                "
                                                        :disabled="paymentProcessing"
                                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-75 disabled:cursor-not-allowed">
                                                        <svg x-show="paymentProcessing" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                        </svg>
                                                        <span x-text="paymentProcessing ? 'Processing...' : 'Pay with PayPal'"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-6">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h4 class="mt-2 text-sm font-medium text-gray-900">No replies yet</h4>
                                <p class="mt-1 text-sm text-gray-500">The administrator hasn't responded to this request yet.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No requests found</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by submitting a new computation request.</p>
                <div class="mt-6">
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        New Request
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($requests->hasPages())
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 px-4 py-3 flex items-center justify-between sm:px-6">
            {{ $requests->links() }}
        </div>
    @endif
</div>
