<div class="min-h-screen bg-gray-50">
    <div class="container mx-auto px-4 py-4 lg:py-6 max-w-12xl">

        {{-- Flash Messages --}}
        @if (session()->has('message'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>{{ session('message') }}</span>
                </div>
            </div>
        @endif

        {{-- Header Section --}}
        <div class="bg-white rounded-xl gradient-bg shadow-sm mb-6 overflow-hidden">
            <div class="p-4 lg:p-6">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                    <div class="flex-1">
                        <div class="relative overflow-hidden bg-white rounded-3xl shadow-2xl mb-8 animate-fade-in-up">
                            <div class="absolute inset-0 gradient-bg opacity-90"></div>
                            <div
                                class="absolute top-0 right-0 w-96 h-96 bg-white opacity-10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                            <div
                                class="absolute bottom-0 left-0 w-72 h-72 bg-white opacity-5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
                            <div class="relative flex justify-between p-8 lg:p-12">
                                <div>
                                    <div class="flex items-center gap-4 mb-4">
                                        <div
                                            class="p-3 bg-primary bg-opacity-20 rounded-2xl backdrop-blur-sm animate-float">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white"
                                                 fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <h1 class="text-2xl lg:text-3xl text-white font-bold">Reminders</h1>
                                    </div>
                                    <p class="text-white text-sm lg:text-base">Manage and track member reminders</p>
                                </div>
                                @can('send-reminder')
                                    {{-- Action Button --}}
                                    <div class="flex-shrink-0">
                                        <button wire:click="openSendModal"
                                                class="w-full sm:w-auto bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-lg flex items-center justify-center space-x-2 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                            <i class="fas fa-paper-plane"></i>
                                            <span class="font-medium">Send Reminder</span>
                                        </button>
                                    </div>
                                @endcan
                            </div>
                        </div>

                        {{-- Desktop Navigation --}}
                        <nav class="hidden lg:flex space-x-8 mt-6">
                            <button wire:click="setMainTab('recipients')"
                                    class="transition-colors duration-200 {{ $activeMainTab === 'recipients' ? 'text-white border-b-2 border-blue-600 pb-2 font-semibold' : 'text-black hover:text-gray-700 pb-2 font-medium' }}">
                                <i class="fas fa-users mr-2"></i>Recipients and Reminder Details
                            </button>
                        </nav>

                        {{-- Mobile Navigation Button --}}
                        <button wire:click="toggleMobileMenu"
                                class="lg:hidden flex items-center mt-4 px-4 py-2 bg-gray-100 rounded-lg text-gray-700 hover:bg-gray-200 transition-colors w-full sm:w-auto">
                            <i class="fas fa-bars mr-2"></i>
                            <span>{{ ucfirst($activeMainTab) }}</span>
                            <i class="fas fa-chevron-down ml-auto transform transition-transform {{ $showMobileMenu ? 'rotate-180' : '' }}"></i>
                        </button>

                        {{-- Mobile Navigation Menu --}}
                        @if($showMobileMenu)
                            <div
                                class="lg:hidden mt-2 bg-white border border-gray-200 rounded-lg shadow-lg py-2 animate-fade-in">
                                <button wire:click="setMainTab('list')"
                                        class="w-full text-left px-4 py-3 hover:bg-gray-50 transition-colors {{ $activeMainTab === 'list' ? 'bg-blue-50 text-blue-600' : '' }}">
                                    <i class="fas fa-list mr-3"></i>List
                                </button>
                                <button wire:click="setMainTab('manage')"
                                        class="w-full text-left px-4 py-3 hover:bg-gray-50 transition-colors {{ $activeMainTab === 'manage' ? 'bg-blue-50 text-blue-600' : '' }}">
                                    <i class="fas fa-cog mr-3"></i>Manage Reminder
                                </button>
                                <button wire:click="setMainTab('recipients')"
                                        class="w-full text-left px-4 py-3 hover:bg-gray-50 transition-colors {{ $activeMainTab === 'recipients' ? 'bg-blue-50 text-blue-600' : '' }}">
                                    <i class="fas fa-users mr-3"></i>Recipients
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">

            <!-- Send Reminder Modal -->
            @if($showSendModal)
                <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                        <div class="mt-3 text-center">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Send Reminder</h3>

                            <!-- Loading State -->
                            @if($sendingNotification)
                                <div class="mb-4">
                                    <div class="flex items-center justify-center">
                                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-500"
                                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                    stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        <span>Sending notifications...</span>
                                    </div>
                                </div>
                            @endif

                            <!-- Results Display -->
                            @if($notificationResults && !$sendingNotification)
                                <div class="mb-4 p-4 border rounded-lg">
                                    @if(isset($notificationResults['error']) && $notificationResults['error'])
                                        <div class="text-red-600">
                                            <h4 class="font-medium">Error occurred:</h4>
                                            <p class="text-sm">{{ $notificationResults['message'] }}</p>
                                        </div>
                                    @else
                                        <div class="text-left">
                                            <h4 class="font-medium text-gray-900 mb-2">Notification Results:</h4>

                                            <!-- Email Results -->
                                            <div class="mb-2">
                                                <span class="text-sm font-medium">Email:</span>
                                                <span class="text-sm text-green-600">{{ $notificationResults['email']['sent'] ?? 0 }} sent</span>
                                                @if(isset($notificationResults['email']['failed']) && $notificationResults['email']['failed'] > 0)
                                                    <span class="text-sm text-red-600">, {{ $notificationResults['email']['failed'] }} failed</span>
                                                @endif
                                            </div>

                                            <!-- SMS Results -->
                                            <div class="mb-2">
                                                <span class="text-sm font-medium">SMS:</span>
                                                <span class="text-sm text-green-600">{{ $notificationResults['sms']['sent'] ?? 0 }} sent</span>
                                                @if(isset($notificationResults['sms']['failed']) && $notificationResults['sms']['failed'] > 0)
                                                    <span class="text-sm text-red-600">, {{ $notificationResults['sms']['failed'] }} failed</span>
                                                @endif
                                            </div>

                                            <!-- App Notification Results -->
                                            <div class="mb-2">
                                                <span class="text-sm font-medium">App:</span>
                                                <span class="text-sm text-green-600">{{ $notificationResults['app']['sent'] ?? 0 }} sent</span>
                                                @if(isset($notificationResults['app']['failed']) && $notificationResults['app']['failed'] > 0)
                                                    <span class="text-sm text-red-600">, {{ $notificationResults['app']['failed'] }} failed</span>
                                                @endif
                                            </div>

                                            <!-- Total -->
                                            @php
                                                $totalSent = ($notificationResults['email']['sent'] ?? 0) +
                                                           ($notificationResults['sms']['sent'] ?? 0) +
                                                           ($notificationResults['app']['sent'] ?? 0);
                                            @endphp
                                            <div class="mt-2 pt-2 border-t">
                                                <span class="text-sm font-medium">Total: </span>
                                                <span class="text-sm font-bold text-green-600">{{ $totalSent }} notifications sent</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="flex justify-center space-x-3">
                                @if(!$notificationResults || $sendingNotification)
                                    <button wire:click="sendReminder"
                                            wire:loading.attr="disabled"
                                            wire:target="sendReminder"
                                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 disabled:opacity-50">

                                        <span wire:loading wire:target="sendReminder">Sending...</span>
                                        <span wire:loading.remove wire:target="sendReminder">Send Reminder</span>
                                    </button>
                                @endif

                                <button wire:click="closeSendModal"
                                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                                    @if($notificationResults && !$sendingNotification)
                                        Close
                                    @else
                                        Cancel
                                    @endif
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Sub Navigation for Recipients Tab --}}
            @if($activeMainTab === 'recipients')
                <div class="border-b border-gray-200">
                    <div class="px-4 lg:px-6 py-4">
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                            <nav class="flex space-x-6 overflow-x-auto">
                                <button wire:click="setSubTab('details')"
                                        class="whitespace-nowrap transition-colors duration-200 {{ $activeSubTab === 'details' ? 'text-blue-600 border-b-2 border-blue-600 pb-2 font-semibold' : 'text-gray-500 hover:text-gray-700 font-medium' }}">
                                    <i class="fas fa-info-circle mr-2"></i>Reminder Details
                                </button>
                                @can('view-reminder-member')
                                    <button wire:click="setSubTab('members')"
                                            class="whitespace-nowrap transition-colors duration-200 {{ $activeSubTab === 'members' ? 'text-blue-600 border-b-2 border-blue-600 pb-2 font-semibold' : 'text-gray-500 hover:text-gray-700 font-medium' }}">
                                        <i class="fas fa-users mr-2"></i>Members
                                    </button>
                                @endcan
                            </nav>

                            @if($reminder->recipient_type !== 'public')
                                @can('add-member-reminder')
                                    <button wire:click="openAddMemberModal"
                                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <i class="fas fa-plus mr-2"></i>
                                        Add First Member
                                    </button>
                                @endcan
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            {{-- Tab Content --}}
            <div class="p-4 lg:p-6">

                {{-- Recipients Tab --}}
                @if($activeMainTab === 'recipients')
                    {{-- Members Sub-tab --}}
                    @can('view-reminder-member')
                        @if($activeSubTab === 'members')
                            @if($members->count() > 0)
                                {{-- Stats Cards --}}
                                @php
                                    $cards = [
                                        [
                                            'show' => $reminder->category->name === 'Deadline',
                                            'color' => 'from-green-500 to-green-600',
                                            'text' => 'text-green-100',
                                            'icon' => 'fa-check-circle',
                                            'iconColor' => 'text-green-200',
                                            'label' => 'Paid',
                                            'count' => $members->where('payment_status', 'paid')->count()
                                        ],
                                        [
                                            'show' => $reminder->category->name === 'Deadline',
                                            'color' => 'from-yellow-500 to-yellow-600',
                                            'text' => 'text-yellow-100',
                                            'icon' => 'fa-clock',
                                            'iconColor' => 'text-yellow-200',
                                            'label' => 'Unpaid',
                                            'count' => $members->where('payment_status', 'unpaid')->count()
                                        ],
                                        [
                                            'show' => $reminder->category->name === 'Deadline',
                                            'color' => 'from-red-500 to-red-600',
                                            'text' => 'text-red-100',
                                            'icon' => 'fa-exclamation-triangle',
                                            'iconColor' => 'text-red-200',
                                            'label' => 'Overdue',
                                            'count' => $members->where('payment_status', 'overdue')->count()
                                        ],
                                        [
                                            'show' => true, // Always show total
                                            'color' => 'from-blue-500 to-blue-600',
                                            'text' => 'text-blue-100',
                                            'icon' => 'fa-users',
                                            'iconColor' => 'text-blue-200',
                                            'label' => 'Total',
                                            'count' => $members->count()
                                        ]
                                    ];
                                @endphp

                                <div class="grid grid-cols-1 gap-4 mb-6
                                @if($reminder->category->name === 'Deadline') sm:grid-cols-2 lg:grid-cols-4 @else sm:grid-cols-1 @endif">
                                    @foreach($cards as $card)
                                        @if($card['show'])
                                            <div
                                                class="bg-gradient-to-r {{ $card['color'] }} rounded-lg p-4 text-white">
                                                <div class="flex items-center justify-between">
                                                    <div>
                                                        <p class="{{ $card['text'] }} text-sm">{{ $card['label'] }}</p>
                                                        <p class="text-2xl font-bold">{{ $card['count'] }}</p>
                                                    </div>
                                                    <i class="fas {{ $card['icon'] }} text-2xl {{ $card['iconColor'] }}"></i>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                {{-- Members Table --}}
                                <div class="overflow-hidden rounded-lg border border-gray-200">
                                    {{-- Mobile Cards (visible on small screens) --}}
                                    <div class="block sm:hidden">
                                        @foreach($members as $member)
                                            <div class="bg-white border-b border-gray-200 p-4">
                                                <div class="flex items-start space-x-3">
                                                    <div
                                                        class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0">
                                                        <i class="fas fa-user text-white text-sm"></i>
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <div class="flex items-center justify-between mb-2">
                                                            <h3 class="font-medium text-gray-900 truncate">{{ $member['name'] }}</h3>
                                                            <span
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $this->getPaymentStatusBadgeClass($member['payment_status']) }}">
                                                            {{ ucfirst($member['payment_status']) }}
                                                        </span>
                                                        </div>
                                                        <p class="text-sm text-gray-500 mb-1">PRC
                                                            No. {{ $member['prc_no'] }}</p>
                                                        <p class="text-sm text-gray-900 mb-1">{{ $member['email'] }}</p>
                                                        <p class="text-sm text-gray-500 mb-1">{{ $member['phone'] }}</p>
                                                        <p class="text-xs text-gray-400">
                                                            Added: {{ $member['date_added'] }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    {{-- Desktop Table (hidden on small screens) --}}
                                    <div class="hidden sm:block">
                                        <table class="w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Member
                                                </th>
                                                {{--                                                @if($reminder->category->name == 'Deadline')--}}
                                                {{--                                                    <th class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">--}}
                                                {{--                                                        Payment Status--}}
                                                {{--                                                    </th>--}}
                                                {{--                                                @endif--}}
                                                <th class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Contact Details
                                                </th>
                                                <th class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Date Added
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($members as $member)
                                                <tr class="hover:bg-gray-50 transition-colors">
                                                    <td class="px-4 lg:px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div
                                                                class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0">
                                                                <i class="fas fa-user text-white text-sm"></i>
                                                            </div>
                                                            <div class="ml-3">
                                                                <div
                                                                    class="text-sm font-medium text-gray-900">{{ $member['name'] }}</div>
                                                                <div class="text-sm text-gray-500">PRC
                                                                    No. {{ $member['prc_no'] }}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    {{--                                                    @if($reminder->category->name == 'Deadline')--}}
                                                    {{--                                                    <td class="px-4 lg:px-6 py-4 whitespace-nowrap">--}}
                                                    {{--                                                        <span--}}
                                                    {{--                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $this->getPaymentStatusBadgeClass($member['payment_status']) }}">--}}
                                                    {{--                                                            {{ ucfirst($member['payment_status']) }}--}}
                                                    {{--                                                        </span>--}}
                                                    {{--                                                    </td>--}}
                                                    {{--                                                    @endif--}}
                                                    <td class="px-4 lg:px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{ $member['email'] }}</div>
                                                        <div class="text-sm text-gray-500">{{ $member['phone'] }}</div>
                                                    </td>
                                                    <td class="px-4 lg:px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                        {{ $member['date_added'] }}
                                                    </td>
                                                    @if($reminder->recipient_type != 'public')
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                            @can('remove-member-reminder')
                                                                <button wire:click="removeMember({{ $member['id'] }})"
                                                                        wire:confirm="Are you sure you want to remove this member from the reminder?"
                                                                        class="text-red-600 hover:text-red-900 transition-colors duration-200">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            @endcan
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                {{-- Empty State for Members --}}
                                <div class="text-center py-12">
                                    <div
                                        class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-users text-gray-400 text-3xl"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">No members found</h3>
                                    <p class="text-gray-500 mb-6 max-w-sm mx-auto">Get started by adding your first
                                        member
                                        to the reminder system.</p>
                                    <button wire:click="openAddMemberModal"
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg flex items-center space-x-2 mx-auto transition-colors duration-200">
                                        <i class="fas fa-plus"></i>
                                        <span>Add First Member</span>
                                    </button>
                                </div>
                            @endif
                        @endif
                    @endcan

                    {{-- Details Sub-tab --}}
                    @if($activeSubTab === 'details')
                        @if($reminderDetails)
                            <div>
                                <style>.gradient-bg {
                                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                    }

                                    .glass-effect {
                                        backdrop-filter: blur(10px);
                                        background: rgba(255, 255, 255, 0.95);
                                        border: 1px solid rgba(255, 255, 255, 0.2);
                                    }

                                    .card-hover {
                                        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                                    }

                                    .card-hover:hover {
                                        transform: translateY(-2px);
                                        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
                                    }

                                    .status-badge {
                                        position: relative;
                                        overflow: hidden;
                                    }

                                    .status-badge::before {
                                        content: '';
                                        position: absolute;
                                        top: 0;
                                        left: -100%;
                                        width: 100%;
                                        height: 100%;
                                        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
                                        transition: left 0.5s;
                                    }

                                    .status-badge:hover::before {
                                        left: 100%;
                                    }

                                    .timeline-item {
                                        position: relative;
                                        padding-left: 2rem;
                                    }

                                    .timeline-item::before {
                                        content: '';
                                        position: absolute;
                                        left: 0.5rem;
                                        top: 1rem;
                                        width: 2px;
                                        height: calc(100% - 1rem);
                                        background: linear-gradient(to bottom, #3b82f6, #e5e7eb);
                                    }

                                    .timeline-dot {
                                        position: absolute;
                                        left: 0.25rem;
                                        top: 0.75rem;
                                        width: 0.75rem;
                                        height: 0.75rem;
                                        background: #3b82f6;
                                        border-radius: 50%;
                                        border: 2px solid white;
                                        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
                                    }

                                    .attachment-grid {
                                        display: grid;
                                        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                                        gap: 1rem;
                                    }

                                    .pulse-animation {
                                        animation: pulse 2s infinite;
                                    }

                                    @keyframes pulse {
                                        0%, 100% {
                                            opacity: 1;
                                        }
                                        50% {
                                            opacity: 0.7;
                                        }
                                    }
                                </style>
                                <div class="relative z-10 max-w-full mx-auto px-4 py-8">
                                    <!-- Header Section -->
                                    <div class="gradient-bg rounded-2xl p-8 mb-8 text-white relative overflow-hidden">
                                        <div
                                            class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -translate-y-32 translate-x-32"></div>
                                        <div
                                            class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-5 rounded-full translate-y-24 -translate-x-24"></div>

                                        <div class="relative z-10">
                                            <style>
                                                input, textarea {
                                                    background-color: rgba(255, 255, 255, 0.9);
                                                    transition: all 0.3s ease;
                                                }

                                                input:focus, textarea:focus {
                                                    background-color: white;
                                                    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
                                                }

                                                .file-upload-container {
                                                    background: rgba(255, 255, 255, 0.95);
                                                    backdrop-filter: blur(10px);
                                                    border: 1px solid rgba(255, 255, 255, 0.2);
                                                    border-radius: 0.75rem;
                                                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                                                }

                                                .file-upload-container:hover {
                                                    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                                                }

                                                .attachment-item {
                                                    transition: all 0.3s ease;
                                                }

                                                .attachment-item:hover {
                                                    transform: translateY(-2px);
                                                    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
                                                }

                                                .delete-btn {
                                                    opacity: 0;
                                                    transition: opacity 0.2s ease;
                                                }

                                                .attachment-item:hover .delete-btn {
                                                    opacity: 1;
                                                }

                                                .message-details-pre {
                                                    background: rgba(255, 255, 255, 0.95);
                                                    border-radius: 0.5rem;
                                                    padding: 1rem;
                                                    margin: 0;
                                                    max-height: 300px;
                                                    overflow-y: auto;
                                                    transition: all 0.3s ease;
                                                }

                                                .message-details-pre:hover {
                                                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
                                                }

                                                .message-details-textarea {
                                                    background: rgba(255, 255, 255, 0.95);
                                                    border-radius: 0.5rem;
                                                    padding: 1rem;
                                                    transition: all 0.3s ease;
                                                    resize: vertical; /* Allow vertical resizing only */
                                                    min-height: 100px;
                                                    max-height: 300px;
                                                }

                                                .message-details-textarea:focus {
                                                    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
                                                }

                                                .message-details-pre::-webkit-scrollbar,
                                                .message-details-textarea::-webkit-scrollbar {
                                                    width: 8px;
                                                }

                                                .message-details-pre::-webkit-scrollbar-thumb,
                                                .message-details-textarea::-webkit-scrollbar-thumb {
                                                    background: rgba(59, 130, 246, 0.3);
                                                    border-radius: 4px;
                                                }

                                                .message-details-pre::-webkit-scrollbar-thumb:hover,
                                                .message-details-textarea::-webkit-scrollbar-thumb:hover {
                                                    background: rgba(59, 130, 246, 0.5);
                                                }
                                            </style>
                                            <div
                                                class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
                                                <div class="flex-1">
                                                    <div class="flex items-center gap-3 mb-4">
                                                        <div
                                                            class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                                                            <i class="fas fa-bell text-xl"></i>
                                                        </div>
                                                        <div>
                                                            <div class="w-full">
                                                                @if($isEditing)
                                                                    <input type="text" wire:model="editableFields.title"
                                                                           class="w-full px-4 py-2 bg-white bg-opacity-90 text-gray-900 rounded-lg border border-white border-opacity-30 focus:ring-2 focus:ring-white focus:ring-opacity-50">
                                                                @else
                                                                    <h1 class="text-2xl lg:text-3xl font-bold mb-2">{{ $reminderDetails['title'] }}</h1>
                                                                @endif
                                                            </div>
                                                            <div
                                                                class="flex items-center gap-2 text-white text-opacity-80">
                                                                <i class="fas fa-hashtag text-sm"></i>
                                                                <span
                                                                    class="text-sm font-medium">{{ $reminderDetails['reminder_id'] }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="flex flex-wrap gap-3">
                                                    @can('archive-reminder')
                                                        <button wire:click="toggleArchive"
                                                                class="status-badge px-6 py-3 {{ $reminderDetails['status'] === 'archived' ? 'bg-green-100 text-green-800' : 'bg-white bg-opacity-20 text-white' }} rounded-xl hover:bg-opacity-30 transition-all duration-300 flex items-center gap-2 font-medium">
                                                            <i class="fas fa-archive"></i>
                                                            <span>{{ $reminderDetails['status'] === 'archived' ? 'Unarchive' : 'Archive' }}</span>
                                                        </button>
                                                    @endcan

                                                    @can('edit-reminder')
                                                        @if($isEditing)
                                                            <button wire:click="cancelEditing"
                                                                    class="status-badge px-6 py-3 bg-gray-100 text-gray-800 rounded-xl hover:bg-opacity-90 transition-all duration-300 flex items-center gap-2 font-medium shadow-lg">
                                                                <i class="fas fa-times"></i>
                                                                <span>Cancel</span>
                                                            </button>
                                                            <button wire:click="saveChanges"
                                                                    class="status-badge px-6 py-3 bg-green-100 text-green-800 rounded-xl hover:bg-opacity-90 transition-all duration-300 flex items-center gap-2 font-medium shadow-lg">
                                                                <i class="fas fa-check"></i>
                                                                <span>Save Changes</span>
                                                            </button>
                                                        @else
                                                            <button wire:click="startEditing"
                                                                    class="status-badge px-6 py-3 bg-white text-gray-800 rounded-xl hover:bg-opacity-90 transition-all duration-300 flex items-center gap-2 font-medium shadow-lg">
                                                                <i class="fas fa-edit"></i>
                                                                <span>Edit Reminder</span>
                                                            </button>
                                                        @endif
                                                    @endcan
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                                        <!-- Main Content -->
                                        <div class="lg:col-span-2 space-y-6">
                                            <!-- Schedule Information -->
                                            <div class="glass-effect rounded-2xl p-6 card-hover">
                                                <div class="flex items-center gap-3 mb-6">
                                                    <div
                                                        class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                                                        <i class="fas fa-calendar-alt text-blue-600"></i>
                                                    </div>
                                                    <h2 class="text-xl font-semibold text-gray-800">{{ $reminderDetails['category'] }}
                                                        Details</h2>
                                                </div>

                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                    <div class="space-y-4">
                                                        <div class="p-4 bg-green-50 rounded-xl border border-green-200">
                                                            <p class="text-sm font-medium text-green-700 mb-1">Start
                                                                Time</p>
                                                            <div class="flex items-center gap-2">
                                                                <i class="fas fa-play-circle text-green-600"></i>
                                                                @if($isEditing)
                                                                    <input type="datetime-local"
                                                                           wire:model="editableFields.start_datetime"
                                                                           class="px-3 py-1 bg-white border border-gray-300 rounded-md focus:ring-green-500 focus:border-green-500">
                                                                @else
                                                                    <p class="text-green-800 font-semibold">{{ $reminderDetails['start_date']['date'] }}</p>
                                                                @endif
                                                            </div>
                                                            @if(!$isEditing)
                                                                <p class="text-green-700 text-sm">{{ $reminderDetails['start_date']['time'] }}</p>
                                                            @endif
                                                        </div>
                                                        <div class="p-4 bg-blue-50 rounded-xl border border-blue-200">
                                                            <p class="text-sm font-medium text-blue-700 mb-1">Period
                                                                Covered</p>
                                                            <div class="flex items-center gap-2">
                                                                <i class="fas fa-calendar-range text-blue-600"></i>
                                                                @if($isEditing)
                                                                    <label class="inline-flex items-center">
                                                                        <input type="checkbox"
                                                                               wire:model="editableFields.period"
                                                                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                                                        <span class="ml-2 text-blue-800 font-semibold">Enable Period</span>
                                                                    </label>
                                                                @else
                                                                    <p class="text-blue-800 font-semibold">
                                                                        {{ $reminderDetails['period'] ? 'June 2025 - July 2026' : 'No Period Covered' }}
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="space-y-4">
                                                        <div class="p-4 bg-red-50 rounded-xl border border-red-200">
                                                            <p class="text-sm font-medium text-red-700 mb-1">End
                                                                Time</p>
                                                            <div class="flex items-center gap-2">
                                                                <i class="fas fa-stop-circle text-red-600"></i>
                                                                @if($isEditing)
                                                                    <input type="datetime-local"
                                                                           wire:model="editableFields.end_datetime"
                                                                           class="px-3 py-1 bg-white border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500">
                                                                @else
                                                                    <p class="text-red-800 font-semibold">{{ $reminderDetails['end_date']['date'] }}</p>
                                                                @endif
                                                            </div>
                                                            @if(!$isEditing)
                                                                <p class="text-red-700 text-sm">{{ $reminderDetails['end_date']['time'] }}</p>
                                                            @endif
                                                        </div>

                                                        <div
                                                            class="p-4 bg-purple-50 rounded-xl border border-purple-200">
                                                            <p class="text-sm font-medium text-purple-700 mb-1">
                                                                Location</p>
                                                            <div class="flex items-center gap-2">
                                                                <i class="fas fa-map-marker-alt text-purple-600"></i>
                                                                @if($isEditing)
                                                                    <input type="text"
                                                                           wire:model="editableFields.location"
                                                                           class="w-full px-3 py-1 bg-white border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500">
                                                                @else
                                                                    <p class="text-purple-800 font-semibold">{{ $reminderDetails['location'] }}</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Description -->
                                            <div class="glass-effect rounded-2xl p-6 card-hover">
                                                <div class="flex items-center gap-3 mb-6">
                                                    <div
                                                        class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center">
                                                        <i class="fas fa-file-alt text-indigo-600"></i>
                                                    </div>
                                                    <h2 class="text-xl font-semibold text-gray-800">Message Details</h2>
                                                </div>

                                                <div class="prose prose-gray max-w-none">
                                                    <div
                                                        class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-xl border-l-4 border-blue-500 mb-4">
                                                        @if($isEditing)
                                                            <textarea wire:model="editableFields.description" rows="6"
                                                                      class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 font-mono text-gray-700 resize-vertical"
                                                                      style="white-space: pre-wrap; font-size: 0.95rem;"></textarea>
                                                        @else
                                                            <pre
                                                                class="w-full px-4 py-2 bg-white border border-gray-200 rounded-lg font-mono text-gray-700 overflow-x-auto"
                                                                style="white-space: pre-wrap; font-size: 0.95rem;">{{ $reminderDetails['description'] }}</pre>
                                                        @endif
                                                    </div>

                                                    <div
                                                        class="bg-gradient-to-r from-gray-50 to-blue-50 p-4 rounded-xl">
                                                        <div class="flex items-center gap-3">
                                                            <div
                                                                class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                                <i class="fas fa-heart text-blue-600 text-sm"></i>
                                                            </div>
                                                            <div>
                                                                <p class="font-semibold text-gray-800">Regards,</p>
                                                                <p class="text-gray-600">UAP Fort-Bonifacio Chapter</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Activity Log -->
                                            <div class="glass-effect rounded-2xl p-6 card-hover">
                                                <div class="flex items-center gap-3 mb-6">
                                                    <div
                                                        class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                                                        <i class="fas fa-history text-green-600"></i>
                                                    </div>
                                                    <h2 class="text-xl font-semibold text-gray-800">Activity
                                                        Timeline</h2>
                                                    <div class="ml-auto pulse-animation">
                                                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                                    </div>
                                                </div>

                                                <div class="space-y-4">
                                                    <div class="timeline-item">
                                                        <div class="timeline-dot"></div>
                                                        <div
                                                            class="bg-white p-4 rounded-xl border border-gray-200 hover:shadow-md transition-shadow">
                                                            <div class="flex items-center justify-between mb-2">
                                                                <span class="font-semibold text-gray-800">Email Notification Sent</span>
                                                                <span class="text-sm text-gray-500">May 28, 2025</span>
                                                            </div>
                                                            <p class="text-gray-600 text-sm">Sent by System
                                                                Administrator</p>
                                                        </div>
                                                    </div>

                                                    <div class="timeline-item">
                                                        <div class="timeline-dot bg-yellow-500"></div>
                                                        <div
                                                            class="bg-white p-4 rounded-xl border border-gray-200 hover:shadow-md transition-shadow">
                                                            <div class="flex items-center justify-between mb-2">
                                                                <span
                                                                    class="font-semibold text-gray-800">SMS Reminder</span>
                                                                <span class="text-sm text-gray-500">May 27, 2025</span>
                                                            </div>
                                                            <p class="text-gray-600 text-sm">Sent by John Doe</p>
                                                        </div>
                                                    </div>

                                                    <div class="timeline-item">
                                                        <div class="timeline-dot bg-purple-500"></div>
                                                        <div
                                                            class="bg-white p-4 rounded-xl border border-gray-200 hover:shadow-md transition-shadow">
                                                            <div class="flex items-center justify-between mb-2">
                                                                <span class="font-semibold text-gray-800">Reminder Created</span>
                                                                <span
                                                                    class="text-sm text-gray-500">{{ $reminderDetails['created_at'] }}</span>
                                                            </div>
                                                            <p class="text-gray-600 text-sm">Created by Admin User</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Sidebar -->
                                        <div class="space-y-6">
                                            @if(auth()->user()->hasRole('member') && $reminder->category->name == 'Deadline')
                                                @php
                                                    $existingRequest = \App\Models\ComputationRequest::where('member_id', auth()->id())
                                                                                        ->where('status', 'pending')
                                                                                        ->first();
                                                @endphp

                                                <div
                                                    class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 lg:p-8">
                                                    @if ($existingRequest)
                                                        <!-- Existing Request State -->
                                                        <div class="text-center py-8">
                                                            <div
                                                                class="mx-auto w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mb-4">
                                                                <svg class="w-8 h-8 text-amber-600" fill="none"
                                                                     stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                          stroke-linejoin="round"
                                                                          stroke-width="2"
                                                                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                                </svg>
                                                            </div>
                                                            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                                                Request Already Submitted</h3>
                                                            <p class="text-sm text-gray-600 mb-6 max-w-md mx-auto">
                                                                You already have a pending computation request.
                                                                Please wait for the administrator to process
                                                                your request.
                                                            </p>

                                                            <!-- Status Badge -->
                                                            <div
                                                                class="inline-flex items-center gap-2 px-4 py-2 bg-amber-50 border border-amber-200 rounded-full">
                                                                <div
                                                                    class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></div>
                                                                <span
                                                                    class="text-sm font-medium text-amber-800">Pending Review</span>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <!-- New Request State -->
                                                        <div class="text-center mb-8">
                                                            <div
                                                                class="mx-auto w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mb-4">
                                                                <svg class="w-8 h-8 text-indigo-600" fill="none"
                                                                     stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                          stroke-linejoin="round"
                                                                          stroke-width="2"
                                                                          d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                                </svg>
                                                            </div>
                                                            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                                                Request Computation Breakdown</h3>
                                                            <p class="text-sm text-gray-600 max-w-md mx-auto mb-6">
                                                                Submit a request to get a detailed breakdown of
                                                                your dues computation. This will help you
                                                                understand your payment obligations.
                                                            </p>
                                                        </div>

                                                        <!-- Action Buttons -->
                                                        <div class="space-y-4">
                                                            <!-- Primary Action Button -->
                                                            <button
                                                                wire:click="openComputationModal"
                                                                wire:loading.attr="disabled"
                                                                wire:loading.class="opacity-75 cursor-not-allowed"
                                                                class="group w-full relative overflow-hidden bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl shadow-lg hover:shadow-xl transform hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-indigo-200"
                                                            >
                                                                <div
                                                                    class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                                                                <div
                                                                    class="relative px-6 py-4 flex items-center justify-center gap-3">
                        <span wire:loading.remove wire:target="openComputationModal" class="flex items-center gap-3">
                            <svg class="w-5 h-5 transform group-hover:rotate-12 transition-transform duration-300"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 5h6m-3 0v14m-4-7h8m-8 4h8"/>
                            </svg>
                            <span class="text-base font-semibold">Request Computation Breakdown</span>
                        </span>
                                                                    <span wire:loading
                                                                          wire:target="openComputationModal"
                                                                          class="flex items-center gap-3">
                            <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 12a8 8 0 0116 0 8 8 0 01-16 0z"/>
                            </svg>
                            <span class="text-base font-semibold">Processing Request...</span>
                        </span>
                                                                </div>
                                                            </button>

                                                            <!-- Secondary Action Button -->
                                                            {{--                                                            <button--}}
                                                            {{--                                                                wire:click="openViewModal"--}}
                                                            {{--                                                                wire:loading.attr="disabled"--}}
                                                            {{--                                                                wire:loading.class="opacity-75 cursor-not-allowed"--}}
                                                            {{--                                                                class="group w-full bg-white border-2 border-gray-200 text-gray-700 rounded-xl shadow-sm hover:shadow-md hover:border-indigo-300 hover:text-indigo-700 transform hover:scale-[1.01] active:scale-[0.99] transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-gray-200"--}}
                                                            {{--                                                            >--}}
                                                            {{--                                                                <div--}}
                                                            {{--                                                                    class="px-6 py-3 flex items-center justify-center gap-3">--}}
                                                            {{--                                                                    <span wire:loading.remove--}}
                                                            {{--                                                                          wire:target="openViewModal"--}}
                                                            {{--                                                                          class="flex items-center gap-3">--}}
                                                            {{--                                                                        <svg--}}
                                                            {{--                                                                            class="w-5 h-5 transform group-hover:scale-110 transition-transform duration-300"--}}
                                                            {{--                                                                            fill="none" stroke="currentColor"--}}
                                                            {{--                                                                            viewBox="0 0 24 24">--}}
                                                            {{--                                                                            <path stroke-linecap="round"--}}
                                                            {{--                                                                                  stroke-linejoin="round"--}}
                                                            {{--                                                                                  stroke-width="2"--}}
                                                            {{--                                                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>--}}
                                                            {{--                                                                            <path stroke-linecap="round"--}}
                                                            {{--                                                                                  stroke-linejoin="round"--}}
                                                            {{--                                                                                  stroke-width="2"--}}
                                                            {{--                                                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>--}}
                                                            {{--                                                                        </svg>--}}
                                                            {{--                                                                        <span class="text-sm font-medium">View Existing Requests</span>--}}
                                                            {{--                                                                    </span>--}}
                                                            {{--                                                                    <span wire:loading--}}
                                                            {{--                                                                          wire:target="openViewModal"--}}
                                                            {{--                                                                          class="flex items-center gap-3">--}}
                                                            {{--                                                                        <svg class="w-5 h-5 animate-spin" fill="none"--}}
                                                            {{--                                                                             stroke="currentColor" viewBox="0 0 24 24">--}}
                                                            {{--                                                                            <path stroke-linecap="round"--}}
                                                            {{--                                                                                  stroke-linejoin="round"--}}
                                                            {{--                                                                                  stroke-width="2"--}}
                                                            {{--                                                                                  d="M4 12a8 8 0 0116 0 8 8 0 01-16 0z"/>--}}
                                                            {{--                                                                        </svg>--}}
                                                            {{--                                                                        <span--}}
                                                            {{--                                                                            class="text-sm font-medium">Loading...</span>--}}
                                                            {{--                                                                    </span>--}}
                                                            {{--                                                                </div>--}}
                                                            {{--                                                            </button>--}}
                                                        </div>

                                                        <!-- Help Text -->
                                                        <div
                                                            class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                                            <div class="flex items-start gap-3">
                                                                <svg
                                                                    class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5"
                                                                    fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                          stroke-linejoin="round"
                                                                          stroke-width="2"
                                                                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                                </svg>
                                                                <div class="text-sm text-blue-800">
                                                                    <p class="font-medium mb-1">What happens
                                                                        next?</p>
                                                                    <ul class="space-y-1 text-blue-700">
                                                                        <li>• Your request will be reviewed by
                                                                            an administrator
                                                                        </li>
                                                                        <li>• You'll receive a detailed
                                                                            computation breakdown
                                                                        </li>
                                                                        <li>• Processing typically takes 1-2
                                                                            business days
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            @else
                                                <!-- Unauthorized State -->
                                                <div
                                                    class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                                                    <div class="text-center py-8">
                                                        <div
                                                            class="mx-auto w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-4">
                                                            <svg class="w-8 h-8 text-red-600" fill="none"
                                                                 stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round"
                                                                      stroke-linejoin="round" stroke-width="2"
                                                                      d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                                            </svg>
                                                        </div>
                                                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                                            Access Restricted</h3>
                                                        <p class="text-sm text-gray-600 max-w-md mx-auto">
                                                            You are not authorized to request a computation
                                                            breakdown. This feature is only available for active
                                                            members with deadline reminders.
                                                        </p>

                                                        <!-- Contact Support -->
                                                        <div
                                                            class="mt-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                                            <div
                                                                class="flex items-center justify-center gap-2 text-sm text-gray-600">
                                                                <svg class="w-4 h-4" fill="none"
                                                                     stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                          stroke-linejoin="round"
                                                                          stroke-width="2"
                                                                          d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                                </svg>
                                                                <span>Need help? Contact support for assistance.</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <!-- Attachments Section -->
                                            <div class="glass-effect rounded-2xl p-6 card-hover">
                                                <div class="flex items-center justify-between mb-6">
                                                    <div class="flex items-center gap-3">
                                                        <div
                                                            class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                                                            <i class="fas fa-paperclip text-purple-600"></i>
                                                        </div>
                                                        <h3 class="text-lg font-semibold text-gray-800">Attachments</h3>
                                                    </div>

                                                    @if($isEditing)
                                                        <button wire:click="toggleFileUpload"
                                                                class="flex items-center gap-2 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                                                            <i class="fas fa-plus"></i>
                                                            <span>{{ $showFileUpload ? 'Cancel Upload' : 'Add Files' }}</span>
                                                        </button>
                                                    @endif
                                                </div>

                                                <!-- File Upload Section (Visible during editing) -->
                                                @if($isEditing && $showFileUpload)
                                                    <div class="mb-6" x-data="{ isUploading: false, progress: 0 }"
                                                         x-on:livewire-upload-start="isUploading = true"
                                                         x-on:livewire-upload-finish="isUploading = false"
                                                         x-on:livewire-upload-error="isUploading = false"
                                                         x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                        <div class="flex items-center gap-3 mb-3">
                                                            <input type="file" wire:model="uploadedFiles" multiple
                                                                   class="block w-full text-sm text-gray-500
                          file:mr-4 file:py-2 file:px-4
                          file:rounded-lg file:border-0
                          file:text-sm file:font-semibold
                          file:bg-purple-50 file:text-purple-700
                          hover:file:bg-purple-100">
                                                        </div>

                                                        <!-- Upload Progress -->
                                                        <div x-show="isUploading" class="mt-2">
                                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                                <div class="bg-purple-600 h-2.5 rounded-full"
                                                                     :style="`width: ${progress}%`"></div>
                                                            </div>
                                                            <p class="text-xs text-gray-500 mt-1"
                                                               x-text="`Uploading: ${progress}%`"></p>
                                                        </div>

                                                        <!-- Upload Button -->
                                                        <div class="flex justify-end mt-3">
                                                            <button wire:click="saveFiles"
                                                                    wire:loading.attr="disabled"
                                                                    class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors"
                                                                    :disabled="!uploadedFiles.length">
                                                                <span wire:loading.remove>Upload Files</span>
                                                                <span wire:loading>
                    <i class="fas fa-spinner fa-spin mr-1"></i> Uploading...
                </span>
                                                            </button>
                                                        </div>

                                                        <!-- Validation Error -->
                                                        @error('uploadedFiles.*')
                                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                @endif

                                                <!-- Attachments List -->
                                                @if(empty($reminderDetails['attachments']))
                                                    <div
                                                        class="flex flex-col items-center justify-center p-6 bg-gray-50 rounded-xl border border-gray-200 text-center">
                                                        <i class="fas fa-paperclip text-gray-400 text-3xl mb-3"></i>
                                                        <p class="text-gray-600 font-medium mb-1">No Attachments
                                                            Available</p>
                                                        <p class="text-sm text-gray-500">There are no files attached to
                                                            this reminder.</p>
                                                    </div>
                                                @else
                                                    <div class="space-y-3">
                                                        @foreach($reminderDetails['attachments'] as $attachment)
                                                            @php
                                                                $colorClasses = [
                                                                    'red' => 'from-red-50 to-pink-50 hover:from-red-100 hover:to-pink-100 border-red-200 text-red-600',
                                                                    'green' => 'from-green-50 to-emerald-50 hover:from-green-100 hover:to-emerald-100 border-green-200 text-green-600',
                                                                    'blue' => 'from-blue-50 to-cyan-50 hover:from-blue-100 hover:to-cyan-100 border-blue-200 text-blue-600',
                                                                    'purple' => 'from-purple-50 to-violet-50 hover:from-purple-100 hover:to-violet-100 border-purple-200 text-purple-600',
                                                                    'default' => 'from-gray-50 to-gray-100 hover:from-gray-100 hover:to-gray-200 border-gray-200 text-gray-600'
                                                                ];
                                                                $colorClass = $colorClasses[$attachment['color']] ?? $colorClasses['default'];
                                                            @endphp

                                                            <div
                                                                class="group flex items-center p-4 bg-gradient-to-r {{ $colorClass }} rounded-xl transition-all duration-300 cursor-pointer border">
                                                                <div
                                                                    class="w-10 h-10 bg-{{ $attachment['color'] }}-100 rounded-lg flex items-center justify-center mr-3">
                                                                    <i class="fas {{ $attachment['icon'] }} text-{{ $attachment['color'] }}-600"></i>
                                                                </div>
                                                                <div class="flex-1">
                                                                    <p class="font-medium text-gray-800 group-hover:text-{{ $attachment['color'] }}-700">{{ $attachment['name'] }}</p>
                                                                    <p class="text-sm text-gray-500">{{ $attachment['size'] }}</p>
                                                                </div>
                                                                <div class="flex gap-2">
                                                                    <a href="{{ Storage::url($attachment['path']) }}"
                                                                       target="_blank"
                                                                       class="opacity-70 hover:opacity-100 transition-opacity p-2 hover:bg-white hover:bg-opacity-50 rounded-lg"
                                                                       download="{{ $attachment['name'] }}">
                                                                        <i class="fas fa-download text-{{ $attachment['color'] }}-600"></i>
                                                                    </a>
                                                                    @if($isEditing)
                                                                        <button
                                                                            wire:click="confirmRemoveAttachment({{ $attachment['id'] }})"
                                                                            class="opacity-70 hover:opacity-100 transition-opacity p-2 hover:bg-white hover:bg-opacity-50 rounded-lg text-red-600">
                                                                            <i class="fas fa-trash-alt"></i>
                                                                        </button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    @if(count($reminderDetails['attachments']) > 1)
                                                        <div class="mt-4 pt-4 border-t border-gray-200">
                                                            <button
                                                                class="w-full py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 font-medium flex items-center justify-center gap-2">
                                                                <i class="fas fa-download"></i>
                                                                Download All
                                                            </button>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>

                                            <!-- Delete Confirmation Modal -->
                                            @if($removingAttachmentId)
                                                <div
                                                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
                                                    <div class="bg-white rounded-xl p-6 max-w-md w-full">
                                                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Confirm
                                                            Deletion</h3>
                                                        <p class="text-gray-600 mb-6">Are you sure you want to delete
                                                            this file? This action cannot be undone.</p>
                                                        <div class="flex justify-end gap-3">
                                                            <button wire:click="cancelRemoveAttachment"
                                                                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">
                                                                Cancel
                                                            </button>
                                                            <button wire:click="removeAttachment"
                                                                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                                                                Delete File
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            {{-- Empty State for Reminder Details --}}
                            <div class="text-center py-12">
                                <div
                                    class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-bell text-gray-400 text-3xl"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">No reminder details available</h3>
                                <p class="text-gray-500 mb-6 max-w-sm mx-auto">Create a new reminder to see details
                                    here.</p>
                                <button wire:click="setMainTab('manage')"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg flex items-center space-x-2 mx-auto transition-colors duration-200">
                                    <i class="fas fa-plus"></i>
                                    <span>Create Reminder</span>
                                </button>
                            </div>
                        @endif
                    @endif
                @endif

                {{-- List Tab --}}
                @if($activeMainTab === 'list')
                    <div class="text-center py-12">
                        <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-list text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No reminders found</h3>
                        <p class="text-gray-500 mb-6 max-w-sm mx-auto">Create your first reminder to get started with
                            member notifications.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Add Member Modal -->
    @if($showAddMemberModal)
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center p-4 z-50"
             x-data="{ show: @entangle('showAddMemberModal') }"
             x-show="show"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">

            <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-hidden"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 @click.away="$wire.closeAddMemberModal()">

                <!-- Modal Header -->
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">
                            <i class="fas fa-user-plus mr-2 text-blue-600"></i>
                            Add Members to Reminder
                        </h3>
                        <button wire:click="closeAddMemberModal"
                                class="text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="px-6 py-4 max-h-[70vh] overflow-y-auto">
                    <!-- Search Input -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Search Members
                        </label>
                        <div class="relative">
                            <input type="text"
                                   wire:model.live.debounce.300ms="searchTerm"
                                   placeholder="Search by name, email, or PRC number..."
                                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Available Users List -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between text-sm text-gray-600 mb-3">
                            <span>Available Members ({{ $availableUsers->count() }})</span>
                            @if(count($selectedUsers) > 0)
                                <span class="text-blue-600 font-medium">
                            {{ count($selectedUsers) }} selected
                        </span>
                            @endif
                        </div>

                        @if($availableUsers->count() > 0)
                            <div class="border border-gray-200 rounded-lg divide-y divide-gray-200 max-h-80 overflow-y-auto">
                                @foreach($availableUsers as $user)
                                    <div class="p-3 hover:bg-gray-50 transition-colors">
                                        <label class="flex items-start space-x-3 cursor-pointer">
                                            <input type="checkbox"
                                                   wire:click="toggleUserSelection({{ $user['id'] }})"
                                                   {{ in_array($user['id'], $selectedUsers) ? 'checked' : '' }}
                                                   class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">

                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center justify-between">
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-900">
                                                            {{ $user['name'] }}
                                                        </p>
                                                        <p class="text-sm text-gray-600">
                                                            {{ $user['email'] }}
                                                        </p>
                                                        @if($user['prc_no'] !== 'N/A')
                                                            <p class="text-xs text-gray-500">
                                                                PRC: {{ $user['prc_no'] }}
                                                            </p>
                                                        @endif
                                                    </div>

                                                    @if(in_array($user['id'], $selectedUsers))
                                                        <div class="flex-shrink-0">
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        <i class="fas fa-check mr-1"></i>
                                                        Selected
                                                    </span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 text-gray-500">
                                <i class="fas fa-users text-4xl mb-4"></i>
                                <p class="text-lg font-medium">No members found</p>
                                <p class="text-sm">
                                    @if(empty($searchTerm))
                                        All eligible members are already added to this reminder.
                                    @else
                                        Try adjusting your search terms.
                                    @endif
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
                        <div class="text-sm text-gray-600">
                            @if(count($selectedUsers) > 0)
                                {{ count($selectedUsers) }} member(s) selected
                            @else
                                No members selected
                            @endif
                        </div>

                        <div class="flex space-x-3">
                            <button wire:click="closeAddMemberModal"
                                    type="button"
                                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 font-medium transition-colors">
                                Cancel
                            </button>

                            <button wire:click="addMember"
                                    type="button"
                                    @if(count($selectedUsers) === 0) disabled @endif
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:bg-gray-300 disabled:cursor-not-allowed font-medium transition-colors">
                                <i class="fas fa-plus mr-2"></i>
                                Add Selected Members
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
