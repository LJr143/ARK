<div x-data="{ open: false }" class="bg-white border-gray-100">
    <style>
        /* Custom styles for enhanced notifications */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Smooth animations for notification panel */
        .notification-panel {
            backdrop-filter: blur(8px);
        }

        /* Custom scrollbar for notification list */
        .max-h-96::-webkit-scrollbar {
            width: 6px;
        }

        .max-h-96::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }

        .max-h-96::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        .max-h-96::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Notification priority indicators */
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

        /* Enhanced hover effects */
        .notification-item:hover {
            transform: translateX(2px);
            transition: transform 0.2s ease-in-out;
        }

        /* Loading spinner enhancement */
        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        /* Toast notification styles */
        .toast-enter {
            transform: translateX(100%);
            opacity: 0;
        }

        .toast-enter-active {
            transform: translateX(0);
            opacity: 1;
            transition: all 0.3s ease-out;
        }

        .toast-exit {
            transform: translateX(0);
            opacity: 1;
        }

        .toast-exit-active {
            transform: translateX(100%);
            opacity: 0;
            transition: all 0.3s ease-in;
        }
    </style>
    <div class="w-full mx-auto px-2 sm:px-4 lg:px-6">
        <div class="flex justify-between h-8">
            <div>
                <h2 class="font-semibold text-[18px] text-gray-800 leading-tight">
                    Welcome, <?php echo e(Auth::user()->first_name); ?>

                </h2>
                <p class="text-sm text-gray-500">
                    <?php echo e(\Carbon\Carbon::now()->format('F d, Y ; h:i A')); ?>

                </p>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Enhanced Notifications Dropdown -->
                <div class="relative ms-3">
                    <div x-data="{
                        open: false,
                        notifications: [],
                        unreadCount: 0,
                        loading: false,
                        filter: 'all', // all, unread, read
                        isOnline: navigator.onLine,
                        lastFetch: null,
                        autoRefreshInterval: null,

                        // Notification categories with icons and colors
                        getNotificationStyle(type) {
                            const styles = {
                                'reminder': { icon: '🔔', color: 'blue', bgColor: 'bg-blue-50 border-l-blue-400' },
                                'urgent': { icon: '⚠️', color: 'red', bgColor: 'bg-red-50 border-l-red-400' },
                                'info': { icon: 'ℹ️', color: 'cyan', bgColor: 'bg-cyan-50 border-l-cyan-400' },
                                'success': { icon: '✅', color: 'green', bgColor: 'bg-green-50 border-l-green-400' },
                                'warning': { icon: '⚡', color: 'yellow', bgColor: 'bg-yellow-50 border-l-yellow-400' },
                                'default': { icon: '📢', color: 'gray', bgColor: 'bg-gray-50 border-l-gray-400' }
                            };
                            return styles[type] || styles.default;
                        },

                        async fetchNotifications() {
                            if (this.loading) return;

                            this.loading = true;
                            try {
                                const response = await fetch('<?php echo e(route("notifications.index")); ?>', {
                                    method: 'GET',
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'Content-Type': 'application/json'
                                    }
                                });

                                if (!response.ok) throw new Error('Failed to fetch notifications');

                                const data = await response.json();
                                this.notifications = data.map(notification => ({
                                    ...notification,
                                    type: notification.data?.type || 'default',
                                    priority: notification.data?.priority || 'normal'
                                }));
                                this.updateUnreadCount();
                                this.lastFetch = new Date();
                            } catch (error) {
                                console.error('Error fetching notifications:', error);
                                this.showToast('Failed to load notifications', 'error');
                            } finally {
                                this.loading = false;
                            }
                        },

                        async markAsRead(id) {
                            try {
                                const response = await fetch('<?php echo e(route("notifications.mark-as-read", ["id" => ":id"])); ?>'.replace(':id', id), {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                                        'Content-Type': 'application/json',
                                        'X-Requested-With': 'XMLHttpRequest'
                                    }
                                });

                                if (!response.ok) throw new Error('Failed to mark as read');

                                // Update local state immediately for better UX
                                const notification = this.notifications.find(n => n.id === id);
                                if (notification && !notification.read_at) {
                                    notification.read_at = new Date().toISOString();
                                    this.updateUnreadCount();
                                }
                            } catch (error) {
                                console.error('Error marking notification as read:', error);
                                this.showToast('Failed to mark as read', 'error');
                            }
                        },

                        async markAllAsRead() {
                            try {
                                const response = await fetch('<?php echo e(route("notifications.mark-all-read")); ?>', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                                        'Content-Type': 'application/json',
                                        'X-Requested-With': 'XMLHttpRequest'
                                    }
                                });

                                if (!response.ok) throw new Error('Failed to mark all as read');

                                // Update local state
                                this.notifications.forEach(n => {
                                    if (!n.read_at) n.read_at = new Date().toISOString();
                                });
                                this.updateUnreadCount();
                                this.showToast('All notifications marked as read', 'success');
                            } catch (error) {
                                console.error('Error marking all as read:', error);
                                this.showToast('Failed to mark all as read', 'error');
                            }
                        },

                        async clearAll() {
                            if (!confirm('Are you sure you want to clear all notifications? This cannot be undone.')) return;

                            try {
                                const response = await fetch('<?php echo e(route("notifications.clear")); ?>', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                                        'Content-Type': 'application/json',
                                        'X-Requested-With': 'XMLHttpRequest'
                                    }
                                });

                                if (!response.ok) throw new Error('Failed to clear notifications');

                                this.notifications = [];
                                this.unreadCount = 0;
                                this.showToast('All notifications cleared', 'success');
                            } catch (error) {
                                console.error('Error clearing notifications:', error);
                                this.showToast('Failed to clear notifications', 'error');
                            }
                        },

                        updateUnreadCount() {
                            this.unreadCount = this.notifications.filter(n => !n.read_at).length;
                        },

                        get filteredNotifications() {
                            let filtered = this.notifications;

                            if (this.filter === 'unread') {
                                filtered = filtered.filter(n => !n.read_at);
                            } else if (this.filter === 'read') {
                                filtered = filtered.filter(n => n.read_at);
                            }

                            // Sort by priority and date
                            return filtered.sort((a, b) => {
                                const priorityOrder = { 'high': 3, 'normal': 2, 'low': 1 };
                                const aPriority = priorityOrder[a.priority] || 2;
                                const bPriority = priorityOrder[b.priority] || 2;

                                if (aPriority !== bPriority) return bPriority - aPriority;
                                return new Date(b.created_at) - new Date(a.created_at);
                            });
                        },

                        formatTime(time) {
                            const date = new Date(time);
                            const now = new Date();
                            const diffInHours = (now - date) / (1000 * 60 * 60);

                            if (diffInHours < 1) {
                                const minutes = Math.floor((now - date) / (1000 * 60));
                                return minutes <= 1 ? 'Just now' : `${minutes}m ago`;
                            } else if (diffInHours < 24) {
                                return `${Math.floor(diffInHours)}h ago`;
                            } else {
                                return date.toLocaleDateString([], { month: 'short', day: 'numeric' });
                            }
                        },

                        formatFullDate(time) {
                            return new Date(time).toLocaleString([], {
                                month: 'short',
                                day: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit'
                            });
                        },

                        playNotificationSound() {
                            try {
                                const context = new (window.AudioContext || window.webkitAudioContext)();
                                const oscillator = context.createOscillator();
                                const gainNode = context.createGain();

                                oscillator.connect(gainNode);
                                gainNode.connect(context.destination);

                                oscillator.frequency.value = 800;
                                oscillator.type = 'sine';
                                gainNode.gain.setValueAtTime(0.3, context.currentTime);
                                gainNode.gain.exponentialRampToValueAtTime(0.01, context.currentTime + 1);

                                oscillator.start(context.currentTime);
                                oscillator.stop(context.currentTime + 1);
                            } catch (e) {
                                console.log('Audio notification failed:', e);
                            }
                        },

                        showToast(message, type = 'info') {
                            // Create toast notification (you can integrate with your existing toast system)
                            const toast = document.createElement('div');
                            toast.className = `fixed top-4 right-4 px-4 py-2 rounded-lg shadow-lg z-50 ${
                                type === 'error' ? 'bg-red-500 text-white' :
                                type === 'success' ? 'bg-green-500 text-white' :
                                'bg-blue-500 text-white'
                            }`;
                            toast.textContent = message;
                            document.body.appendChild(toast);

                            setTimeout(() => {
                                toast.remove();
                            }, 3000);
                        },

                        setupAutoRefresh() {
                            // Refresh every 30 seconds when tab is active
                            this.autoRefreshInterval = setInterval(() => {
                                if (!document.hidden && this.isOnline) {
                                    this.fetchNotifications();
                                }
                            }, 30000);
                        },

                        init() {
                            this.fetchNotifications();
                            this.setupAutoRefresh();

                            // Setup WebSocket listener for real-time updates
                            if (window.Echo) {
                                window.Echo.private(`user.<?php echo e(Auth::id()); ?>`)
                                    .listen('.notification.created', (data) => {
                                        this.notifications.unshift({
                                            ...data.notification,
                                            type: data.notification.data?.type || 'default',
                                            priority: data.notification.data?.priority || 'normal'
                                        });
                                        this.updateUnreadCount();
                                        this.playNotificationSound();

                                        // Show browser notification if permitted
                                        if (Notification.permission === 'granted') {
                                            new Notification(data.notification.title || 'New Notification', {
                                                body: data.notification.message,
                                                icon: '/favicon.ico'
                                            });
                                        }
                                    })
                                    .listen('.notification.updated', (data) => {
                                        const index = this.notifications.findIndex(n => n.id === data.notification.id);
                                        if (index !== -1) {
                                            this.notifications[index] = {
                                                ...data.notification,
                                                type: data.notification.data?.type || 'default',
                                                priority: data.notification.data?.priority || 'normal'
                                            };
                                            this.updateUnreadCount();
                                        }
                                    });
                            }

                            // Handle online/offline status
                            window.addEventListener('online', () => {
                                this.isOnline = true;
                                this.fetchNotifications();
                            });

                            window.addEventListener('offline', () => {
                                this.isOnline = false;
                            });

                            // Request notification permission
                            if ('Notification' in window && Notification.permission === 'default') {
                                Notification.requestPermission();
                            }

                            // Cleanup on page unload
                            window.addEventListener('beforeunload', () => {
                                if (this.autoRefreshInterval) {
                                    clearInterval(this.autoRefreshInterval);
                                }
                            });
                        }
                    }" x-init="init()" class="relative">

                        <!-- Notification Bell Button -->
                        <button @click="open = !open; if(open && (!lastFetch || Date.now() - lastFetch > 10000)) fetchNotifications()"
                                class="relative p-2 text-gray-600 hover:text-gray-900 transition-colors duration-200 rounded-full hover:bg-gray-100">
                            <div class="relative">
                                <svg class="w-6 h-6 transition-transform duration-200"
                                     :class="{ 'animate-ring': loading }"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24"
                                     role="img"
                                     aria-label="Notification bell">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="1.5"
                                          d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>

                                <!-- Unread count badge -->
                                <span x-show="unreadCount > 0" x-transition
                                      class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-medium shadow-lg"
                                      x-text="unreadCount > 99 ? '99+' : unreadCount"></span>

                                <!-- Online status indicator -->
                                <span class="absolute -bottom-1 -right-1 w-3 h-3 rounded-full border-2 border-white"
                                      :class="isOnline ? 'bg-green-400' : 'bg-red-400'"></span>
                            </div>
                        </button>

                        <!-- Enhanced Notification Panel -->
                        <div x-cloak x-show="open" @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95 translate-y-2"
                             x-transition:enter-end="transform opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="transform opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="transform opacity-0 scale-95 translate-y-2"
                             class=" absolute right-0 mt-2 w-96 bg-white rounded-xl shadow-2xl border border-gray-200 z-50 overflow-hidden ">

                            <!-- Header -->
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-4 border-b border-gray-200">
                                <div class="flex justify-between items-center mb-3">
                                    <div>
                                        <h3 class="font-semibold text-gray-900 text-lg">Notifications</h3>
                                        <p class="text-sm text-gray-600" x-show="lastFetch">
                                            Last updated: <span x-text="formatTime(lastFetch)"></span>
                                        </p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button @click="fetchNotifications()"
                                                :disabled="loading"
                                                class="p-1.5 text-gray-500 hover:text-gray-700 hover:bg-white rounded-lg transition-colors"
                                                :class="{ 'animate-spin': loading }">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Filter tabs -->
                                <div class="flex space-x-1 bg-white rounded-lg p-1">
                                    <button @click="filter = 'all'"
                                            :class="filter === 'all' ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-gray-100'"
                                            class="px-3 py-1.5 rounded-md text-sm font-medium transition-colors">
                                        All (<span x-text="notifications.length"></span>)
                                    </button>
                                    <button @click="filter = 'unread'"
                                            :class="filter === 'unread' ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-gray-100'"
                                            class="px-3 py-1.5 rounded-md text-sm font-medium transition-colors">
                                        Unread (<span x-text="unreadCount"></span>)
                                    </button>
                                </div>
                            </div>

                            <!-- Action buttons -->
                            <div class="px-4 py-2 bg-gray-50 border-b flex justify-between">
                                <button @click="markAllAsRead()"
                                        x-show="unreadCount > 0"
                                        class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                    Mark all read
                                </button>
                                <button @click="clearAll()"
                                        x-show="notifications.length > 0"
                                        class="text-sm text-red-600 hover:text-red-800 font-medium">
                                    Clear all
                                </button>
                            </div>

                            <!-- Notifications list -->
                            <div class="max-h-96 overflow-y-auto">
                                <template x-for="notification in filteredNotifications.slice(0, 20)" :key="notification.id">
                                    <div @click="markAsRead(notification.id)"
                                         class="p-4 border-b border-gray-100 hover:bg-gray-50 cursor-pointer transition-colors duration-150 border-l-4"
                                         :class="[
                                             !notification.read_at ? 'bg-blue-50' : 'bg-white',
                                             getNotificationStyle(notification.type).bgColor
                                         ]">
                                        <div class="flex items-start space-x-3">
                                            <!-- Notification icon -->
                                            <div class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center text-sm"
                                                 :class="`bg-${getNotificationStyle(notification.type).color}-100`"
                                                 x-text="getNotificationStyle(notification.type).icon">
                                            </div>

                                            <!-- Content -->
                                            <div class="flex-1 min-w-0">
                                                <div class="flex justify-between items-start">
                                                    <div class="font-medium text-sm text-gray-900 line-clamp-2"
                                                         x-text="notification.title || notification.data?.title || 'Notification'"></div>
                                                    <div class="flex flex-col items-end ml-2">
                                                        <span class="text-xs text-gray-500" x-text="formatTime(notification.created_at)"></span>
                                                        <span x-show="notification.priority === 'high'"
                                                              class="text-xs bg-red-100 text-red-800 px-1.5 py-0.5 rounded-full mt-1">
                                                            High
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="text-sm text-gray-600 mt-1 line-clamp-2"
                                                     x-text="notification.message || notification.data?.message"></div>

                                                <!-- Additional data -->
                                                <template x-if="notification.data && (notification.data.reminder || notification.data.location || notification.data.category)">
                                                    <div class="mt-2 flex flex-wrap gap-2">
                                                        <span x-show="notification.data.category"
                                                              class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800"
                                                              x-text="notification.data.category"></span>
                                                        <span x-show="notification.data.location"
                                                              class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            📍 <span x-text="notification.data.location"></span>
                                                        </span>
                                                    </div>
                                                </template>

                                                <!-- Read status -->
                                                <div class="flex items-center justify-between mt-2">
                                                    <span class="text-xs text-gray-400" x-text="formatFullDate(notification.created_at)"></span>
                                                    <span x-show="!notification.read_at"
                                                          class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>

                                <!-- Empty state -->
                                <div x-show="filteredNotifications.length === 0"
                                     class="p-8 text-center">
                                    <div class="w-16 h-16 mx-auto mb-4 text-gray-400">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                  d="M15 17h5l-5-5V9a4 4 0 00-8 0v3l-5 5h5"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 text-sm">
                                        <span x-show="filter === 'all'">No notifications yet</span>
                                        <span x-show="filter === 'unread'">No unread notifications</span>
                                    </p>
                                </div>

                                <!-- Loading state -->
                                <div x-show="loading" class="p-4 text-center">
                                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500 mx-auto"></div>
                                    <p class="text-gray-500 text-sm mt-2">Loading notifications...</p>
                                </div>
                            </div>

                            <!-- Footer -->
                            <div class="p-3 bg-gray-50 text-center border-t" x-show="filteredNotifications.length >= 20">
                                <button class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                    View all notifications
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Settings Dropdown (keeping your existing code) -->
                <div class="ms-3 relative">
                    <?php if (isset($component)) { $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown','data' => ['align' => 'right','width' => '48']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'right','width' => '48']); ?>
                         <?php $__env->slot('trigger', null, []); ?> 
                            <?php if(Laravel\Jetstream\Jetstream::managesProfilePhotos()): ?>
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="size-8 rounded-full object-cover"
                                         src="<?php echo e(Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : Auth::user()->profile_photo_url); ?>"
                                         alt="<?php echo e(Auth::user()->first_name); ?>"/>
                                </button>
                            <?php else: ?>
                                <span class="inline-flex rounded-full bg-red-500">
                                    <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        <?php echo e(Auth::user()->first_name); ?>


                                        <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                                        </svg>
                                    </button>
                                </span>
                            <?php endif; ?>
                         <?php $__env->endSlot(); ?>

                         <?php $__env->slot('content', null, []); ?> 
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                <?php echo e(__('Manage Account')); ?>

                            </div>

                            <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => ''.e(route('profile.show')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('profile.show')).'']); ?>
                                <?php echo e(__('Profile')); ?>

                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>

                            <?php if(Laravel\Jetstream\Jetstream::hasApiFeatures()): ?>
                                <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => ''.e(route('api-tokens.index')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('api-tokens.index')).'']); ?>
                                    <?php echo e(__('API Tokens')); ?>

                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
                            <?php endif; ?>

                            <div class="border-t border-gray-200"></div>

                            <!-- Authentication -->
                            <form method="POST" action="<?php echo e(route('logout')); ?>" x-data>
                                <?php echo csrf_field(); ?>

                                <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => ''.e(route('logout')).'','@click.prevent' => '$root.submit();']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('logout')).'','@click.prevent' => '$root.submit();']); ?>
                                    <?php echo e(__('Log Out')); ?>

                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
                            </form>
                         <?php $__env->endSlot(); ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $attributes = $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $component = $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
                </div>
            </div>

            <!-- Hamburger (keeping your existing code) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive navigation menu (keeping your existing code) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <?php if(Laravel\Jetstream\Jetstream::managesProfilePhotos()): ?>
                    <div class="shrink-0 me-3">
                        <img class="size-10 rounded-full object-cover" src="<?php echo e(Auth::user()->profile_photo_path); ?>"
                             alt="<?php echo e(Auth::user()->first_name); ?>"/>
                    </div>
                <?php endif; ?>

                <div>
                    <div>
                        <div class="font-medium text-base text-gray-800"><?php echo e(Auth::user()->first_name); ?></div>
                        <div class="font-medium text-base text-gray-800"><?php echo e(Auth::user()->middle_name); ?></div>
                        <div class="font-medium text-base text-gray-800"><?php echo e(Auth::user()->family_name); ?></div>
                    </div>
                    <div class="font-medium text-sm text-gray-500"><?php echo e(Auth::user()->email); ?></div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <?php if (isset($component)) { $__componentOriginald69b52d99510f1e7cd3d80070b28ca18 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald69b52d99510f1e7cd3d80070b28ca18 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.responsive-nav-link','data' => ['href' => ''.e(route('profile.show')).'','active' => request()->routeIs('profile.show')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('responsive-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('profile.show')).'','active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('profile.show'))]); ?>
                    <?php echo e(__('Profile')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald69b52d99510f1e7cd3d80070b28ca18)): ?>
