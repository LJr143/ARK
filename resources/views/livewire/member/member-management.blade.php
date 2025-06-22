<div x-data="{ showFilters: false }" class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <!-- Animated Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div
            class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-blue-400 to-purple-600 rounded-full opacity-10 animate-pulse"></div>
        <div
            class="absolute -bottom-40 -left-40 w-96 h-96 bg-gradient-to-tr from-indigo-400 to-cyan-500 rounded-full opacity-10 animate-pulse"
            style="animation-delay: 1s;"></div>
    </div>

    <div class="relative z-10 container mx-auto px-4 py-8 space-y-8">
        <!-- Enhanced Header -->
        <div
            class="relative overflow-hidden bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 p-6 sm:p-8 transition-all duration-500 hover:shadow-3xl group">
            <div
                class="absolute inset-0 bg-gradient-to-r from-blue-600/10 via-purple-600/10 to-indigo-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="relative flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-gray-900 via-blue-800 to-purple-800 bg-clip-text text-transparent">
                            Members Management
                        </h1>
                        <p class="text-gray-600 font-medium">Manage your organization members efficiently</p>
                    </div>
                </div>
                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-3 w-full lg:w-auto">
                    <!-- Download Template Button -->
                    <button
                        wire:click="downloadTemplate"
                        wire:target="downloadTemplate"
                        wire:loading.attr="disabled"
                        wire:loading.class="opacity-75 cursor-not-allowed"
                        class="flex-1 lg:flex-none px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-2xl transition-all duration-300 flex items-center justify-center gap-2 shadow-lg hover:shadow-xl hover:-translate-y-0.5 border border-white/20">
        <span wire:loading wire:target="downloadTemplate">
            <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </span>
                        <span wire:loading.remove wire:target="downloadTemplate">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </span>
                        <span wire:loading.class="invisible" wire:target="downloadTemplate">
            Download Template
        </span>
                    </button>

                    <!-- Import Button -->
                    <button
                        wire:click="openImportModal"
                        wire:target="openImportModal"
                        wire:loading.attr="disabled"
                        wire:loading.class="opacity-75 cursor-not-allowed"
                        class="flex-1 lg:flex-none px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-semibold rounded-2xl transition-all duration-300 flex items-center justify-center gap-2 shadow-lg hover:shadow-xl hover:-translate-y-0.5 border border-white/20">
        <span wire:loading wire:target="openImportModal">
            <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </span>
                        <span wire:loading.remove wire:target="openImportModal">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
            </svg>
        </span>
                        <span wire:loading.class="invisible" wire:target="openImportModal">
            Import
        </span>
                    </button>

                    <!-- Export Button -->
                    <button
                        wire:click="export"
                        wire:target="export"
                        wire:loading.attr="disabled"
                        wire:loading.class="opacity-75 cursor-not-allowed"
                        class="flex-1 lg:flex-none px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold rounded-2xl transition-all duration-300 flex items-center justify-center gap-2 shadow-lg hover:shadow-xl hover:-translate-y-0.5 border border-white/20">
        <span wire:loading wire:target="export">
            <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </span>
                        <span wire:loading.remove wire:target="export">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
            </svg>
        </span>
                        <span wire:loading.class="invisible" wire:target="export">
            Export
        </span>
                    </button>

                    <!-- Membership Registration Button -->
                    <button
                        wire:navigate
                        wire:target="navigate"
                        wire:loading.attr="disabled"
                        wire:loading.class="opacity-75 cursor-not-allowed"
                        href="{{ route('membership.form') }}"
                        class="flex-1 lg:flex-none px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-2xl transition-all duration-300 flex items-center justify-center gap-2 shadow-lg hover:shadow-xl hover:-translate-y-0.5 border border-white/20">
        <span wire:loading wire:target="navigate">
            <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </span>
                        <span wire:loading.remove wire:target="navigate">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
        </span>
                        <span wire:loading.class="invisible" wire:target="navigate">
            Membership Registration
        </span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Enhanced Search and Filters -->
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 p-6">
            <div class="flex flex-col sm:flex-row items-center gap-4">
                <div class="w-full">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Search Members</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-blue-600 transition-colors"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input wire:model.live="search"
                               type="text"
                               placeholder="Search members by name, email, or PRC number..."
                               class="w-full pl-12 pr-4 py-4 border-2 border-gray-200/50 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 bg-white/80 backdrop-blur-sm text-gray-900 placeholder-gray-500 shadow-sm hover:shadow-md">
                    </div>
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
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform -translate-y-4"
                x-init="setTimeout(() => show = false, 5000)">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="p-2 bg-emerald-500 rounded-xl mr-4">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="font-semibold text-emerald-800">{{ session('message') }}</p>
                    </div>
                    <button @click="show = false" class="text-emerald-600 hover:text-emerald-800 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
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
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform -translate-y-4"
                x-init="setTimeout(() => show = false, 5000)">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="p-2 bg-red-500 rounded-xl mr-4">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <p class="font-semibold text-red-800">{{ session('error') }}</p>
                    </div>
                    <button @click="show = false" class="text-red-600 hover:text-red-800 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        <!-- Enhanced Members Table -->
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 overflow-hidden">
            <!-- Table Header with Stats -->
            <div class="bg-gradient-to-r from-gray-50/80 to-blue-50/80 p-6 border-b border-gray-200/50">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Members List</h3>
                        <p class="text-gray-600">{{ $members->total() }} total members found</p>
                    </div>
                    <div class="flex gap-4">
                        <div class="text-center">
                            <div
                                class="text-2xl font-bold text-emerald-600">{{ $members->where('status', 'approved')->count() }}</div>
                            <div class="text-xs text-gray-500">Active</div>
                        </div>
                        <div class="text-center">
                            <div
                                class="text-2xl font-bold text-yellow-600">{{ $members->where('status', 'pending')->count() }}</div>
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
                            Member
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider hidden sm:table-cell">
                            Status
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider hidden md:table-cell">
                            Chapter
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider hidden lg:table-cell">
                            Contact
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider hidden xl:table-cell">
                            Date Added
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200/50">
                    @forelse($members as $index => $member)
                        <tr
                            class="group hover:bg-gradient-to-r hover:from-blue-50/50 hover:to-indigo-50/50 transition-all duration-300 hover:shadow-md"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform translate-y-4"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            style="transition-delay: {{ $index * 50 }}ms;">
                            <td class="px-6 py-6">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                        <span
                                            class="text-sm font-medium text-white">{{ substr($member->first_name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <div
                                            class="font-semibold text-gray-900">{{ trim("{$member->first_name} {$member->middle_name} {$member->family_name}") }}</div>
                                        <div class="text-xs text-gray-500">PRC
                                            No. {{ $member->prc_registration_number }}</div>
                                        <div class="sm:hidden mt-1">
                                            @if($member->status === 'active')
                                                <span
                                                    class="inline-flex items-center px-3 py-2 rounded-full text-xs font-bold bg-gradient-to-r from-emerald-100 to-green-100 text-emerald-800 shadow-sm">
                                                        <span
                                                            class="w-2 h-2 bg-emerald-500 rounded-full mr-2 animate-pulse"></span>
                                                        Active
                                                    </span>
                                            @elseif($member->status === 'pending')
                                                <span
                                                    class="inline-flex items-center px-3 py-2 rounded-full text-xs font-bold bg-gradient-to-r from-yellow-100 to-orange-100 text-yellow-800 shadow-sm">
                                                        <span
                                                            class="w-2 h-2 bg-yellow-500 rounded-full mr-2 animate-pulse"></span>
                                                        Pending
                                                    </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center px-3 py-2 rounded-full text-xs font-bold bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 shadow-sm">
                                                        <span class="w-2 h-2 bg-gray-500 rounded-full mr-2"></span>
                                                        Inactive
                                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-6 hidden sm:table-cell">
                                @if($member->status === 'approved')
                                    <span
                                        class="inline-flex items-center px-3 py-2 rounded-full text-xs font-bold bg-gradient-to-r from-emerald-100 to-green-100 text-emerald-800 shadow-sm">
                                            <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2 animate-pulse"></span>
                                            Active
                                        </span>
                                @elseif($member->status === 'pending')
                                    <span
                                        class="inline-flex items-center px-3 py-2 rounded-full text-xs font-bold bg-gradient-to-r from-yellow-100 to-orange-100 text-yellow-800 shadow-sm">
                                            <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2 animate-pulse"></span>
                                            Pending
                                        </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-2 rounded-full text-xs font-bold bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 shadow-sm">
                                            <span class="w-2 h-2 bg-gray-500 rounded-full mr-2"></span>
                                            Inactive
                                        </span>
                                @endif
                            </td>
                            <td class="px-6 py-6 hidden md:table-cell">
                                    <span
                                        class="inline-flex px-3 py-2 rounded-full text-xs font-bold bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 shadow-sm">
                                        {{ $member->current_chapter }}
                                    </span>
                            </td>
                            <td class="px-6 py-6 hidden lg:table-cell">
                                <div class="text-sm text-gray-900">{{ $member->email }}</div>
                                <div class="text-xs text-gray-500">{{ $member->mobile }}</div>
                            </td>
                            <td class="px-6 py-6 hidden xl:table-cell">
                                <div
                                    class="text-sm text-gray-700">{{ \Carbon\Carbon::parse($member->created_at)->format('M j, Y') }}</div>
                                <div
                                    class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($member->created_at)->format('g:i A') }}</div>
                            </td>
                            <td class="px-6 py-6 text-right">
                                <div class="flex justify-end gap-2">
                                    @if($member->status === 'pending')
                                        <!-- Approve Button with Loading State -->
                                        <button
                                            wire:click="approveApplication({{ $member->id }})"
                                            wire:target="approveApplication"
                                            wire:loading.attr="disabled"
                                            wire:loading.class="opacity-75 cursor-not-allowed"
                                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white text-sm font-semibold rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-green-600/30 hover:-translate-y-0.5 group">
                <span wire:loading wire:target="approveApplication">
                    <svg class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </span>
                                            <span wire:loading.remove wire:target="approveApplication">
                    <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </span>
                                            <span wire:loading.class="invisible" wire:target="approveApplication">
                    Approve
                </span>
                                        </button>

                                        <!-- Reject Button with Loading State -->
                                        <button
                                            wire:click="rejectApplication({{ $member->id }})"
                                            wire:target="rejectApplication"
                                            wire:loading.attr="disabled"
                                            wire:loading.class="opacity-75 cursor-not-allowed"
                                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white text-sm font-semibold rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-red-600/30 hover:-translate-y-0.5 group">
                <span wire:loading wire:target="rejectApplication">
                    <svg class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </span>
                                            <span wire:loading.remove wire:target="rejectApplication">
                    <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </span>
                                            <span wire:loading.class="invisible" wire:target="rejectApplication">
                    Reject
                </span>
                                        </button>
                                    @else
                                        <!-- View Button with Loading State -->
                                        <button
                                            wire:click="openViewModal({{ $member->id }})"
                                            wire:target="openViewModal({{ $member->id }})"
                                        wire:loading.attr="disabled"
                                        wire:loading.class="opacity-75 cursor-not-allowed"
                                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white text-sm font-semibold rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-blue-600/30 hover:-translate-y-0.5 group">

                                        <!-- Update all target references to include the ID -->
                                        <span wire:loading wire:target="openViewModal({{ $member->id }})">
                                                    <svg class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                        </span>

                                                                            <span wire:loading.remove wire:target="openViewModal({{ $member->id }})">
                                            <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </span>

                                                                            <span wire:loading.class="invisible" wire:target="openViewModal({{ $member->id }})">
                                            View
                                        </span>
                                        </button>

                                        <!-- Edit Button with Loading State -->
                                        <button
                                            wire:click="openEditModal({{ $member->id }})"
                                            wire:target="openEditModal({{ $member->id }})"
                                            wire:loading.attr="disabled"
                                            wire:loading.class="opacity-75 cursor-not-allowed"
                                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white text-sm font-semibold rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-indigo-600/20 hover:-translate-y-0.5 group">

    <span wire:loading wire:target="openEditModal({{ $member->id }})">
        <svg class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    </span>

                                            <span wire:loading.remove wire:target="openEditModal({{ $member->id }})">
        <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
        </svg>
    </span>

                                            <span wire:loading.class="invisible" wire:target="openEditModal({{ $member->id }})">
        Edit
    </span>
                                        </button>

                                        <!-- Delete Button with Loading State -->
                                        <button
                                            wire:click="delete({{ $member->id }})"
                                            wire:target="delete({{ $member->id }})"
                                            wire:loading.attr="disabled"
                                            wire:loading.class="opacity-75 cursor-not-allowed"
                                            onclick="return confirm('Are you sure you want to delete this member?') || event.stopImmediatePropagation()"
                                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white text-sm font-semibold rounded-xl transition-all duration-300 hover:shadow-lg hover:shadow-red-600/30 hover:-translate-y-0.5 group">

    <span wire:loading wire:target="delete({{ $member->id }})">
        <svg class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    </span>

                                            <span wire:loading.remove wire:target="delete({{ $member->id }})">
        <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
        </svg>
    </span>

                                            <span wire:loading.class="invisible" wire:target="delete({{ $member->id }})">
        Delete
    </span>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div
                                        class="w-24 h-24 bg-gradient-to-r from-gray-200 to-gray-300 rounded-3xl flex items-center justify-center mb-6">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-700 mb-2">No members found</h3>
                                    <p class="text-gray-500 max-w-md">Get started by adding your first member</p>
                                    <button wire:navigate href="{{ route('membership.form') }}"
                                            class="mt-4 px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-2xl transition-all duration-300 flex items-center gap-2 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        Membership Registration
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Enhanced Pagination -->
            @if($members->hasPages())
                <div class="bg-gradient-to-r from-gray-50/50 to-blue-50/50 px-6 py-4 border-t border-gray-200/50">
                    {{ $members->links('ark.components.pagination.tailwind-pagination') }}
                </div>
            @endif
        </div>


    </div>
    <!-- View Member Modal -->
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
                class="relative bg-white/95 backdrop-blur-xl rounded shadow-2xl border border-white/20 w-full max-w-2xl max-h-[90vh] overflow-y-auto"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95">
                <!-- Modal Header -->
                <div
                    class="flex justify-between items-center border-b border-gray-200/50 p-6 bg-gradient-to-r from-blue-50/50 to-purple-50/50 rounded">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-gradient-to-r from-blue-600 to-purple-600 rounded shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">Member Details</h3>
                            <p class="text-gray-600">{{ trim("{$this->first_name} {$this->middle_name} {$this->family_name}") }}</p>
                        </div>
                    </div>
                    <button type="button" wire:click="closeModal"
                            class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded transition-all duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Modal Content -->
                <div class="p-6 space-y-8">
                    <!-- Member Information -->
                    <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded p-6 border border-blue-200/50">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 h-14 w-14">
                                <div
                                    class="h-14 w-14 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg">
                                    <span
                                        class="text-lg font-medium text-white">{{ substr($this->first_name, 0, 1) }}</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-semibold text-gray-900">{{ trim("{$this->first_name} {$this->middle_name} {$this->family_name}") }}</h4>
                                <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">PRC No.</p>
                                        <p class="text-sm font-semibold text-gray-900">{{ $this->prc_registration_number }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 font-medium">Status</p>
                                        @if($this->status === 'approved')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-emerald-100 text-emerald-800">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001 funding: 1.414 0l4-4z"
                                                              clip-rule="evenodd"/>
                                                    </svg>
                                                    Active
                                                </span>
                                        @elseif($this->status === 'pending')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                              clip-rule="evenodd"/>
                                                    </svg>
                                                    Pending
                                                </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                              d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                              clip-rule="evenodd"/>
                                                    </svg>
                                                    Inactive
                                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact & Chapter Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <h5 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                                Contact Information
                            </h5>
                            <div class="space-y-3">
                                <div class="p-4 bg-gray-50/80 rounded-xl">
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                                    <p class="text-sm font-mono text-gray-900 bg-white px-3 py-2 rounded-lg">{{ $this->email }}</p>
                                </div>
                                <div class="p-4 bg-gray-50/80 rounded-xl">
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Mobile</label>
                                    <p class="text-sm font-mono text-gray-900 bg-white px-3 py-2 rounded-lg">{{ $this->mobile }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <h5 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                <div class="w-2 h-2 bg-purple-600 rounded-full"></div>
                                Chapter Information
                            </h5>
                            <div class="space-y-3">
                                <div class="p-4 bg-gray-50/80 rounded-xl">
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Current
                                        Chapter</label>
                                    <p class="text-sm font-mono text-gray-900 bg-white px-3 py-2 rounded-lg">{{ $this->current_chapter }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dates -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <h5 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                                Dates
                            </h5>
                            <div class="space-y-3">
                                <div class="p-4 bg-gray-50/80 rounded-xl">
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Date Added</label>
                                    <p class="text-sm font-mono text-gray-900 bg-white px-3 py-2 rounded-lg">{{ \Carbon\Carbon::parse($this->date_added)->format('F j, Y g:i A') }}</p>
                                </div>
                                <div class="p-4 bg-gray-50/80 rounded-xl">
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Last Updated</label>
                                    <p class="text-sm font-mono text-gray-900 bg-white px-3 py-2 rounded-lg">{{ \Carbon\Carbon::parse($this->updated_at)->format('F j, Y g:i A') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end gap-3 p-6 border-t border-gray-200/50 bg-gray-50/50 rounded-b-3xl">
                    <button type="button" wire:click="closeModal"
                            class="px-6 py-3 bg-white hover:bg-gray-50 text-gray-700 font-semibold rounded-xl border border-gray-200 transition-all duration-200 hover:shadow-md">
                        Close
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Import Modal -->
    @if($showImportModal)
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
                <form wire:submit.prevent="import">
                    <div
                        class="flex justify-between items-center border-b border-gray-200/50 p-6 bg-gradient-to-r from-blue-50/50 to-purple-50/50 rounded-t-3xl">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">Import Members</h3>
                                <p class="text-gray-600">Upload your member data file</p>
                            </div>
                        </div>
                        <button type="button" wire:click="closeImportModal"
                                class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-xl transition-all duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- Instructions -->
                        <div class="bg-blue-50/80 border border-blue-200/50 rounded-2xl p-4">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <h4 class="text-sm font-semibold text-blue-800">Import Instructions</h4>
                                    <ul class="mt-2 text-sm text-blue-700 list-disc list-inside space-y-1">
                                        <li>Download the template first</li>
                                        <li>Fill in your member data</li>
                                        <li>Upload the completed file</li>
                                        <li>Supported formats: .xlsx, .xls, .csv</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- File Upload -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Choose File <span
                                    class="text-red-500">*</span></label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300/50 border-dashed rounded-2xl hover:border-blue-500/50 transition-all duration-300">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                         viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="file-upload"
                                               class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                            <span>Upload a file</span>
                                            <input wire:model="importFile" id="file-upload" name="file-upload"
                                                   type="file" class="sr-only" accept=".xlsx,.xls,.csv">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">Excel or CSV up to 10MB</p>
                                </div>
                            </div>
                            @error('importFile') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            @if($importFile)
                                <div class="text-sm text-gray-900 mt-2 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M5 13l4 4L19 7"/>
                                    </svg>
                                    {{ $importFile->getClientOriginalName() }}
                                </div>
                            @endif
                        </div>

                        <!-- Import Results (Shown after import) -->
                        @if($importResults)
                            <div class="bg-gray-50/80 border border-gray-200/50 rounded-2xl p-4 space-y-3">
                                <h4 class="text-sm font-medium text-gray-800">Import Results</h4>
                                <div class="text-sm text-gray-700 space-y-2">
                                    <p><span
                                            class="font-medium">Successful Imports:</span> {{ $importResults['successful'] }}
                                    </p>
                                    <p><span
                                            class="font-medium">Duplicates Skipped:</span> {{ $importResults['duplicates'] }}
                                    </p>
                                    @ CBDC if(!empty($importResults['errors']))
                                    <div>
                                        <p class="font-medium text-red-600">Errors:</p>
                                        <ul class="list-disc list-inside text-red-600 space-y-1">
                                            @foreach($importResults['errors'] as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="flex justify-end gap-3 p-6 border-t border-gray-200/50 bg-gray-50/50 rounded-b-3xl">
                        <button type="button" wire:click="closeImportModal"
                                class="px-6 py-3 bg-white hover:bg-gray-50 text-gray-700 font-semibold rounded-xl border border-gray-200 transition-all duration-200 hover:shadow-md">
                            Cancel
                        </button>
                        <button type="submit"
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-75 cursor-not-allowed"
                                class="px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-semibold rounded-xl transition-all duration-200 hover:shadow-lg hover:shadow-blue-600/30 flex items-center gap-2">
                            <span wire:loading.remove>Import Members</span>
                            <span wire:loading class="flex items-center gap-2">
                                    <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Importing...
                                </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Add/Edit Member Modal -->
    @if($showModal)
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
                <form wire:submit.prevent="save">
                    <div
                        class="flex justify-between items-center border-b border-gray-200/50 p-6 bg-gradient-to-r from-blue-50/50 to-purple-50/50 rounded-t-3xl">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">{{ $editMode ? 'Edit Member' : 'Add New Member' }}</h3>
                                <p class="text-gray-600">{{ $editMode ? 'Update member details' : 'Create a new member profile' }}</p>
                            </div>
                        </div>
                        <button type="button" wire:click="closeModal"
                                class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-xl transition-all duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">First Name <span
                                        class="text-red-500">*</span></label>
                                <input wire:model="first_name" type="text"
                                       class="w-full px-4 py-3 border-2 border-gray-200/50 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 bg-white/80 backdrop-blur-sm text-gray-900 placeholder-gray-500 shadow-sm hover:shadow-md">
                                @error('first_name') <span
                                    class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                                <input wire:model="middle_name" type="text"
                                       class="w-full px-4 py-3 border-2 border-gray-200/50 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 bg-white/80 backdrop-blur-sm text-gray-900 placeholder-gray-500 shadow-sm hover:shadow-md">
                                @error('middle_name') <span
                                    class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Family Name <span
                                        class="text-red-500">*</span></label>
                                <input wire:model="family_name" type="text"
                                       class="w-full px-4 py-3 border-2 border-gray-200/50 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 bg-white/80 backdrop-blur-sm text-gray-900 placeholder-gray-500 shadow-sm hover:shadow-md">
                                @error('family_name') <span
                                    class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">PRC Number <span
                                        class="text-red-500">*</span></label>
                                <input wire:model="prc_registration_number" type="text"
                                       class="w-full px-4 py-3 border-2 border-gray-200/50 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 bg-white/80 backdrop-blur-sm text-gray-900 placeholder-gray-500 shadow-sm hover:shadow-md">
                                @error('prc_registration_number') <span
                                    class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Mobile Number</label>
                                <input wire:model="mobile" type="text"
                                       class="w-full px-4 py-3 border-2 border-gray-200/50 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 bg-white/80 backdrop-blur-sm text-gray-900 placeholder-gray-500 shadow-sm hover:shadow-md">
                                @error('mobile') <span
                                    class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email <span
                                        class="text-red-500">*</span></label>
                                <input wire:model="email" type="email"
                                       class="w-full px-4 py-3 border-2 border-gray-200/50 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 bg-white/80 backdrop-blur-sm text-gray-900 placeholder-gray-500 shadow-sm hover:shadow-md">
                                @error('email') <span
                                    class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Account Status</label>
                                <select wire:model="status"
                                        class="w-full px-4 py-3 border-2 border-gray-200/50 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 bg-white/80 backdrop-blur-sm text-gray-900 shadow-sm hover:shadow-md">
                                    <option value="approved">Active</option>
                                    <option value="pending">Pending</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                @error('status') <span
                                    class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Current Chapter</label>
                                <input wire:model="current_chapter" type="text"
                                       class="w-full px-4 py-3 border-2 border-gray-200/50 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 bg-white/80 backdrop-blur-sm text-gray-900 placeholder-gray-500 shadow-sm hover:shadow-md">
                                @error('current_chapter') <span
                                    class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 p-6 border-t border-gray-200/50 bg-gray-50/50 rounded-b-3xl">
                        <button type="button" wire:click="closeModal"
                                class="px-6 py-3 bg-white hover:bg-gray-50 text-gray-700 font-semibold rounded-xl border border-gray-200 transition-all duration-200 hover:shadow-md">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold rounded-xl transition-all duration-200 hover:shadow-lg hover:shadow-blue-600/30">
                            {{ $editMode ? 'Update Member' : 'Add Member' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

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
            0% {
                background-position: -200px 0;
            }
            100% {
                background-position: calc(200px + 100%) 0;
            }
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
            Alpine.data('memberTable', () => ({
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

        document.addEventListener('DOMContentLoaded', function () {
            const links = document.querySelectorAll('a[href^="#"]');
            links.forEach(link => {
                link.addEventListener('click', function (e) {
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
