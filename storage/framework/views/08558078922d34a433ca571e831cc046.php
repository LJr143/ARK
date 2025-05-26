<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('sidebar', null, []); ?> 
        <?php if (isset($component)) { $__componentOriginalc2de825d4e33209ddffb818784ae7904 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2de825d4e33209ddffb818784ae7904 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.side-bar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('side-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2de825d4e33209ddffb818784ae7904)): ?>
<?php $attributes = $__attributesOriginalc2de825d4e33209ddffb818784ae7904; ?>
<?php unset($__attributesOriginalc2de825d4e33209ddffb818784ae7904); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2de825d4e33209ddffb818784ae7904)): ?>
<?php $component = $__componentOriginalc2de825d4e33209ddffb818784ae7904; ?>
<?php unset($__componentOriginalc2de825d4e33209ddffb818784ae7904); ?>
<?php endif; ?>
     <?php $__env->endSlot(); ?>
     <?php $__env->slot('header', null, []); ?> 
        <?php if (isset($component)) { $__componentOriginalfd1f218809a441e923395fcbf03e4272 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfd1f218809a441e923395fcbf03e4272 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $attributes = $__attributesOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__attributesOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $component = $__componentOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__componentOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>
     <?php $__env->endSlot(); ?>
    <div class="py-4">
        <div class="max-w-full mx-auto sm:px-6 lg:px-6">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="bg-white rounded-lg shadow-sm mb-6 p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Reminders</h1>
                            <nav class="flex space-x-6 mt-4">
                                <a href="#" class="text-blue-600 border-b-2 border-blue-600 pb-2 font-medium">List</a>
                                <a href="#" class="text-gray-500 hover:text-gray-700 pb-2">Manage Reminder</a>
                                <a href="#" class="text-gray-500 hover:text-gray-700 pb-2">Recipients</a>
                            </nav>
                        </div>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                            <i class="fas fa-paper-plane"></i>
                            <span>Send Reminder</span>
                        </button>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="bg-white rounded-lg shadow-sm">
                    <!-- Sub Navigation -->
                    <div class="border-b border-gray-200 px-6 py-4">
                        <div class="flex justify-between items-center">
                            <nav class="flex space-x-6">
                                <a href="#" class="text-gray-500 hover:text-gray-700 font-medium">Reminder Details</a>
                                <a href="#" class="text-blue-600 border-b-2 border-blue-600 pb-2 font-medium">Members</a>
                            </nav>
                            <button class="text-blue-600 hover:text-blue-700 flex items-center space-x-1 font-medium">
                                <i class="fas fa-plus text-sm"></i>
                                <span>Add Member</span>
                            </button>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="text-left py-3 px-4 font-medium text-gray-700">Member</th>
                                    <th class="text-left py-3 px-4 font-medium text-gray-700">Payment Status</th>
                                    <th class="text-left py-3 px-4 font-medium text-gray-700">Contact Details</th>
                                    <th class="text-left py-3 px-4 font-medium text-gray-700">Date Added</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                <!-- Member 1 -->
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-4 px-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user text-white text-sm"></i>
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900">Name of the member</div>
                                                <div class="text-sm text-gray-500">PRC No. 11111</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Paid
                                    </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm text-gray-900">sample@email.com</div>
                                        <div class="text-sm text-gray-500">+63 123 1234 123</div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm text-gray-900">2025-05-12 10:42 AM</div>
                                    </td>
                                </tr>

                                <!-- Member 2 -->
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-4 px-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user text-white text-sm"></i>
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900">Name of the member</div>
                                                <div class="text-sm text-gray-500">PRC No. 11111</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Paid
                                    </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm text-gray-900">sample@email.com</div>
                                        <div class="text-sm text-gray-500">+63 123 1234 123</div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm text-gray-900">2025-05-12 10:42 AM</div>
                                    </td>
                                </tr>

                                <!-- Member 3 -->
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-4 px-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user text-white text-sm"></i>
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900">Name of the member</div>
                                                <div class="text-sm text-gray-500">PRC No. 11111</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Unpaid
                                    </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm text-gray-900">sample@email.com</div>
                                        <div class="text-sm text-gray-500">+63 123 1234 123</div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm text-gray-900">2025-05-12 10:42 AM</div>
                                    </td>
                                </tr>

                                <!-- Member 4 -->
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-4 px-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user text-white text-sm"></i>
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900">Name of the member</div>
                                                <div class="text-sm text-gray-500">PRC No. 11111</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Overdue
                                    </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm text-gray-900">sample@email.com</div>
                                        <div class="text-sm text-gray-500">+63 123 1234 123</div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm text-gray-900">2025-05-12 10:42 AM</div>
                                    </td>
                                </tr>

                                <!-- Member 5 -->
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-4 px-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user text-white text-sm"></i>
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900">Name of the member</div>
                                                <div class="text-sm text-gray-500">PRC No. 11111</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Unpaid
                                    </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm text-gray-900">sample@email.com</div>
                                        <div class="text-sm text-gray-500">+63 123 1234 123</div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm text-gray-900">2025-05-12 10:42 AM</div>
                                    </td>
                                </tr>

                                <!-- Member 6 -->
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-4 px-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user text-white text-sm"></i>
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900">Name of the member</div>
                                                <div class="text-sm text-gray-500">PRC No. 11111</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Paid
                                    </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm text-gray-900">sample@email.com</div>
                                        <div class="text-sm text-gray-500">+63 123 1234 123</div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm text-gray-900">2025-05-12 10:42 AM</div>
                                    </td>
                                </tr>

                                <!-- Member 7 -->
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-4 px-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user text-white text-sm"></i>
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900">Name of the member</div>
                                                <div class="text-sm text-gray-500">PRC No. 11111</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Paid
                                    </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm text-gray-900">sample@email.com</div>
                                        <div class="text-sm text-gray-500">+63 123 1234 123</div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm text-gray-900">2025-05-12 10:42 AM</div>
                                    </td>
                                </tr>

                                <!-- Member 8 -->
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-4 px-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user text-white text-sm"></i>
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900">Name of the member</div>
                                                <div class="text-sm text-gray-500">PRC No. 11111</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Unpaid
                                    </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm text-gray-900">sample@email.com</div>
                                        <div class="text-sm text-gray-500">+63 123 1234 123</div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm text-gray-900">2025-05-12 10:42 AM</div>
                                    </td>
                                </tr>

                                <!-- Member 9 -->
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-4 px-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user text-white text-sm"></i>
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900">Name of the member</div>
                                                <div class="text-sm text-gray-500">PRC No. 11111</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Unpaid
                                    </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm text-gray-900">sample@email.com</div>
                                        <div class="text-sm text-gray-500">+63 123 1234 123</div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm text-gray-900">2025-05-12 10:42 AM</div>
                                    </td>
                                </tr>

                                <!-- Member 10 -->
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-4 px-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user text-white text-sm"></i>
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900">Name of the member</div>
                                                <div class="text-sm text-gray-500">PRC No. 11111</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Unpaid
                                    </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm text-gray-900">sample@email.com</div>
                                        <div class="text-sm text-gray-500">+63 123 1234 123</div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <div class="text-sm text-gray-900">2025-05-12 10:42 AM</div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\ARK\resources\views/ark/admin/reminders/manage-rerminder.blade.php ENDPATH**/ ?>