<!-- Date Range Picker -->
<div class="mb-8">
    <?php if (isset($component)) { $__componentOriginald8ba2b4c22a13c55321e34443c386276 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald8ba2b4c22a13c55321e34443c386276 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.label','data' => ['value' => 'Select Date Range','class' => 'block mb-2 text-sm font-medium text-gray-700']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => 'Select Date Range','class' => 'block mb-2 text-sm font-medium text-gray-700']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald8ba2b4c22a13c55321e34443c386276)): ?>
<?php $attributes = $__attributesOriginald8ba2b4c22a13c55321e34443c386276; ?>
<?php unset($__attributesOriginald8ba2b4c22a13c55321e34443c386276); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald8ba2b4c22a13c55321e34443c386276)): ?>
<?php $component = $__componentOriginald8ba2b4c22a13c55321e34443c386276; ?>
<?php unset($__componentOriginald8ba2b4c22a13c55321e34443c386276); ?>
<?php endif; ?>

    <div class="flex flex-col md:flex-row gap-4">
        <!-- Month Navigation -->
        <div class="flex items-center justify-between mb-2">
            <button wire:click="previousMonth" class="p-1 rounded-full hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <h3 class="text-lg font-medium text-gray-900"><?php echo e($currentMonth->format('F Y')); ?></h3>
            <button wire:click="nextMonth" class="p-1 rounded-full hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <!-- Dual Month Calendar -->
        <div class="flex flex-col md:flex-row gap-8">
            <!-- First Month -->
            <div class="w-full md:w-64">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-700"><?php echo e($firstMonth->format('F Y')); ?></span>
                </div>
                <div class="grid grid-cols-7 gap-1 text-xs text-center text-gray-500 mb-1">
                    <div>Su</div>
                    <div>Mo</div>
                    <div>Tu</div>
                    <div>We</div>
                    <div>Th</div>
                    <div>Fr</div>
                    <div>Sa</div>
                </div>
                <div class="grid grid-cols-7 gap-1">
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $firstMonthDays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                            'py-1 text-center text-sm rounded-full',
                                            'text-gray-400' => !$day['isCurrentMonth'],
                                            'bg-blue-100 text-blue-600' => $day['isSelected'],
                                            'hover:bg-gray-100 cursor-pointer' => $day['isCurrentMonth'],
                                        ]); ?>"
                             wire:click="selectDate('<?php echo e($day['date']->format('Y-m-d')); ?>')">
                            <?php echo e($day['date']->format('j')); ?>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            </div>

            <!-- Second Month -->
            <div class="w-full md:w-64">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-700"><?php echo e($secondMonth->format('F Y')); ?></span>
                </div>
                <div class="grid grid-cols-7 gap-1 text-xs text-center text-gray-500 mb-1">
                    <div>Su</div>
                    <div>Mo</div>
                    <div>Tu</div>
                    <div>We</div>
                    <div>Th</div>
                    <div>Fr</div>
                    <div>Sa</div>
                </div>
                <div class="grid grid-cols-7 gap-1">
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $secondMonthDays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                            'py-1 text-center text-sm rounded-full',
                                            'text-gray-400' => !$day['isCurrentMonth'],
                                            'bg-blue-100 text-blue-600' => $day['isSelected'],
                                            'hover:bg-gray-100 cursor-pointer' => $day['isCurrentMonth'],
                                        ]); ?>"
                             wire:click="selectDate('<?php echo e($day['date']->format('Y-m-d')); ?>')">
                            <?php echo e($day['date']->format('j')); ?>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            </div>
        </div>
    </div>

    <!-- Selected Date Range Display -->
    <div class="mt-4 flex items-center gap-2">
        <span class="text-sm text-gray-600">Selected:</span>
        <span class="text-sm font-medium">
                            <!--[if BLOCK]><![endif]--><?php if($startDate && $endDate): ?>
                <?php echo e($startDate->format('M j, Y')); ?> - <?php echo e($endDate->format('M j, Y')); ?>

            <?php else: ?>
                No date range selected
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </span>
        <!--[if BLOCK]><![endif]--><?php if($startDate || $endDate): ?>
            <button wire:click="clearSelection" class="text-sm text-red-500 hover:text-red-700">
                Clear
            </button>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>
</div>
<?php /**PATH C:\laragon\www\ARK\resources\views/livewire/date-picker/date-range-picker.blade.php ENDPATH**/ ?>