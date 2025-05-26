<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
    <div class="flex justify-between items-center align-middle">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Reminders</h1>
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('reminder.create-reminder', []);

$__html = app('livewire')->mount($__name, $__params, 'lw-3374687415-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    </div>
    <div>
        <div class="border-gray-200">
            <nav class="flex space-x-8 overflow-x-auto" aria-label="Tabs">
                <div class="flex bg-[#F1F5F9] p-4 rounded-md space-x-8">
                    <button
                        wire:click="$set('filter', 'all_reminders')"
                        class="whitespace-nowrap px-1 text-[12px] font-medium <?php echo e($filter === 'all_reminders' ? 'bg-white py-2 px-4 rounded text-black' : 'text-gray-500 hover:text-black'); ?>"
                    >
                        All Reminders
                    </button>
                    <button
                        wire:click="$set('filter', 'upcoming_reminders')"
                        class="whitespace-nowrap px-1 text-[12px] font-medium <?php echo e($filter === 'upcoming_reminders' ? 'bg-white py-2 px-4 rounded text-black' : 'text-gray-500 hover:text-black'); ?>"
                    >
                        Upcoming
                    </button>
                    <button
                        wire:click="$set('filter', 'ended_reminders')"
                        class="whitespace-nowrap px-1 text-[12px] font-medium <?php echo e($filter === 'ended_reminders' ? 'bg-white py-2 px-4 rounded text-black' : 'text-gray-500 hover:text-black'); ?>"
                    >
                        Ended
                    </button>
                    <button
                        wire:click="$set('filter', 'archived_reminders')"
                        class="whitespace-nowrap px-1 text-[12px] font-medium <?php echo e($filter === 'archived_reminders' ? 'bg-white py-2 px-4 rounded text-black' : 'text-gray-500 hover:text-black'); ?>"
                    >
                        Archived
                    </button>
                </div>
            </nav>
        </div>
        <div class="mt-8 min-h-screen">
            <div class="border rounded-lg min-h-screen p-6 bg-gray-50">
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $reminders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reminder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div
                        class="flex flex-col md:flex-row bg-white rounded-lg shadow-md p-4 mb-4 w-full hover:shadow-lg transition-shadow duration-200">
                        <!-- Image Section - Fixed 280x150px -->
                        <div class="w-[280px] h-[150px] flex-shrink-0 overflow-hidden rounded-lg mr-4">
                            <img
                                class="w-full h-full object-cover"
                                src="<?php echo e($reminder->image_path ? asset('storage/reminder-images/' . $reminder->image_path) : asset('storage/reminder-images/schedule-reminder.png')); ?>"
                                alt="<?php echo e($reminder->title); ?>"
                            >
                        </div>

                        <!-- Content Section -->
                        <div class="flex-1 flex flex-row justify-between">
                            <div>
                                <h2 class="text-xl font-bold text-gray-800 mb-3"><?php echo e($reminder->title); ?></h2>

                                <div class="flex items-start text-gray-600 mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 flex-shrink-0"
                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="break-words"><?php echo e($reminder->formatted_date_time); ?></span>
                                </div>

                                <div class="flex items-start text-gray-600 mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5 flex-shrink-0"
                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    <span class="capitalize"><?php echo e($reminder->location); ?></span>
                                </div>
                                <div class="flex space-x-2 items-center">
                                    <!--[if BLOCK]><![endif]--><?php if($reminder->recipient_type == 'public'): ?>
                                        <span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_3675_3584)">
                                        <path
                                            d="M7.99998 14.6663C11.6819 14.6663 14.6666 11.6816 14.6666 7.99967C14.6666 4.31778 11.6819 1.33301 7.99998 1.33301C4.31808 1.33301 1.33331 4.31778 1.33331 7.99967C1.33331 11.6816 4.31808 14.6663 7.99998 14.6663Z"
                                            stroke="#64748B" stroke-width="1.25" stroke-linecap="round"
                                            stroke-linejoin="round"/>
                                        <path d="M1.33331 8H14.6666" stroke="#64748B" stroke-width="1.25"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                        <path
                                            d="M7.99998 1.33301C9.6675 3.15858 10.6151 5.5277 10.6666 7.99967C10.6151 10.4717 9.6675 12.8408 7.99998 14.6663C6.33246 12.8408 5.38481 10.4717 5.33331 7.99967C5.38481 5.5277 6.33246 3.15858 7.99998 1.33301Z"
                                            stroke="#64748B" stroke-width="1.25" stroke-linecap="round"
                                            stroke-linejoin="round"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_3675_3584">
                                        <rect width="16" height="16" fill="white"/>
                                        </clipPath>
                                        </defs>
                                        </svg>

                                </span>

                                    <?php elseif($reminder->recipient_type == 'private'): ?>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2 12C2 13.3261 2.52678 14.5979 3.46447 15.5355C4.40215 16.4732 5.67392 17 7 17C8.84771 17.0688 10.6145 17.7756 12 19C13.3855 17.7756 15.1523 17.0688 17 17C18.3261 17 19.5979 16.4732 20.5355 15.5355C21.4732 14.5979 22 13.3261 22 12V7H17C15.1523 7.06882 13.3855 7.77556 12 9C10.6145 7.77556 8.84771 7.06882 7 7H2V12Z"
                                                stroke="#020617" stroke-width="1.25" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                            <path d="M6 11C7.5 11 9 11.5 9 13C7 13 6 13 6 11Z" stroke="#020617"
                                                  stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M18 11C16.5 11 15 11.5 15 13C17 13 18 13 18 11Z" stroke="#020617"
                                                  stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>

                                    <?php else: ?>
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.3334 12.0003C11.3334 11.6467 11.1929 11.3076 10.9428 11.0575C10.6928 10.8075 10.3536 10.667 10 10.667H6.00002C5.6464 10.667 5.30726 10.8075 5.05721 11.0575C4.80716 11.3076 4.66669 11.6467 4.66669 12.0003"
                                                stroke="#64748B" stroke-width="1.25" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                            <path
                                                d="M12.6667 2.66699H3.33333C2.59695 2.66699 2 3.26395 2 4.00033V13.3337C2 14.07 2.59695 14.667 3.33333 14.667H12.6667C13.403 14.667 14 14.07 14 13.3337V4.00033C14 3.26395 13.403 2.66699 12.6667 2.66699Z"
                                                stroke="#64748B" stroke-width="1.25" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                            <path
                                                d="M8.00002 7.99967C8.7364 7.99967 9.33335 7.40272 9.33335 6.66634C9.33335 5.92996 8.7364 5.33301 8.00002 5.33301C7.26364 5.33301 6.66669 5.92996 6.66669 6.66634C6.66669 7.40272 7.26364 7.99967 8.00002 7.99967Z"
                                                stroke="#64748B" stroke-width="1.25" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                            <path d="M5.33331 1.33301V2.66634" stroke="#64748B" stroke-width="1.25"
                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M10.6667 1.33301V2.66634" stroke="#64748B" stroke-width="1.25"
                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>

                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    <p class="text-gray-600 capitalize"><?php echo e($reminder->recipient_type); ?></p>
                                </div>

                            </div>
                            <div class="flex justify-center items-center">
                                <div>
                                    <!-- Using Livewire Navigate for SPA-like navigation -->
                                    <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['class' => 'bg-[#F1F5F9] !text-black hover:!text-white','wire:navigate' => true,'href' => ''.e(route('manage.reminder', ['reminder' => $reminder->id])).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'bg-[#F1F5F9] !text-black hover:!text-white','wire:navigate' => true,'href' => ''.e(route('manage.reminder', ['reminder' => $reminder->id])).'']); ?>
                                        Manage Reminder
                                        <span class="ml-2">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 13.333H14" stroke="#020617" stroke-width="1.25"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                                <path
                                                    d="M11 2.33316C11.2652 2.06794 11.6249 1.91895 12 1.91895C12.1857 1.91895 12.3696 1.95553 12.5412 2.0266C12.7128 2.09767 12.8687 2.20184 13 2.33316C13.1313 2.46448 13.2355 2.62038 13.3066 2.79196C13.3776 2.96354 13.4142 3.14744 13.4142 3.33316C13.4142 3.51888 13.3776 3.70277 13.3066 3.87436C13.2355 4.04594 13.1313 4.20184 13 4.33316L4.66667 12.6665L2 13.3332L2.66667 10.6665L11 2.33316Z"
                                                    stroke="#020617" stroke-width="1.25" stroke-linecap="round"
                                                    stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->

                <!--[if BLOCK]><![endif]--><?php if($reminders->isEmpty()): ?>
                    <div class="bg-white rounded-lg shadow p-8 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-4" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002 2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-700 mb-1">No Scheduled Events/Reminders Yet</h3>
                        <p class="text-gray-500">Create your first reminder to get started</p>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
            <div class="mt-4">
                <?php echo e($reminders->links('ark.components.pagination.tailwind-pagination')); ?>

            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\ARK\resources\views/livewire/reminder/reminder-index.blade.php ENDPATH**/ ?>