<?php $attributes = $__attributesOriginald69b52d99510f1e7cd3d80070b28ca18; ?>
<?php unset($__attributesOriginald69b52d99510f1e7cd3d80070b28ca18); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald69b52d99510f1e7cd3d80070b28ca18)): ?>
<?php $component = $__componentOriginald69b52d99510f1e7cd3d80070b28ca18; ?>
<?php unset($__componentOriginald69b52d99510f1e7cd3d80070b28ca18); ?>
<?php endif; ?>

                <?php if(Laravel\Jetstream\Jetstream::hasApiFeatures()): ?>
                    <?php if (isset($component)) { $__componentOriginald69b52d99510f1e7cd3d80070b28ca18 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald69b52d99510f1e7cd3d80070b28ca18 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.responsive-nav-link','data' => ['href' => ''.e(route('api-tokens.index')).'','active' => request()->routeIs('api-tokens.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('responsive-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('api-tokens.index')).'','active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('api-tokens.index'))]); ?>
                        <?php echo e(__('API Tokens')); ?>

                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald69b52d99510f1e7cd3d80070b28ca18)): ?>
<?php $attributes = $__attributesOriginald69b52d99510f1e7cd3d80070b28ca18; ?>
<?php unset($__attributesOriginald69b52d99510f1e7cd3d80070b28ca18); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald69b52d99510f1e7cd3d80070b28ca18)): ?>
<?php $component = $__componentOriginald69b52d99510f1e7cd3d80070b28ca18; ?>
<?php unset($__componentOriginald69b52d99510f1e7cd3d80070b28ca18); ?>
<?php endif; ?>
                <?php endif; ?>

                <!-- Authentication -->
                <form method="POST" action="<?php echo e(route('logout')); ?>" x-data>
                    <?php echo csrf_field(); ?>

                    <?php if (isset($component)) { $__componentOriginald69b52d99510f1e7cd3d80070b28ca18 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald69b52d99510f1e7cd3d80070b28ca18 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.responsive-nav-link','data' => ['href' => ''.e(route('logout')).'','@click.prevent' => '$root.submit();']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('responsive-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('logout')).'','@click.prevent' => '$root.submit();']); ?>
                        <?php echo e(__('Log Out')); ?>

                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald69b52d99510f1e7cd3d80070b28ca18)): ?>
