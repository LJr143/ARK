<div class="min-h-screen bg-gray-50">
    <div class="container mx-auto px-4 py-4 lg:py-6 max-w-12xl">

        
        <!--[if BLOCK]><![endif]--><?php if(session()->has('message')): ?>
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg" role="alert">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span><?php echo e(session('message')); ?></span>
                </div>
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        
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
                                       <div class="p-3 bg-primary bg-opacity-20 rounded-2xl backdrop-blur-sm animate-float">
                                           <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                     d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                           </svg>
                                       </div>
                                       <h1 class="text-2xl lg:text-3xl text-white font-bold">Reminders</h1>
                                   </div>
                                   <p class="text-white text-sm lg:text-base">Manage and track member reminders</p>
                               </div>
                                
                                <div class="flex-shrink-0">
                                    <button wire:click="sendReminder"
                                            class="w-full sm:w-auto bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-lg flex items-center justify-center space-x-2 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                        <i class="fas fa-paper-plane"></i>
                                        <span class="font-medium">Send Reminder</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        
                        <nav class="hidden lg:flex space-x-8 mt-6">
                            <button wire:click="setMainTab('list')"
                                    class="transition-colors duration-200 <?php echo e($activeMainTab === 'list' ? 'text-white border-b-2 border-blue-600 pb-2 font-semibold' : 'text-black hover:text-gray-700 pb-2 font-medium'); ?>">
                                <i class="fas fa-list mr-2"></i>List
                            </button>
                            <button wire:click="setMainTab('manage')"
                                    class="transition-colors duration-200 <?php echo e($activeMainTab === 'manage' ? 'text-white border-b-2 border-blue-600 pb-2 font-semibold' : 'text-black hover:text-gray-700 pb-2 font-medium'); ?>">
                                <i class="fas fa-cog mr-2"></i>Manage Reminder
                            </button>
                            <button wire:click="setMainTab('recipients')"
                                    class="transition-colors duration-200 <?php echo e($activeMainTab === 'recipients' ? 'text-white border-b-2 border-blue-600 pb-2 font-semibold' : 'text-black hover:text-gray-700 pb-2 font-medium'); ?>">
                                <i class="fas fa-users mr-2"></i>Recipients
                            </button>
                        </nav>

                        
                        <button wire:click="toggleMobileMenu"
                                class="lg:hidden flex items-center mt-4 px-4 py-2 bg-gray-100 rounded-lg text-gray-700 hover:bg-gray-200 transition-colors w-full sm:w-auto">
                            <i class="fas fa-bars mr-2"></i>
                            <span><?php echo e(ucfirst($activeMainTab)); ?></span>
                            <i class="fas fa-chevron-down ml-auto transform transition-transform <?php echo e($showMobileMenu ? 'rotate-180' : ''); ?>"></i>
                        </button>

                        
                        <!--[if BLOCK]><![endif]--><?php if($showMobileMenu): ?>
                            <div
                                class="lg:hidden mt-2 bg-white border border-gray-200 rounded-lg shadow-lg py-2 animate-fade-in">
                                <button wire:click="setMainTab('list')"
                                        class="w-full text-left px-4 py-3 hover:bg-gray-50 transition-colors <?php echo e($activeMainTab === 'list' ? 'bg-blue-50 text-blue-600' : ''); ?>">
                                    <i class="fas fa-list mr-3"></i>List
                                </button>
                                <button wire:click="setMainTab('manage')"
                                        class="w-full text-left px-4 py-3 hover:bg-gray-50 transition-colors <?php echo e($activeMainTab === 'manage' ? 'bg-blue-50 text-blue-600' : ''); ?>">
                                    <i class="fas fa-cog mr-3"></i>Manage Reminder
                                </button>
                                <button wire:click="setMainTab('recipients')"
                                        class="w-full text-left px-4 py-3 hover:bg-gray-50 transition-colors <?php echo e($activeMainTab === 'recipients' ? 'bg-blue-50 text-blue-600' : ''); ?>">
                                    <i class="fas fa-users mr-3"></i>Recipients
                                </button>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>
            </div>
        </div>

        
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">

            <!-- Send Reminder Modal -->
            <!--[if BLOCK]><![endif]--><?php if($showSendModal): ?>
                <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                        <div class="mt-3 text-center">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Send Reminder</h3>

                            <!-- Notification Method Selection -->
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Notification Methods</label>
                                <div class="space-y-2">
                                    <label class="flex items-center">
                                        <input type="checkbox"
                                               wire:model="selectedNotificationMethods.email"
                                               class="rounded border-gray-300">
                                        <span class="ml-2">Email</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox"
                                               wire:model="selectedNotificationMethods.sms"
                                               class="rounded border-gray-300">
                                        <span class="ml-2">SMS</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox"
                                               wire:model="selectedNotificationMethods.app"
                                               class="rounded border-gray-300">
                                        <span class="ml-2">App Notification</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Loading State -->
                            <!--[if BLOCK]><![endif]--><?php if($sendingNotification): ?>
                                <div class="mb-4">
                                    <div class="flex items-center justify-center">
                                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        <span>Sending notifications...</span>
                                    </div>
                                </div>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                            <!-- Results Display -->
                            <!--[if BLOCK]><![endif]--><?php if($notificationResults && !$sendingNotification): ?>
                                <div class="mb-4 p-4 border rounded-lg">
                                    <!--[if BLOCK]><![endif]--><?php if(isset($notificationResults['error']) && $notificationResults['error']): ?>
                                        <div class="text-red-600">
                                            <h4 class="font-medium">Error occurred:</h4>
                                            <p class="text-sm"><?php echo e($notificationResults['message']); ?></p>
                                        </div>
                                    <?php else: ?>
                                        <div class="text-left">
                                            <h4 class="font-medium text-gray-900 mb-2">Notification Results:</h4>

                                            <!-- Email Results -->
                                            <div class="mb-2">
                                                <span class="text-sm font-medium">Email:</span>
                                                <span class="text-sm text-green-600"><?php echo e($notificationResults['email']['sent'] ?? 0); ?> sent</span>
                                                <!--[if BLOCK]><![endif]--><?php if(isset($notificationResults['email']['failed']) && $notificationResults['email']['failed'] > 0): ?>
                                                    <span class="text-sm text-red-600">, <?php echo e($notificationResults['email']['failed']); ?> failed</span>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            </div>

                                            <!-- SMS Results -->
                                            <div class="mb-2">
                                                <span class="text-sm font-medium">SMS:</span>
                                                <span class="text-sm text-green-600"><?php echo e($notificationResults['sms']['sent'] ?? 0); ?> sent</span>
                                                <!--[if BLOCK]><![endif]--><?php if(isset($notificationResults['sms']['failed']) && $notificationResults['sms']['failed'] > 0): ?>
                                                    <span class="text-sm text-red-600">, <?php echo e($notificationResults['sms']['failed']); ?> failed</span>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            </div>

                                            <!-- App Notification Results -->
                                            <div class="mb-2">
                                                <span class="text-sm font-medium">App:</span>
                                                <span class="text-sm text-green-600"><?php echo e($notificationResults['app']['sent'] ?? 0); ?> sent</span>
                                                <!--[if BLOCK]><![endif]--><?php if(isset($notificationResults['app']['failed']) && $notificationResults['app']['failed'] > 0): ?>
                                                    <span class="text-sm text-red-600">, <?php echo e($notificationResults['app']['failed']); ?> failed</span>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            </div>

                                            <!-- Total -->
                                            <?php
                                                $totalSent = ($notificationResults['email']['sent'] ?? 0) +
                                                           ($notificationResults['sms']['sent'] ?? 0) +
                                                           ($notificationResults['app']['sent'] ?? 0);
                                            ?>
                                            <div class="mt-2 pt-2 border-t">
                                                <span class="text-sm font-medium">Total: </span>
                                                <span class="text-sm font-bold text-green-600"><?php echo e($totalSent); ?> notifications sent</span>
                                            </div>
                                        </div>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                            <!-- Action Buttons -->
                            <div class="flex justify-center space-x-3">
                                <!--[if BLOCK]><![endif]--><?php if(!$notificationResults || $sendingNotification): ?>
                                    <button wire:click="sendReminder"
                                            <?php if($sendingNotification): ?> disabled <?php endif; ?>
                                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 disabled:opacity-50">
                                        <!--[if BLOCK]><![endif]--><?php if($sendingNotification): ?>
                                            Sending...
                                        <?php else: ?>
                                            Send Reminder
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </button>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                <button wire:click="closeSendModal"
                                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                                    <!--[if BLOCK]><![endif]--><?php if($notificationResults && !$sendingNotification): ?>
                                        Close
                                    <?php else: ?>
                                        Cancel
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            
            <!--[if BLOCK]><![endif]--><?php if($activeMainTab === 'recipients'): ?>
                <div class="border-b border-gray-200">
                    <div class="px-4 lg:px-6 py-4">
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                            <nav class="flex space-x-6 overflow-x-auto">
                                <button wire:click="setSubTab('details')"
                                        class="whitespace-nowrap transition-colors duration-200 <?php echo e($activeSubTab === 'details' ? 'text-blue-600 border-b-2 border-blue-600 pb-2 font-semibold' : 'text-gray-500 hover:text-gray-700 font-medium'); ?>">
                                    <i class="fas fa-info-circle mr-2"></i>Reminder Details
                                </button>
                                <button wire:click="setSubTab('members')"
                                        class="whitespace-nowrap transition-colors duration-200 <?php echo e($activeSubTab === 'members' ? 'text-blue-600 border-b-2 border-blue-600 pb-2 font-semibold' : 'text-gray-500 hover:text-gray-700 font-medium'); ?>">
                                    <i class="fas fa-users mr-2"></i>Members
                                </button>
                            </nav>
                            <button wire:click="openAddMemberModal"
                                    class="flex-shrink-0 text-blue-600 hover:text-blue-700 hover:bg-blue-50 px-4 py-2 rounded-lg flex items-center space-x-2 font-medium transition-colors duration-200">
                                <i class="fas fa-plus text-sm"></i>
                                <span>Add Member</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

            
            <div class="p-4 lg:p-6">
                
                <?php if($activeMainTab === 'recipients'): ?>
                    
                    <?php if($activeSubTab === 'members'): ?>
                        <!--[if BLOCK]><![endif]--><?php if($members->count() > 0): ?>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-4 text-white">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-green-100 text-sm">Paid</p>
                                            <p class="text-2xl font-bold"><?php echo e($members->where('payment_status', 'paid')->count()); ?></p>
                                        </div>
                                        <i class="fas fa-check-circle text-2xl text-green-200"></i>
                                    </div>
                                </div>
                                <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg p-4 text-white">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-yellow-100 text-sm">Unpaid</p>
                                            <p class="text-2xl font-bold"><?php echo e($members->where('payment_status', 'unpaid')->count()); ?></p>
                                        </div>
                                        <i class="fas fa-clock text-2xl text-yellow-200"></i>
                                    </div>
                                </div>
                                <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-lg p-4 text-white">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-red-100 text-sm">Overdue</p>
                                            <p class="text-2xl font-bold"><?php echo e($members->where('payment_status', 'overdue')->count()); ?></p>
                                        </div>
                                        <i class="fas fa-exclamation-triangle text-2xl text-red-200"></i>
                                    </div>
                                </div>
                                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-4 text-white">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-blue-100 text-sm">Total</p>
                                            <p class="text-2xl font-bold"><?php echo e($members->count()); ?></p>
                                        </div>
                                        <i class="fas fa-users text-2xl text-blue-200"></i>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="overflow-hidden rounded-lg border border-gray-200">
                                
                                <div class="block sm:hidden">
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="bg-white border-b border-gray-200 p-4">
                                            <div class="flex items-start space-x-3">
                                                <div
                                                    class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0">
                                                    <i class="fas fa-user text-white text-sm"></i>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <div class="flex items-center justify-between mb-2">
                                                        <h3 class="font-medium text-gray-900 truncate"><?php echo e($member['name']); ?></h3>
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo e($this->getPaymentStatusBadgeClass($member['payment_status'])); ?>">
                                                            <?php echo e(ucfirst($member['payment_status'])); ?>

                                                        </span>
                                                    </div>
                                                    <p class="text-sm text-gray-500 mb-1">PRC
                                                        No. <?php echo e($member['prc_no']); ?></p>
                                                    <p class="text-sm text-gray-900 mb-1"><?php echo e($member['email']); ?></p>
                                                    <p class="text-sm text-gray-500 mb-1"><?php echo e($member['phone']); ?></p>
                                                    <p class="text-xs text-gray-400">
                                                        Added: <?php echo e($member['date_added']); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>

                                
                                <div class="hidden sm:block">
                                    <table class="w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Member
                                            </th>
                                            <th class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Payment Status
                                            </th>
                                            <th class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Contact Details
                                            </th>
                                            <th class="px-4 lg:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Date Added
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="px-4 lg:px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div
                                                            class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0">
                                                            <i class="fas fa-user text-white text-sm"></i>
                                                        </div>
                                                        <div class="ml-3">
                                                            <div
                                                                class="text-sm font-medium text-gray-900"><?php echo e($member['name']); ?></div>
                                                            <div class="text-sm text-gray-500">PRC
                                                                No. <?php echo e($member['prc_no']); ?></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-4 lg:px-6 py-4 whitespace-nowrap">
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo e($this->getPaymentStatusBadgeClass($member['payment_status'])); ?>">
                                                            <?php echo e(ucfirst($member['payment_status'])); ?>

                                                        </span>
                                                </td>
                                                <td class="px-4 lg:px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900"><?php echo e($member['email']); ?></div>
                                                    <div class="text-sm text-gray-500"><?php echo e($member['phone']); ?></div>
                                                </td>
                                                <td class="px-4 lg:px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    <?php echo e($member['date_added']); ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php else: ?>
                            
                            <div class="text-center py-12">
                                <div
                                    class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-users text-gray-400 text-3xl"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">No members found</h3>
                                <p class="text-gray-500 mb-6 max-w-sm mx-auto">Get started by adding your first member
                                    to the reminder system.</p>
                                <button wire:click="openAddMemberModal"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg flex items-center space-x-2 mx-auto transition-colors duration-200">
                                    <i class="fas fa-plus"></i>
                                    <span>Add First Member</span>
                                </button>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                    
                    <!--[if BLOCK]><![endif]--><?php if($activeSubTab === 'details'): ?>
                        <!--[if BLOCK]><![endif]--><?php if($reminderDetails): ?>
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
                                            <div
                                                class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
                                                <div class="flex-1">
                                                    <div class="flex items-center gap-3 mb-4">
                                                        <div
                                                            class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                                                            <i class="fas fa-bell text-xl"></i>
                                                        </div>
                                                        <div>
                                                            <h1 class="text-3xl lg:text-4xl font-bold mb-2"><?php echo e($reminderDetails['title']); ?></h1>
                                                            <div
                                                                class="flex items-center gap-2 text-white text-opacity-80">
                                                                <i class="fas fa-hashtag text-sm"></i>
                                                                <span
                                                                    class="text-sm font-medium"><?php echo e($reminderDetails['reminder_id']); ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="flex flex-wrap gap-3">
                                                    <button
                                                        wire:click="toggleArchive"
                                                        class="status-badge px-6 py-3 <?php echo e($reminderDetails['status'] === 'archived' ? 'bg-green-100 text-green-800' : 'bg-white bg-opacity-20 text-white'); ?> rounded-xl hover:bg-opacity-30 transition-all duration-300 flex items-center gap-2 font-medium">
                                                        <i class="fas fa-archive"></i>
                                                        <span><?php echo e($reminderDetails['status'] === 'archived' ? 'Unarchive' : 'Archive'); ?></span>
                                                    </button>
                                                    <button
                                                        class="status-badge px-6 py-3 bg-white text-gray-800 rounded-xl hover:bg-opacity-90 transition-all duration-300 flex items-center gap-2 font-medium shadow-lg">
                                                        <i class="fas fa-edit"></i>
                                                        <span>Edit Reminder</span>
                                                    </button>
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
                                                    <h2 class="text-xl font-semibold text-gray-800"><?php echo e($reminderDetails['category']); ?>

                                                        Details</h2>
                                                </div>

                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                    <div class="space-y-4">
                                                        <div class="p-4 bg-green-50 rounded-xl border border-green-200">
                                                            <p class="text-sm font-medium text-green-700 mb-1">Start
                                                                Time</p>
                                                            <div class="flex items-center gap-2">
                                                                <i class="fas fa-play-circle text-green-600"></i>
                                                                <p class="text-green-800 font-semibold"><?php echo e($reminderDetails['start_date']['date']); ?></p>
                                                            </div>
                                                            <p class="text-green-700 text-sm"><?php echo e($reminderDetails['start_date']['time']); ?></p>
                                                        </div>
                                                        <div class="p-4 bg-blue-50 rounded-xl border border-blue-200">

                                                            <!--[if BLOCK]><![endif]--><?php if($reminderDetails['period']): ?>

                                                                <p class="text-sm font-medium text-blue-700 mb-1">Period
                                                                    Covered</p>
                                                                <div class="flex items-center gap-2">
                                                                    <i class="fas fa-calendar-range text-blue-600"></i>
                                                                    <p class="text-blue-800 font-semibold">June 2025 -
                                                                        July 2026</p>
                                                                </div>
                                                            <?php else: ?>
                                                                <p class="text-sm font-medium text-blue-700 mb-1">Period
                                                                    Covered</p>
                                                                <div class="flex items-center gap-2">
                                                                    <i class="fas fa-calendar-range text-blue-600"></i>
                                                                    <p class="text-blue-800 font-semibold">No Period
                                                                        Covered</p>
                                                                </div>
                                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                        </div>
                                                    </div>

                                                    <div class="space-y-4">
                                                        <div class="p-4 bg-red-50 rounded-xl border border-red-200">
                                                            <p class="text-sm font-medium text-red-700 mb-1">End
                                                                Time</p>
                                                            <div class="flex items-center gap-2">
                                                                <i class="fas fa-stop-circle text-red-600"></i>
                                                                <p class="text-red-800 font-semibold"><?php echo e($reminderDetails['end_date']['date']); ?></p>
                                                            </div>
                                                            <p class="text-red-700 text-sm"><?php echo e($reminderDetails['end_date']['time']); ?></p>
                                                        </div>

                                                        <div
                                                            class="p-4 bg-purple-50 rounded-xl border border-purple-200">
                                                            <p class="text-sm font-medium text-purple-700 mb-1">
                                                                Location</p>
                                                            <div class="flex items-center gap-2">
                                                                <i class="fas fa-map-marker-alt text-purple-600"></i>
                                                                <p class="text-purple-800 font-semibold"><?php echo e($reminderDetails['location']); ?></p>
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
                                                        <p class="text-gray-700 leading-relaxed mb-4"><?php echo e($reminderDetails['description']); ?></p>
                                                        
                                                        
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
                                                                    class="text-sm text-gray-500"><?php echo e($reminderDetails['created_at']); ?></span>
                                                            </div>
                                                            <p class="text-gray-600 text-sm">Created by Admin User</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Sidebar -->
                                        <div class="space-y-6">
                                            <!-- Quick Stats -->
                                            <div class="glass-effect rounded-2xl p-6 card-hover">
                                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Stats</h3>
                                                <div class="space-y-4">
                                                    <div
                                                        class="flex items-center justify-between p-3 bg-blue-50 rounded-xl">
                                                        <div class="flex items-center gap-3">
                                                            <i class="fas fa-users text-blue-600"></i>
                                                            <span class="text-gray-700">Recipients</span>
                                                        </div>
                                                        <span class="font-bold text-blue-600">247</span>
                                                    </div>

                                                    <div
                                                        class="flex items-center justify-between p-3 bg-green-50 rounded-xl">
                                                        <div class="flex items-center gap-3">
                                                            <i class="fas fa-check-circle text-green-600"></i>
                                                            <span class="text-gray-700">Delivered</span>
                                                        </div>
                                                        <span class="font-bold text-green-600">245</span>
                                                    </div>

                                                    <div
                                                        class="flex items-center justify-between p-3 bg-yellow-50 rounded-xl">
                                                        <div class="flex items-center gap-3">
                                                            <i class="fas fa-clock text-yellow-600"></i>
                                                            <span class="text-gray-700">Pending</span>
                                                        </div>
                                                        <span class="font-bold text-yellow-600">2</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Attachments -->
                                            <div class="glass-effect rounded-2xl p-6 card-hover">
                                                <div class="flex items-center gap-3 mb-6">
                                                    <div
                                                        class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                                                        <i class="fas fa-paperclip text-purple-600"></i>
                                                    </div>
                                                    <h3 class="text-lg font-semibold text-gray-800">Attachments</h3>
                                                </div>

                                                <!--[if BLOCK]><![endif]--><?php if(empty($reminderDetails['attachments'])): ?>
                                                    <div
                                                        class="flex flex-col items-center justify-center p-6 bg-gray-50 rounded-xl border border-gray-200 text-center">
                                                        <i class="fas fa-paperclip text-gray-400 text-3xl mb-3"></i>
                                                        <p class="text-gray-600 font-medium mb-1">No Attachments
                                                            Available</p>
                                                        <p class="text-sm text-gray-500">There are no files attached to
                                                            this reminder.</p>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="space-y-3">
                                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $reminderDetails['attachments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php
                                                                $colorClasses = [
                                                                    'red' => 'from-red-50 to-pink-50 hover:from-red-100 hover:to-pink-100 border-red-200 text-red-600',
                                                                    'green' => 'from-green-50 to-emerald-50 hover:from-green-100 hover:to-emerald-100 border-green-200 text-green-600',
                                                                    'blue' => 'from-blue-50 to-cyan-50 hover:from-blue-100 hover:to-cyan-100 border-blue-200 text-blue-600',
                                                                    'purple' => 'from-purple-50 to-violet-50 hover:from-purple-100 hover:to-violet-100 border-purple-200 text-purple-600',
                                                                    'default' => 'from-gray-50 to-gray-100 hover:from-gray-100 hover:to-gray-200 border-gray-200 text-gray-600'
                                                                ];
                                                                $colorClass = $colorClasses[$attachment['color']] ?? $colorClasses['default'];
                                                            ?>

                                                            <div
                                                                class="group flex items-center p-4 bg-gradient-to-r <?php echo e($colorClass); ?> rounded-xl transition-all duration-300 cursor-pointer border">
                                                                <input type="checkbox"
                                                                       class="h-4 w-4 text-<?php echo e($attachment['color']); ?>-600 border-<?php echo e($attachment['color']); ?>-300 rounded focus:ring-<?php echo e($attachment['color']); ?>-500 mr-3">
                                                                <div
                                                                    class="w-10 h-10 bg-<?php echo e($attachment['color']); ?>-100 rounded-lg flex items-center justify-center mr-3">
                                                                    <i class="fas <?php echo e($attachment['icon']); ?> text-<?php echo e($attachment['color']); ?>-600"></i>
                                                                </div>
                                                                <div class="flex-1">
                                                                    <p class="font-medium text-gray-800 group-hover:text-<?php echo e($attachment['color']); ?>-700"><?php echo e($attachment['name']); ?></p>
                                                                    <p class="text-sm text-gray-500"><?php echo e($attachment['size']); ?></p>
                                                                </div>
                                                                <a href="<?php echo e(Storage::url($attachment['path'])); ?>"
                                                                   target="_blank"
                                                                   class="opacity-0 group-hover:opacity-100 transition-opacity p-2 hover:bg-white hover:bg-opacity-50 rounded-lg"
                                                                   download="<?php echo e($attachment['name']); ?>">
                                                                    <i class="fas fa-download text-<?php echo e($attachment['color']); ?>-600"></i>
                                                                </a>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                    </div>

                                                    <!--[if BLOCK]><![endif]--><?php if(count($reminderDetails['attachments']) > 1): ?>
                                                        <div class="mt-4 pt-4 border-t border-gray-200">
                                                            <button
                                                                class="w-full py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 font-medium flex items-center justify-center gap-2">
                                                                <i class="fas fa-download"></i>
                                                                Download All
                                                            </button>
                                                        </div>
                                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            
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
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                
                <!--[if BLOCK]><![endif]--><?php if($activeMainTab === 'list'): ?>
                    <div class="text-center py-12">
                        <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-list text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No reminders found</h3>
                        <p class="text-gray-500 mb-6 max-w-sm mx-auto">Create your first reminder to get started with
                            member notifications.</p>
                        <button wire:click="setMainTab('manage')"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg flex items-center space-x-2 mx-auto transition-colors duration-200">
                            <i class="fas fa-plus"></i>
                            <span>Create First Reminder</span>
                        </button>
                    </div>
<?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\ARK\resources\views/livewire/reminder/manage-reminder.blade.php ENDPATH**/ ?>