<div>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <style>
            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .notification-panel {
                backdrop-filter: blur(8px);
            }

            .priority-high {
                animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }

            @keyframes pulse {
                0%, 100% {
                    opacity: 1;
                }
                50% {
                    opacity: .5;
                }
            }

            .notification-item:hover {
                transform: translateX(2px);
                transition: transform 0.2s ease-in-out;
            }

            /* Custom scrollbar */
            .notification-scroll::-webkit-scrollbar {
                width: 6px;
            }

            .notification-scroll::-webkit-scrollbar-track {
                background: #f1f5f9;
                border-radius: 3px;
            }

            .notification-scroll::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border-radius: 3px;
            }

            .notification-scroll::-webkit-scrollbar-thumb:hover {
                background: #94a3b8;
            }
        </style>

        <div class="max-w-12xl mx-auto">
            <!-- Page header -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Notifications</h1>
                <p class="mt-1 text-sm text-gray-500">Manage your payment reminders and system notifications</p>
            </div>

            <!-- Notification controls -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
                <div class="p-4 border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div class="mb-4 sm:mb-0">
                            <h2 class="text-lg font-medium text-gray-900">
                                <span x-text="notifications.total"></span> Notifications
                            </h2>
                        </div>

                        <div class="flex items-center space-x-3">
                            <!-- Filter dropdown -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open"
                                        class="inline-flex w-full items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <span
                                        x-text="filter === 'all' ? 'All Notifications' : filter === 'unread' ? 'Unread Only' : 'Read Only'"></span>
                                    <svg class="-mr-1 ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    All Notifications
                                </button>

                                <div x-show="open" @click.away="open = false"
                                     class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10"
                                     x-transition>
                                    <div class="py-1">
                                        <button wire:click="$set('filter', 'all')" type="button"
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                                            All Notifications
                                        </button>
                                        <button wire:click="$set('filter', 'unread')" type="button"
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                                            Unread Only
                                        </button>
                                        <button wire:click="$set('filter', 'read')" type="button"
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                                            Read Only
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Action buttons -->
                            <div class="flex space-x-2">
                                <button wire:click="markAllAsRead"
                                        wire:loading.attr="disabled"
                                        wire:target="markAllAsRead"
                                        x-show="unreadCount > 0"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <span wire:loading.remove wire:target="markAllAsRead">Mark All Read</span>
                                    <span wire:loading wire:target="markAllAsRead">
                                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                    stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Loading...
                                    </span>
                                </button>
                                <button wire:click="clearAll"
                                        wire:loading.attr="disabled"
                                        wire:target="clearAll"
                                        x-show="notifications.total > 0"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    <span wire:loading.remove wire:target="clearAll">Clear All</span>
                                    <span wire:loading wire:target="clearAll">
                                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                    stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Loading...
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notification list -->
                <div class="divide-y divide-gray-200 notification-scroll"
                     style="max-height: calc(100vh - 250px); overflow-y: auto;">
                    @forelse($notifications as $notification)
                        @php
                            $notificationStyles = [
                                'reminder' => ['icon' => '🔔', 'color' => 'blue', 'bgColor' => 'bg-blue-50 border-l-blue-400'],
                                'urgent' => ['icon' => '⚠️', 'color' => 'red', 'bgColor' => 'bg-red-50 border-l-red-400'],
                                'info' => ['icon' => 'ℹ️', 'color' => 'cyan', 'bgColor' => 'bg-cyan-50 border-l-cyan-400'],
                                'success' => ['icon' => '✅', 'color' => 'green', 'bgColor' => 'bg-green-50 border-l-green-400'],
                                'warning' => ['icon' => '⚡', 'color' => 'yellow', 'bgColor' => 'bg-yellow-50 border-l-yellow-400'],
                                'default' => ['icon' => '📢', 'color' => 'gray', 'bgColor' => 'bg-gray-50 border-l-gray-400'],
                            ];

                            $type = $notification->data['type'] ?? 'default';
                            $style = $notificationStyles[$type] ?? $notificationStyles['default'];
                            $priority = $notification->data['priority'] ?? 'normal';
                        @endphp

                        <div wire:key="notification-{{ $notification->id }}"
                             class="p-4 hover:bg-gray-50 transition-colors duration-150 border-l-4 {{ $style['bgColor'] }} {{ !$notification->read_at ? 'bg-blue-50' : 'bg-white' }}"
                             x-data="{ expanded: false }">
                            <div class="flex items-start space-x-3">
                                <!-- Notification icon -->
                                <div
                                    class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center text-sm {{ 'bg-'.$style['color'].'-100' }}">
                                    {{ $style['icon'] }}
                                </div>

                                <!-- Content -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-start">
                                        <div class="font-medium text-sm text-gray-900 line-clamp-2">
                                            {{ $notification->data['title'] ?? $notification->data['message'] ?? 'Notification' }}
                                        </div>
                                        <div class="flex flex-col items-end ml-2">
                                        <span class="text-xs text-gray-500">
                                            @if($notification->created_at->diffInHours() < 1)
                                                {{ $notification->created_at->diffInMinutes() <= 1 ? 'Just now' : $notification->created_at->diffInMinutes().'m ago' }}
                                            @elseif($notification->created_at->diffInHours() < 24)
                                                {{ $notification->created_at->diffInHours().'h ago' }}
                                            @else
                                                {{ $notification->created_at->format('M d') }}
                                            @endif
                                        </span>
                                            @if($priority === 'high')
                                                <span
                                                    class="text-xs bg-red-100 text-red-800 px-1.5 py-0.5 rounded-full mt-1">
                                                High
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="text-sm text-gray-600 mt-1 line-clamp-2" x-show="!expanded">
                                        {{ $notification->data['message'] ?? '' }}
                                    </div>

                                    <!-- Expanded content -->
                                    <div class="text-sm text-gray-600 mt-1" x-show="expanded" x-cloak>
                                        {!! nl2br(e($notification->data['message'] ?? '')) !!}
                                    </div>

                                    <!-- Additional data -->
                                    @if(isset($notification->data['reminder']) || isset($notification->data['location']) || isset($notification->data['category']))
                                        <div class="mt-2 flex flex-wrap gap-2">
                                            @if(isset($notification->data['category']))
                                                <span
                                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $notification->data['category'] }}
                                            </span>
                                            @endif
                                            @if(isset($notification->data['location']))
                                                <span
                                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                📍 {{ $notification->data['location'] }}
                                            </span>
                                            @endif
                                        </div>
                                    @endif

                                    <!-- Read status and actions -->
                                    <div class="flex items-center justify-between mt-3">
                                        <div class="flex items-center space-x-3">
                                            <button @click="expanded = !expanded"
                                                    class="text-xs text-blue-600 hover:text-blue-800">
                                                <span x-text="expanded ? 'Show less' : 'Show more'"></span>
                                            </button>

                                            @if(!$notification->read_at)
                                                <button wire:click="markAsRead('{{ $notification->id }}')"
                                                        class="text-xs text-gray-600 hover:text-gray-800">
                                                    Mark as read
                                                </button>
                                            @endif
                                        </div>

                                        <div class="flex items-center space-x-2">
                                        <span class="text-xs text-gray-400">
                                            {{ $notification->created_at->format('M d, Y h:i A') }}
                                        </span>
                                            @if(!$notification->read_at)
                                                <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                            @endif
                                            <button wire:click="deleteNotification('{{ $notification->id }}')"
                                                    class="text-xs text-red-600 hover:text-red-800">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center">
                            <div class="w-16 h-16 mx-auto mb-4 text-gray-400">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                          d="M15 17h5l-5-5V9a4 4 0 00-8 0v3l-5 5h5"></path>
                                </svg>
                            </div>
                            <p class="text-gray-500 text-sm">
                                @if($filter === 'all')
                                    No notifications yet
                                @elseif($filter === 'unread')
                                    No unread notifications
                                @else
                                    No read notifications
                                @endif
                            </p>
                        </div>
                    @endforelse
                </div>

                <!-- Load more button -->
                @if($notifications->hasMorePages())
                    <div class="p-4 border-t border-gray-200 text-center">
                        <button wire:click="loadMore" wire:loading.attr="disabled"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <span wire:loading.remove>Load More</span>
                            <span wire:loading>
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Loading...
                        </span>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function () {
                @if(config('broadcasting.default'))
                window.Echo.private(`user.{{ auth()->id() }}`)
                    .listen('.notification.created', (data) => {
                        Livewire.dispatch('refreshNotifications');
                    })
                    .listen('.notification.updated', (data) => {
                        Livewire.dispatch('refreshNotifications');
                    });
                @endif
            });
        </script>
    @endpush
</div>