<?php $attributes = $__attributesOriginald69b52d99510f1e7cd3d80070b28ca18; ?>
<?php unset($__attributesOriginald69b52d99510f1e7cd3d80070b28ca18); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald69b52d99510f1e7cd3d80070b28ca18)): ?>
<?php $component = $__componentOriginald69b52d99510f1e7cd3d80070b28ca18; ?>
<?php unset($__componentOriginald69b52d99510f1e7cd3d80070b28ca18); ?>
<?php endif; ?>
                </form>

                <!-- Team Management -->
                <?php if(Laravel\Jetstream\Jetstream::hasTeamFeatures()): ?>
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        <?php echo e(__('Manage Team')); ?>

                    </div>

                    <!-- Team Settings -->
                    <?php if (isset($component)) { $__componentOriginald69b52d99510f1e7cd3d80070b28ca18 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald69b52d99510f1e7cd3d80070b28ca18 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.responsive-nav-link','data' => ['href' => ''.e(route('teams.show', Auth::user()->currentTeam->id)).'','active' => request()->routeIs('teams.show')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('responsive-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('teams.show', Auth::user()->currentTeam->id)).'','active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('teams.show'))]); ?>
                        <?php echo e(__('Team Settings')); ?>

                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald69b52d99510f1e7cd3d80070b28ca18)): ?>
