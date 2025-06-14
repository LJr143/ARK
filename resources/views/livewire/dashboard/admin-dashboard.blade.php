<div>
    <div class="min-h-screen bg-gray-50">
        <!-- Header Section -->
        <div class="relative overflow-hidden bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl shadow-lg mb-6 sm:mb-8">
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 w-40 h-40 sm:w-64 sm:h-64 bg-white opacity-10 rounded-full -translate-y-1/3 translate-x-1/3"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 sm:w-48 sm:h-48 bg-white opacity-5 rounded-full translate-y-1/3 -translate-x-1/3"></div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
                <!-- Flex container for all header content -->
                <div class="flex flex-col space-y-4 lg:space-y-0 lg:flex-row lg:justify-between lg:items-center gap-4 sm:gap-6">
                    <!-- Title and welcome message -->
                    <div class="text-white flex-1 min-w-0">
                        <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold mb-2 animate-fade-in-up">Dashboard</h1>
                        @if(auth()->user()->hasRole('member'))
                            <p class="text-blue-100 text-sm sm:text-base max-w-md sm:max-w-lg">Welcome back! Here's your membership overview.</p>
                        @else
                            <p class="text-blue-100 text-sm sm:text-base max-w-md sm:max-w-lg">Welcome back! Here's what's happening with your members.</p>
                        @endif
                    </div>

                    <!-- Right side container for filters and buttons -->
                    <div class="w-full lg:w-auto space-y-4">
                        <!-- Date Filter Section -->
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 sm:p-6">
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-end">
                                <div>
                                    <label for="start-date" class="block text-sm font-medium text-blue-100 mb-1">From Date</label>
                                    <input
                                        id="start-date"
                                        type="date"
                                        class="w-full rounded-lg border border-blue-300 bg-white/20 text-white placeholder-blue-200 focus:ring-2 focus:ring-blue-200 focus:border-blue-300 transition-colors duration-200 text-sm sm:text-base"
                                        wire:model.debounce.500ms="startDate"
                                    />
                                </div>
                                <div>
                                    <label for="end-date" class="block text-sm font-medium text-blue-100 mb-1">To Date</label>
                                    <input
                                        id="end-date"
                                        type="date"
                                        class="w-full rounded-lg border border-blue-300 bg-white/20 text-white placeholder-blue-200 focus:ring-2 focus:ring-blue-200 focus:border-blue-300 transition-colors duration-200 text-sm sm:text-base"
                                        wire:model.debounce.500ms="endDate"
                                    />
                                </div>
                                <button
                                    wire:click="filterByDate"
                                    wire:loading.attr="disabled"
                                    wire:loading.class="opacity-75 cursor-not-allowed"
                                    class="flex items-center justify-center gap-2 bg-white text-blue-700 hover:bg-blue-50 px-4 py-2 rounded-lg font-medium transition-colors duration-200 shadow-sm text-sm sm:text-base"
                                >
                            <span wire:loading wire:target="filterByDate" class="hidden">
                                <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12a8 8 0 0116 0 8 8 0 01-16 0z"/>
                                </svg>
                            </span>
                                    <span wire:loading.remove wire:target="filterByDate">Filter</span>
                                </button>
                            </div>
                        </div>

                        <!-- Admin Controls Section -->
                        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                            @if($isAdmin)
                                <button wire:click="toggleDataView"
                                        class="px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-colors duration-200 border border-white/30 shadow-sm">
                                    {{ $showAllData ? 'Show Only My Data' : 'Show All Data' }}
                                </button>
                                <div class="text-white text-sm bg-white/10 px-3 py-2 rounded-lg">
                                    Viewing: {{ $showAllData ? 'All Members' : 'My Data' }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="max-w-12xl mx-auto px-4 sm:px-4 lg:px-6 py-6 -mt-6">
            <!-- Stats Cards - Improved Grid Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8 mt-6">
                <!-- Paid Dues Card -->
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition-all hover:shadow-md">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-medium text-gray-600">Paid Dues</h3>
                                <div wire:loading.remove wire:target="filterByDate">
                                    <p class="text-2xl font-bold text-emerald-600 mt-1">
                                        ₱{{ number_format($paidDues, 2) }}</p>
                                    @if(auth()->user()->hasAnyRole(['admin', 'superadmin']))
                                    <p class="text-sm text-gray-500 mt-1">{{ $paidMembers }} members</p>
                                    @endif
                                </div>
                                <div wire:loading wire:target="filterByDate" class="mt-2 space-y-2">
                                    <div class="h-7 bg-gray-200 rounded animate-pulse"></div>
                                    <div class="h-4 bg-gray-200 rounded w-1/2 animate-pulse"></div>
                                </div>
                            </div>
                            <div class="bg-emerald-100 p-3 rounded-full">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                        </div>
                        @if($totalMembers > 0)
                            <div class="mt-4">
                                <div class="flex justify-between text-sm text-gray-600 mb-1">
                                    <span>Payment rate</span>
                                    <span class="font-medium">{{ round(($paidMembers / $totalMembers) * 100) }}%</span>
                                </div>
                                @if(auth()->user()->hasAnyRole(['admin', 'superadmin']))
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-emerald-500 h-2 rounded-full"
                                         style="width: {{ ($paidMembers / $totalMembers) * 100 }}%"></div>
                                </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Unpaid Dues Card -->
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition-all hover:shadow-md">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-medium text-gray-600">Unpaid Dues</h3>
                                <div wire:loading.remove wire:target="filterByDate">
                                    <p class="text-2xl font-bold text-red-600 mt-1">₱{{ number_format($unpaidDues, 2) }}</p>
                                    @if(auth()->user()->hasAnyRole(['admin', 'superadmin']))
                                    <p class="text-sm text-gray-500 mt-1">{{ $unpaidMembers }} members</p>
                                    @endif
                                </div>
                                <div wire:loading wire:target="filterByDate" class="mt-2 space-y-2">
                                    <div class="h-7 bg-gray-200 rounded animate-pulse"></div>
                                    <div class="h-4 bg-gray-200 rounded w-1/2 animate-pulse"></div>
                                </div>
                            </div>
                            <div class="bg-red-100 p-3 rounded-full">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                        </div>
                        @if($totalMembers > 0)
                            <div class="mt-4">
                                <div class="flex justify-between text-sm text-gray-600 mb-1">
                                    <span>Outstanding rate</span>
                                    <span class="font-medium">{{ round(($unpaidMembers / $totalMembers) * 100) }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-red-500 h-2 rounded-full"
                                         style="width: {{ ($unpaidMembers / $totalMembers) * 100 }}%"></div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Total Dues Card -->
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition-all hover:shadow-md">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-medium text-gray-600">Total Dues</h3>
                                <div wire:loading.remove wire:target="filterByDate">
                                    <p class="text-2xl font-bold text-indigo-600 mt-1">
                                        ₱{{ number_format($totalDues, 2) }}</p>
                                    @if(auth()->user()->hasAnyRole(['admin', 'superadmin']))
                                    <p class="text-sm text-gray-500 mt-1">{{ $totalMembers }} members</p>
                                    @endif
                                </div>
                                <div wire:loading wire:target="filterByDate" class="mt-2 space-y-2">
                                    <div class="h-7 bg-gray-200 rounded animate-pulse"></div>
                                    <div class="h-4 bg-gray-200 rounded w-1/2 animate-pulse"></div>
                                </div>
                            </div>
                            <div class="bg-indigo-100 p-3 rounded-full">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                </svg>
                            </div>
                        </div>
                        @if($totalDues > 0)
                            <div class="mt-4">
                                <div class="flex justify-between text-sm text-gray-600 mb-1">
                                    <span>Collection rate</span>
                                    <span class="font-medium">{{ round(($paidDues / $totalDues) * 100) }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-indigo-500 h-2 rounded-full"
                                         style="width: {{ ($paidDues / $totalDues) * 100 }}%"></div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column (Charts) -->
                <div class="lg:col-span-2 space-y-6">
                    @if(auth()->user()->hasAnyRole('admin', 'superadmin'))
                        <!-- Payment Status Chart -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <div class="flex justify-between items-center mb-6">
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-800">Payment Status</h2>
                                    <p class="text-gray-500 text-sm">Distribution of member payment status</p>
                                </div>
                                <div class="bg-purple-100 p-3 rounded-full">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                                    </svg>
                                </div>
                            </div>
                            @if($totalMembers > 0)
                                <div id="statusChart" class="h-80" wire:ignore></div>
                            @else
                                <div class="h-80 flex flex-col items-center justify-center bg-gray-50 rounded-lg">
                                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-500">No data available</h3>
                                    <p class="text-gray-400 text-sm mt-1">Member data will appear here once available</p>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Computation Request Section -->
                    @if(auth()->user()->hasAnyRole('member', 'admin', 'superadmin'))
                        @php
                            $existingRequest = \App\Models\ComputationRequest::with(['replies' => function($query) {
                                $query->orderBy('replied_at', 'desc');
                            }])
                            ->where('member_id', auth()->id())
                            ->where('status', 'pending')
                            ->first();

                            $processedRequests = \App\Models\ComputationRequest::with(['replies' => function($query) {
                                $query->orderBy('replied_at', 'desc');
                            }])
                            ->where('member_id', auth()->id())
                            ->whereIn('status', ['approved', 'rejected', 'completed'])
                            ->orderBy('updated_at', 'desc')
                            ->limit(3)
                            ->get();
                        @endphp

                            <!-- Request Status Card -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            @if ($existingRequest)
                                <!-- Pending Request -->
                                <div class="text-center">
                                    <div
                                        class="mx-auto w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Request Submitted</h3>
                                    <p class="text-gray-600 mb-6 max-w-md mx-auto">
                                        Your computation request is being processed. We'll notify you once it's ready.
                                    </p>

                                    <div
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-amber-50 border border-amber-200 rounded-full mb-6">
                                    <span class="relative flex h-2 w-2">
                                        <span
                                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                                    </span>
                                        <span class="text-sm font-medium text-amber-800">Pending Review</span>
                                    </div>

                                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 max-w-xs mx-auto">
                                        <div class="text-sm space-y-2">
                                            <p class="flex justify-between">
                                                <span class="text-gray-500">Ref No:</span>
                                                <span class="font-medium">{{ $existingRequest->reference_number }}</span>
                                            </p>
                                            <p class="flex justify-between">
                                                <span class="text-gray-500">Submitted:</span>
                                                <span>{{ $existingRequest->created_at->format('M d, Y') }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- New Request -->
                                <div class="text-center">
                                    <div
                                        class="mx-auto w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M9 5h6m-3 0v14m-4-7h8m-8 4h8"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Request Computation</h3>
                                    <p class="text-gray-600 mb-6 max-w-md mx-auto">
                                        Get a detailed breakdown of your dues to better understand your payment obligations.
                                    </p>

                                    <button
                                        wire:click="openComputationModal"
                                        wire:loading.attr="disabled"
                                        class="w-full max-w-xs mx-auto bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 shadow-md hover:shadow-lg flex items-center justify-center gap-2"
                                    >
                                    <span wire:loading.remove wire:target="openComputationModal">
                                        Request Breakdown
                                    </span>
                                        <span wire:loading wire:target="openComputationModal"
                                              class="flex items-center gap-2">
                                        <svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M4 12a8 8 0 0116 0 8 8 0 01-16 0z"/>
                                        </svg>
                                        Processing...
                                    </span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Right Column (Sidebar) -->
                <div class="space-y-6">
                    <!-- Request History -->
                    @if(isset($processedRequests) && $processedRequests->count() > 0)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="bg-gray-100 p-2 rounded-full">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">Request History</h3>
                                    <p class="text-sm text-gray-500">Your recent computation requests</p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                @foreach($processedRequests as $request)
                                    <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                                        <div class="flex justify-between items-start mb-2">
                                            <div class="font-medium text-gray-800 text-sm">
                                                {{ $request->reference_number }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ $request->created_at->format('M d') }}
                                            </div>
                                        </div>

                                        <div class="flex justify-between items-center">
                                            <div>
                                                @if($request->status === 'approved')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Approved
                                        </span>
                                                @elseif($request->status === 'rejected')
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Rejected
                                        </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Completed
                                        </span>
                                                @endif
                                            </div>
                                            <a href="{{ route('request.history') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">View</a>
                                        </div>
                                    </div>
                                @endforeach

                                @if($processedRequests->count() >= 3)
                                    <div class="text-center pt-2">
                                        <a wire:navigate href="{{ route('request.history') }}"
                                           class="text-indigo-600 hover:text-indigo-800 text-sm font-medium inline-flex items-center">
                                            View all history
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Quick Stats (Admin Only) -->
                    @if(auth()->user()->hasAnyRole('admin', 'superadmin'))
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Stats</h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Average per Member</p>
                                    <p class="font-medium text-gray-800">
                                        ₱{{ $totalMembers > 0 ? number_format($totalDues / $totalMembers, 2) : '0.00' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Collection Rate</p>
                                    <p class="font-medium text-emerald-600">
                                        {{ $totalDues > 0 ? round(($paidDues / $totalDues) * 100) : 0 }}%
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Outstanding Amount</p>
                                    <p class="font-medium text-red-600">₱{{ number_format($unpaidDues, 2) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Active Members</p>
                                    <p class="font-medium text-indigo-600">{{ $totalMembers }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Help Section -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Need Help?</h3>
                        <div class="space-y-3">
                            <div class="flex items-start gap-3">
                                <div class="bg-blue-100 p-2 rounded-full flex-shrink-0">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Computation Questions</p>
                                    <p class="text-sm text-gray-500">Contact our support team for help with dues
                                        calculations</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="bg-purple-100 p-2 rounded-full flex-shrink-0">
                                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Email Support</p>
                                    <p class="text-sm text-gray-500">support@membership.org</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="bg-green-100 p-2 rounded-full flex-shrink-0">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Call Us</p>
                                    <p class="text-sm text-gray-500">(02) 1234-5678</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Computation Request Modal -->
    <div x-data="{ showModal: @entangle('showComputationRequestModal') }" x-cloak x-show="showModal"
         class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 sm:p-6"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 transition-opacity" aria-hidden="true"></div>

        <!-- Modal container -->
        <div class="relative bg-white rounded-2xl shadow-lg w-full max-w-md sm:max-w-lg md:max-w-xl max-h-[90vh] overflow-y-auto">
            <div class="p-4 sm:p-6">
                <div class="flex items-start">
                    <div class="w-full">
                        <h3 class="text-lg sm:text-xl font-semibold text-gray-900 mb-4">Request Computation Breakdown</h3>

                        <!-- Member Info -->
                        <div class="bg-white/50 backdrop-blur-sm rounded-xl p-4 mb-4 border border-gray-200">
                            <h4 class="text-sm font-medium text-gray-700 mb-3 uppercase tracking-wider">Member Information</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">
                                <div>
                                    <p class="text-gray-500">Name</p>
                                    <p class="font-medium text-gray-900">{{ $memberData['first_name'] ?? '' }} {{ $memberData['family_name'] ?? '' }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500">PRC#</p>
                                    <p class="font-medium text-gray-900">{{ $memberData['prc_registration_number'] ?? '' }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500">Chapter</p>
                                    <p class="font-medium text-gray-900">{{ $memberData['current_chapter'] ?? '' }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500">Email</p>
                                    <p class="font-medium text-gray-900">{{ $memberData['email'] ?? '' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Message -->
                        <div class="mb-4">
                            <label for="additional-message" class="block text-sm font-medium text-gray-700 mb-1">Additional Message (Optional)</label>
                            <textarea
                                wire:model.debounce.500ms="additionalMessage"
                                id="additional-message"
                                rows="3"
                                class="block w-full rounded-md border border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm sm:text-base p-2.5 transition-colors duration-200"
                                placeholder="Any specific details about your request..."></textarea>
                        </div>

                        <!-- Agreement -->
                        <div class="mb-4">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input
                                        wire:model="agreementAccepted"
                                        id="agreement"
                                        type="checkbox"
                                        class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 transition-colors duration-200"
                                        x-bind:checked="agreementAccepted"
                                    >
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="agreement" class="font-medium text-gray-700">I agree to the terms</label>
                                    <p class="text-gray-500">I understand this request will be processed within 1-2 business days.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer with buttons -->
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-3">
                <button
                    wire:click="submitComputationRequest"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-50 cursor-not-allowed"
                    class="w-full sm:w-auto px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 flex items-center justify-center disabled:opacity-50"
                    x-bind:disabled="!agreementAccepted || submittingRequest"
                >
                    <span wire:loading.remove wire:target="submitComputationRequest">Submit Request</span>
                    <span wire:loading wire:target="submitComputationRequest" class="flex items-center">
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Processing...
                </span>
                </button>
                <button
                    wire:click="closeComputationModal"
                    type="button"
                    class="w-full sm:w-auto px-4 py-2 bg-white text-gray-700 rounded-md shadow-sm text-sm font-medium border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Cancel
                </button>
            </div>

            <!-- Success/Error Message -->
            @if($requestResult)
                <div class="px-4 py-3 sm:px-6"
                     x-data="{ show: true }" x-show="show" x-transition
                     x-init="setTimeout(() => show = false, 5000)">
                    <div class="@if($requestResult['error']) bg-red-50 text-red-700 @else bg-green-50 text-green-700 @endif rounded-md p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                @if($requestResult['error'])
                                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                @else
                                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                @endif
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium">
                                    {{ $requestResult['message'] }}
                                    @if(isset($requestResult['reference_number']))
                                        <br>Reference: <span class="font-bold">{{ $requestResult['reference_number'] }}</span>
                                    @endif
                                </p>
                            </div>
                            <button @click="show = false" class="ml-auto text-gray-500 hover:text-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        let overviewChart, statusChart, efficiencyChart, trendChart;

        // Wait for ApexCharts to be available
        function waitForApexCharts(callback) {
            if (typeof ApexCharts !== 'undefined') {
                callback();
            } else {
                setTimeout(() => waitForApexCharts(callback), 100);
            }
        }

        document.addEventListener('livewire:navigated', function() {
            waitForApexCharts(initCharts);
        });

        document.addEventListener('DOMContentLoaded', function() {
            waitForApexCharts(initCharts);
        });

        // Listen for Livewire updates
        document.addEventListener('livewire:init', () => {
            Livewire.on('dataUpdated', () => {
                updateCharts();
            });
        });

        function initCharts() {
            console.log('Initializing charts...');

            // Check if ApexCharts is available
            if (typeof ApexCharts === 'undefined') {
                console.error('ApexCharts is not loaded');
                return;
            }

            // Get current data from Livewire
            const chartData = getChartDataFromLivewire();

            // Only initialize charts if there's data to display
            if (chartData.totalDues === 0 && chartData.totalMembers === 0) {
                console.log('No data to display');
                destroyAllCharts();
                return;
            }

            createOrUpdateCharts(chartData);
        }

        function getChartDataFromLivewire() {
            return {
                paidDues: @json($paidDues),
                unpaidDues: @json($unpaidDues),
                paidMembers: @json($paidMembers),
                unpaidMembers: @json($unpaidMembers),
                totalMembers: @json($totalMembers),
                totalDues: @json($totalDues)
            };
        }

        function createOrUpdateCharts(data) {
            const { paidDues, unpaidDues, paidMembers, unpaidMembers, totalMembers, totalDues } = data;
            const efficiencyRate = totalMembers > 0 ? Math.round((paidMembers / totalMembers) * 100) : 0;

            // Overview Chart
            const overviewElement = document.querySelector("#overviewChart");
            if (overviewElement && totalDues > 0) {
                const overviewOptions = getOverviewChartOptions(paidDues, unpaidDues);
                updateOrCreateChart('overview', overviewElement, overviewOptions);
            }

            // Status Chart
            const statusElement = document.querySelector("#statusChart");
            if (statusElement && totalMembers > 0) {
                const statusOptions = getStatusChartOptions(paidMembers, unpaidMembers, totalMembers);
                updateOrCreateChart('status', statusElement, statusOptions);
            }

            // Efficiency Chart
            const efficiencyElement = document.querySelector("#efficiencyChart");
            if (efficiencyElement && totalMembers > 0) {
                const efficiencyOptions = getEfficiencyChartOptions(efficiencyRate);
                updateOrCreateChart('efficiency', efficiencyElement, efficiencyOptions);
            }

            // Trend Chart
            const trendElement = document.querySelector("#trendChart");
            if (trendElement && totalDues > 0) {
                const trendOptions = getTrendChartOptions(paidDues);
                updateOrCreateChart('trend', trendElement, trendOptions);
            }
        }

        function updateOrCreateChart(chartName, element, options) {
            if (window[`${chartName}Chart`]) {
                // Update existing chart
                window[`${chartName}Chart`].updateOptions(options);
                window[`${chartName}Chart`].updateSeries(options.series);
            } else {
                // Create new chart
                window[`${chartName}Chart`] = new ApexCharts(element, options);
                window[`${chartName}Chart`].render();
            }
        }

        function getOverviewChartOptions(paidDues, unpaidDues) {
            return {
                series: [{
                    name: 'Paid Dues',
                    data: generateMonthlyData(paidDues)
                }, {
                    name: 'Unpaid Dues',
                    data: generateMonthlyData(unpaidDues)
                }],
                chart: {
                    height: 320,
                    type: 'area',
                    toolbar: { show: false }
                },
                colors: ['#10b981', '#ef4444'],
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 3 },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },
                yaxis: {
                    labels: {
                        formatter: function(val) {
                            return '₱' + val.toLocaleString();
                        }
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.3,
                    }
                },
                grid: { strokeDashArray: 3 },
                legend: { position: 'top' }
            };
        }

        function getStatusChartOptions(paidMembers, unpaidMembers, totalMembers) {
            return {
                series: [paidMembers, unpaidMembers],
                chart: {
                    height: 320,
                    type: 'donut',
                },
                labels: ['Paid Members', 'Unpaid Members'],
                colors: ['#10b981', '#ef4444'],
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%',
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total Members',
                                    formatter: function() {
                                        return totalMembers.toString();
                                    }
                                }
                            }
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val, opts) {
                        return opts.w.config.series[opts.seriesIndex] + ' Members';
                    }
                },
                legend: { position: 'bottom' }
            };
        }

        function getEfficiencyChartOptions(efficiencyRate) {
            return {
                series: [efficiencyRate],
                chart: {
                    height: 192,
                    type: 'radialBar',
                },
                plotOptions: {
                    radialBar: {
                        hollow: {
                            size: '60%',
                        },
                        dataLabels: {
                            name: {
                                fontSize: '16px',
                            },
                            value: {
                                fontSize: '22px',
                                formatter: function(val) {
                                    return val + '%';
                                }
                            }
                        }
                    }
                },
                colors: ['#10b981'],
                labels: ['Efficiency'],
            };
        }

        function getTrendChartOptions(paidDues) {
            return {
                series: [{
                    name: 'Collections',
                    data: generateTrendData(paidDues)
                }],
                chart: {
                    height: 192,
                    type: 'line',
                    sparkline: { enabled: true }
                },
                colors: ['#3b82f6'],
                stroke: { curve: 'smooth', width: 3 },
                markers: { size: 4 }
            };
        }

        function destroyAllCharts() {
            ['overview', 'status', 'efficiency', 'trend'].forEach(chartName => {
                if (window[`${chartName}Chart`]) {
                    window[`${chartName}Chart`].destroy();
                    window[`${chartName}Chart`] = null;
                }
            });
        }

        function updateCharts() {
            const chartData = getChartDataFromLivewire();
            createOrUpdateCharts(chartData);
        }

        function generateMonthlyData(baseAmount) {
            const months = 12;
            const data = [];
            for (let i = 0; i < months; i++) {
                const variation = 0.7 + (Math.random() * 0.6);
                data.push(Math.round((baseAmount / months) * variation));
            }
            return data;
        }

        function generateTrendData(baseAmount = null) {
            const data = [];
            if (baseAmount && baseAmount > 0) {
                const baseValue = baseAmount / 10;
                for (let i = 0; i < 10; i++) {
                    const variation = 0.6 + (Math.random() * 0.8);
                    data.push(Math.round(baseValue * variation));
                }
            } else {
                for (let i = 0; i < 10; i++) {
                    data.push(Math.floor(Math.random() * 100) + 20);
                }
            }
            return data;
        }
    </script>
</div>
