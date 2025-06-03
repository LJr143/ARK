<div>
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div
            class="rounded-2xl shadow-lg border border-gray-200  mb-6 p-4 sm:p-6 transition-all duration-300 hover:shadow-xl">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="text-xl sm:text-2xl font-bold text-gray-900 ">Computational Breakdown Request</h1>
                    <p class="text-sm text-gray-600 mt-1">Shows All Computational Breakdown Requests</p>
                </div>
            </div>
        </div>

        <!-- Search and Filters -->
        <div class="bg-white  rounded-2xl shadow-lg border border-gray-200 mb-6 p-4 sm:p-6 transition-all duration-300">
            <div class="flex flex-col sm:flex-row items-center gap-4">
                <div class="w-full">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input wire:model.live="search" type="text"
                               placeholder="Search members by name, email, or PRC number..."
                               class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500  focus:border-indigo-500 transition-all duration-200 bg-white  text-gray-900  placeholder-gray-400">
                    </div>
                </div>
            </div>
        </div>

        <!-- Flash Messages -->
        @if (session()->has('message'))
            <div class="bg-green-50 border-l-4 border-green-500 rounded-r-lg p-4 mb-6 shadow-sm"
                 x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)">
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <p class="ml-3 text-sm font-medium text-green-800 ">{{ session('message') }}</p>
                    <button @click="show = false" class="ml-auto text-green-500 hover:text-green-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-50 border-l-4 border-red-500 rounded-r-lg p-4 mb-6 shadow-sm"
                 x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)">
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    <p class="ml-3 text-sm font-medium text-red-800">{{ session('error') }}</p>
                    <button @click="show = false" class="ml-auto text-red-500 hover:text-red-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        <!-- Members Table -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                           ID
                        </th>
                        <th scope="col"
                            class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider hidden sm:table-cell">
                           Reference No.
                        </th>
                        <th scope="col"
                            class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider hidden lg:table-cell">
                           Member
                        </th>
                        <th scope="col"
                            class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider hidden xl:table-cell">
                            Status
                        </th>
                        <th scope="col"
                            class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider hidden xl:table-cell">
                            Processed By
                        </th>
                        <th scope="col"
                            class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider hidden xl:table-cell">
                            Date
                        </th>
                        <th scope="col"
                            class="px-4 sm:px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white  divide-y divide-gray-200 ">
                    @forelse($requests as $request)
                        <tr class="hover:bg-gray-50  transition-colors duration-150">
                            <td class="px-4 sm:px-6 py-4">
                                <div class="text-sm text-gray-900 ">{{ $request->id }}</div>
                            </td>
                            <td class="px-4 sm:px-6 py-4">
                                <div class="text-sm text-gray-900 ">{{ $request->reference_number }}</div>
                            </td>
                            <td class="px-4 sm:px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8 sm:h-10 sm:w-10">
                                        <div
                                            class="h-8 w-8 sm:h-10 sm:w-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center shadow-sm">
                                            <span
                                                class="text-xs sm:text-sm font-medium text-white">{{ substr($request->member->first_name, 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-3 sm:ml-4">
                                        <div
                                            class="text-sm font-medium text-gray-900 ">{{ $request->member->first_name }} {{$request->member->middle_name ?? '' }} {{ $request->member->family_name }}</div>
                                        <div class="text-xs text-gray-500 ">PRC
                                            No. {{ $request->member->prc_registration_number }}</div>
                                        <div class="text-xs text-gray-500  sm:hidden">
                                            @if($request->member->status === 'active')
                                                <span
                                                    class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800   items-center gap-1">
                                                            <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span> Active
                                                        </span>
                                            @elseif($request->member->status === 'pending')
                                                <span
                                                    class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800   items-center gap-1">
                                                            <span class="h-1.5 w-1.5 rounded-full bg-yellow-500"></span> Pending
                                                        </span>
                                            @else
                                                <span
                                                    class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800   items-center gap-1">
                                                            <span class="h-1.5 w-1.5 rounded-full bg-gray-500"></span> Inactive
                                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-4 hidden sm:table-cell">
                                @if($request->status === 'approved')
                                    <span
                                        class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800   items-center gap-1">
                                                <span class="h-2 w-2 rounded-full bg-green-500"></span> Approved
                                            </span>
                                @elseif($request->status === 'pending')
                                    <span
                                        class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800   items-center gap-1">
                                                <span class="h-2 w-2 rounded-full bg-yellow-500"></span> Pending
                                            </span>
                                @else
                                    <span
                                        class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800   items-center gap-1">
                                                <span class="h-2 w-2 rounded-full bg-gray-500"></span> Denied
                                            </span>
                                @endif
                            </td>
                            <td class="px-4 sm:px-6 py-4 hidden lg:table-cell">
                                @if($request->catered_by)
                                    <div class="text-sm text-gray-900 ">{{ $requests->member->first_name  . ' ' . $requests->member->family_name }}</div>
                                @endif
                                <div class="text-gray-900 text-xs ">Not Yet Managed</div>
                            </td>
                            <td class="px-4 sm:px-6 py-4 hidden xl:table-cell text-sm text-gray-500 ">
                                {{ $request->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-4 sm:px-6 py-4 text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <button wire:click="openViewModal({{ $request->id }})"
                                            class="text-gray-500 hover:text-indigo-600  p-2 hover:bg-gray-100  rounded transition-colors duration-200">
                                        <svg class="w-4 sm:w-5 h-4 sm:h-5" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                    <button wire:click="delete({{ $request->id }})"
                                            onclick="confirm('Are you sure you want to delete this request?') || event.stopImmediatePropagation()"
                                            class="text-red-500 hover:text-red-700  p-2 hover:bg-red-50  rounded transition-colors duration-200">
                                        <svg class="w-4 sm:w-5 h-4 sm:h-5" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 sm:px-6 py-12 text-center">
                                <div class="text-gray-400 ">
                                    <svg class="mx-auto h-12 w-12 sm:h-16 sm:w-16 mb-4" fill="none"
                                         stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    <p class="text-base sm:text-lg font-medium">No requests found</p>
                                    <p class="text-sm mt-1">There are currently no computational request.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($requests->hasPages())
                <div class="bg-white  px-4 py-3 border-t border-gray-200  sm:px-6 rounded-b-2xl">
                    {{ $requests->links('ark.components.pagination.tailwind-pagination') }}
                </div>
            @endif
        </div>

        <!-- View Member Modal -->
        @if($showViewModal)
            <div
                class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center p-4"
                x-data="{ open: true }" x-show="open"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95">
                <div
                    class="relative bg-white rounded-2xl shadow-xl border border-gray-200 w-full max-w-md sm:max-w-lg md:max-w-2xl">
                    <div class="flex justify-between items-center border-b border-gray-200 p-4 sm:p-6">
                        <h3 class="text-lg sm:text-xl font-semibold text-gray-900">Member Details</h3>
                        <button type="button" wire:click="closeModal"
                                class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                            <svg class="w-5 sm:w-6 h-5 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <div class="p-4 sm:p-6 space-y-4 sm:space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0 h-12 w-12 sm:h-16 sm:w-16">
                                <div
                                    class="h-12 w-12 sm:h-16 sm:w-16 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center shadow-sm">
                            <span
                                class="text-base sm:text-xl font-medium text-white">{{ substr($this->first_name, 0, 1) }}</span>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-base sm:text-lg font-semibold text-gray-900">{{ $this->first_name }} {{ $this->middle_name ?? '' }} {{ $this->family_name }}</h4>
                                <p class="text-sm text-gray-600">PRC No. {{ $this->prc_registration_number }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                                <p class="text-sm text-gray-900">{{ $this->email }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Mobile</label>
                                <p class="text-sm text-gray-900">{{ $this->mobile }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Account Status</label>
                                <p class="mt-1">
                                    @if($this->status === 'active')
                                        <span
                                            class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 items-center gap-1">
                                    <span class="h-2 w-2 rounded-full bg-green-500"></span> Active
                                </span>
                                    @elseif($this->status === 'pending')
                                        <span
                                            class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 items-center gap-1">
                                    <span class="h-2 w-2 rounded-full bg-yellow-500"></span> Pending
                                </span>
                                    @else
                                        <span
                                            class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 items-center gap-1">
                                    <span class="h-2 w-2 rounded-full bg-gray-500"></span> Inactive
                                </span>
                                    @endif
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Current Chapter</label>
                                <span
                                    class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $this->current_chapter }}
                        </span>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Date Added</label>
                                <p class="text-sm text-gray-900">{{ $this->payment_date }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Last Updated</label>
                                <p class="text-sm text-gray-900">{{ $this->updated_at }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end p-4 sm:p-6 border-t border-gray-200">
                        <button type="button" wire:click="closeModal"
                                class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded font-medium transition-all duration-200">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>

</div>