<?php $attributes = $__attributesOriginald69b52d99510f1e7cd3d80070b28ca18; ?>
<?php unset($__attributesOriginald69b52d99510f1e7cd3d80070b28ca18); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald69b52d99510f1e7cd3d80070b28ca18)): ?>
<?php $component = $__componentOriginald69b52d99510f1e7cd3d80070b28ca18; ?>
<?php unset($__componentOriginald69b52d99510f1e7cd3d80070b28ca18); ?>
<?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', Laravel\Jetstream\Jetstream::newTeamModel())): ?>
                        <?php if (isset($component)) { $__componentOriginald69b52d99510f1e7cd3d80070b28ca18 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald69b52d99510f1e7cd3d80070b28ca18 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.responsive-nav-link','data' => ['href' => ''.e(route('teams.create')).'','active' => request()->routeIs('teams.create')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('responsive-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('teams.create')).'','active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('teams.create'))]); ?>
                            <?php echo e(__('Create New Team')); ?>

                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald69b52d99510f1e7cd3d80070b28ca18)): ?>
<?php $attributes = $__attributesOriginald69b52d99510f1e7cd3d80070b28ca18; ?>
<?php unset($__attributesOriginald69b52d99510f1e7cd3d80070b28ca18); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald69b52d99510f1e7cd3d80070b28ca18)): ?>
<?php $component = $__componentOriginald69b52d99510f1e7cd3d80070b28ca18; ?>
<?php unset($__componentOriginald69b52d99510f1e7cd3d80070b28ca18); ?>
<?php endif; ?>
                    <?php endif; ?>

                    <!-- Team Switcher -->
                    <?php if(Auth::user()->allTeams()->count() > 1): ?>
                        <div class="border-t border-gray-200"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            <?php echo e(__('Switch Teams')); ?>

                        </div>

                        <?php $__currentLoopData = Auth::user()->allTeams(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if (isset($component)) { $__componentOriginal12b9baaa9d085739b53a541d2c8778fa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal12b9baaa9d085739b53a541d2c8778fa = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.switchable-team','data' => ['team' => $team,'component' => 'responsive-nav-link']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('switchable-team'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['team' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($team),'component' => 'responsive-nav-link']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal12b9baaa9d085739b53a541d2c8778fa)): ?>
<?php $attributes = $__attributesOriginal12b9baaa9d085739b53a541d2c8778fa; ?>
<?php unset($__attributesOriginal12b9baaa9d085739b53a541d2c8778fa); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal12b9baaa9d085739b53a541d2c8778fa)): ?>
<?php $component = $__componentOriginal12b9baaa9d085739b53a541d2c8778fa; ?>
<?php unset($__componentOriginal12b9baaa9d085739b53a541d2c8778fa); ?>
<?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php /**PATH C:\laragon\www\ARK\resources\views/components/header.blade.php ENDPATH**/ ?>