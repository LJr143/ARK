<div>
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="relative overflow-hidden bg-white rounded-3xl shadow-2xl mb-8 animate-fade-in-up">
            <div class="absolute inset-0 gradient-bg opacity-90"></div>
            <div
                class="absolute top-0 right-0 w-96 h-96 bg-white opacity-10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <div
                class="absolute bottom-0 left-0 w-72 h-72 bg-white opacity-5 rounded-full translate-y-1/2 -translate-x-1/2"></div>

            <div class="relative p-6 lg:p-8">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                    <div class="text-white animate-fade-in-left">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-3 bg-white bg-opacity-20 rounded-2xl backdrop-blur-sm animate-float">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h1 class="text-2xl lg:text-3xl font-bold">Reminders</h1>
                        </div>
                        <p class="text-white text-opacity-90 text-md max-w-2xl leading-relaxed">
                            Stay organized and never miss important tasks or events. Manage your reminders with style
                            and efficiency.
                        </p>
                    </div>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-reminder')): ?>
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
                    <?php endif; ?>

                </div>
            </div>
        </div>

        <!-- Search Section -->
        <div class="mb-8 animate-fade-in-up" style="animation-delay: 0.1s">
            <div
                class="bg-white bg-opacity-80 backdrop-blur-xl rounded-2xl p-6 shadow-xl border border-white border-opacity-20">
                <div class="flex flex-col md:flex-row gap-4 items-center">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input
                            type="text"
                            wire:model.live.debounce.300ms="search"
                            placeholder="Search reminders by title or date..."
                            class="w-full text-[12px] pl-12 pr-4 py-2 bg-white bg-opacity-50 backdrop-blur-sm rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-300 placeholder-gray-500"
                        >
                    </div>
                    <div class="flex items-center gap-6">
                        <span class="text-gray-600 text-[12px]">Show:</span>
                        <select wire:model.live="perPage"
                                class="bg-white bg-opacity-50 backdrop-blur-sm text-[12px] rounded-xl border border-gray-200 px-8 py-2 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-300">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="all">All</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="mb-8 animate-fade-in-up" style="animation-delay: 0.2s">
            <div
                class="bg-white bg-opacity-60 backdrop-blur-xl rounded-2xl p-2 shadow-xl border border-white border-opacity-20">
                <nav class="flex flex-wrap gap-2">
                    <button
                        wire:click="$set('filter', 'all_reminders')"
                        class="<?php echo e($filter === 'all_reminders' ? 'tab-active' : 'tab-inactive'); ?> px-6 py-3 rounded-xl font-semibold transition-all duration-300 flex items-center gap-2"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 11H5m14-4l-3 3.5a5 5 0 0 1-7 0L6 7m2 5h8"/>
                        </svg>
                        All Reminders
                        <span class="bg-white bg-opacity-30 px-2 py-1 rounded-full text-xs">
                         <?php echo e($reminders->count()); ?>

                    </span>
                    </button>
                    <button
                        wire:click="$set('filter', 'upcoming_reminders')"
                        class="<?php echo e($filter === 'upcoming_reminders' ? 'tab-active' : 'tab-inactive'); ?> px-6 py-3 rounded-xl font-semibold transition-all duration-300 flex items-center gap-2"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        Upcoming
                        <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded-full text-xs">
                       <?php echo e($reminders->where('status', 'upcoming')->count()); ?>

                    </span>
                    </button>
                    <button
                        wire:click="$set('filter', 'ended_reminders')"
                        class="<?php echo e($filter === 'ended_reminders' ? 'tab-active' : 'tab-inactive'); ?> px-6 py-3 rounded-xl font-semibold transition-all duration-300 flex items-center gap-2"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Ended
                        <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-full text-xs">
                            <?php echo e($reminders->where('status', 'ended')->count()); ?>

                    </span>
                    </button>
                    <button
                        wire:click="$set('filter', 'archived_reminders')"
                        class="<?php echo e($filter === 'archived_reminders' ? 'tab-active' : 'tab-inactive'); ?> px-6 py-3 rounded-xl font-semibold transition-all duration-300 flex items-center gap-2"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                        </svg>
                        Archived
                        <span class="bg-purple-100 text-purple-600 px-2 py-1 rounded-full text-xs">
                            <?php echo e($reminders->where('status', 'archived')->count()); ?>

                    </span>
                    </button>
                </nav>
            </div>
        </div>

        <!-- Content Area -->
        <div class="animate-fade-in-up" style="animation-delay: 0.4s">
            <!--[if BLOCK]><![endif]--><?php if($reminders->isNotEmpty()): ?>
                <div class="grid gap-4">
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $reminders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reminder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div
                            class="bg-white rounded-3xl h-2xl shadow-xl overflow-hidden card-hover border border-gray-100">
                            <div class="flex flex-col lg:flex-row">
                                <!-- Image Section -->
                                <div class="lg:w-80 h-[150px] lg:h-auto relative overflow-hidden">
                                    <?php
                                        $gradients = [
                                            'upcoming' => 'from-blue-400 to-purple-500',
                                            'ended' => 'from-gray-400 to-gray-500',
                                            'archived' => 'from-purple-400 to-pink-500',
                                        ];
                                        $gradient = $gradients[$reminder->status] ?? 'from-indigo-400 to-blue-500';
                                    ?>
                                    <div class="absolute inset-0 bg-gradient-to-br <?php echo e($gradient); ?>"></div>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div
                                            class="w-[35px] h-[35px] bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm animate-float">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white"
                                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="absolute top-4 left-4">
                                    <span class="status-badge status-<?php echo e($reminder->status); ?>">
                                        <?php echo e(ucfirst($reminder->status)); ?>

                                    </span>
                                    </div>
                                </div>

                                <!-- Content Section -->
                                <div class="flex-1 p-4">
                                    <div class="flex flex-col lg:flex-row justify-between h-full">
                                        <div class="flex-1">
                                            <h2 class="text-[18px] font-bold text-gray-800 mb-4 leading-tight">
                                                <?php echo e($reminder->title); ?>

                                            </h2>

                                            <div class="space-y-3 mb-2">
                                                <!--[if BLOCK]><![endif]--><?php if($reminder->start_datetime): ?>
                                                    <div class="flex items-center text-gray-600 group">
                                                        <div
                                                            class="w-8 h-8 bg-indigo-100 rounded-xl flex items-center justify-center mr-4 group-hover:bg-indigo-200 transition-colors">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                 class="h-5 w-5 text-indigo-600" fill="none"
                                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      stroke-width="2"
                                                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <p class="font-semibold text-[12px] capitalize">
                                                                <?php echo e(\Carbon\Carbon::parse($reminder->start_datetime)->format('F j, Y')); ?>

                                                                - <?php echo e($reminder->recipient_type); ?>

                                                            </p>
                                                            <p class="text-[11px] text-gray-500">
                                                                <?php echo e(\Carbon\Carbon::parse($reminder->start_datetime)->format('g:i A')); ?>

                                                                <!--[if BLOCK]><![endif]--><?php if($reminder->end_datetime): ?>
                                                                    - <?php echo e(\Carbon\Carbon::parse($reminder->end_datetime)->format('g:i A')); ?>

                                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                            </p>
                                                        </div>
                                                    </div>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                                <!--[if BLOCK]><![endif]--><?php if($reminder->location ?? false): ?>
                                                    <div class="flex items-center text-gray-600 group">
                                                        <div
                                                            class="w-8 h-8 bg-green-100 rounded-xl flex items-center justify-center mr-4 group-hover:bg-green-200 transition-colors">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                 class="h-5 w-5 text-green-600" fill="none"
                                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      stroke-width="2"
                                                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      stroke-width="2"
                                                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                            </svg>
                                                        </div>
                                                        <div>
                                                            <p class="font-semibold"><?php echo e($reminder->location); ?></p>
                                                            <p class="text-[11px] text-gray-500">Location</p>
                                                        </div>
                                                    </div>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                                <div class="flex items-center text-gray-600 group">
                                                    <div
                                                        class="w-8 h-8 bg-purple-100 rounded-xl flex items-center justify-center mr-4 group-hover:bg-purple-200 transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             class="h-5 w-5 text-purple-600" fill="none"
                                                             viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="font-semibold"><?php echo e(ucfirst($reminder->status)); ?>

                                                            Reminder</p>
                                                        <p class="text-[11px] text-gray-500">
                                                            Created <?php echo e(\Carbon\Carbon::parse($reminder->created_at)->diffForHumans()); ?>

                                                        </p>
                                                    </div>
                                                </div>

                                                <!--[if BLOCK]><![endif]--><?php if($reminder->description): ?>
                                                    <div class="mt-2 px-4 py-2 bg-gray-50 rounded-xl">
                                                        <p class="text-gray-700 text-[11px] leading-relaxed">
                                                            <?php echo e(Str::limit($reminder->description, 150)); ?>

                                                        </p>
                                                    </div>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            </div>
                                        </div>

                                        <div class="flex lg:flex-col gap-3 lg:ml-6">
                                            <button
                                                class="<?php echo e($reminder->status === 'ended' || $reminder->status === 'archived' ? 'bg-gradient-to-r from-gray-400 to-gray-500 opacity-75' : 'bg-gradient-to-r from-indigo-500 to-purple-600'); ?> text-white px-6 py-2 rounded-2xl font-semibold shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300 flex items-center justify-center gap-3 group"
                                                wire:navigate
                                                href="<?php echo e(route('manage.reminder', ['reminder' => $reminder->id])); ?>"
                                            >
                                                <!--[if BLOCK]><![endif]--><?php if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('superadmin') ): ?>
                                                    <span>Manage</span>
                                                <?php else: ?>
                                                    <span>View Reminder Details</span>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="h-5 w-5 group-hover:translate-x-1 transition-transform"
                                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </div>

                <!-- Pagination -->
                <!--[if BLOCK]><![endif]--><?php if($reminders instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
                    <div class="mt-8">
                        <?php echo e($reminders->links('ark.components.pagination.tailwind-pagination')); ?>

                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            <?php else: ?>
                <!-- Empty State -->
                <div class="bg-white rounded-3xl shadow-xl p-12 text-center">
                    <div class="max-w-md mx-auto">
                        <div
                            class="w-24 h-24 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-6 animate-pulse-glow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-600" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">
                            <!--[if BLOCK]><![endif]--><?php if($search): ?>
                                No reminders found for "<?php echo e($search); ?>"
                            <?php elseif($filter !== 'all_reminders'): ?>
                                No <?php echo e(str_replace('_', ' ', $filter)); ?> found
                            <?php else: ?>
                                No reminders found
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </h3>
                        <p class="text-gray-600 mb-8 leading-relaxed">
                            <!--[if BLOCK]><![endif]--><?php if($search): ?>
                                Try adjusting your search terms or clearing the search to see all reminders.
                            <?php elseif($filter !== 'all_reminders'): ?>
                                You don't have any <?php echo e(str_replace('_', ' ', $filter)); ?> at the moment.
                            <?php else: ?>
                                You haven't created any reminders yet. Get started by creating your first reminder and
                                stay organized!
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </p>
                        <!--[if BLOCK]><![endif]--><?php if($search): ?>
                            <button
                                wire:click="$set('search', '')"
                                class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-8 py-4 rounded-2xl font-semibold shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300 flex items-center justify-center gap-3 mx-auto group mb-4"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                <span>Clear Search</span>
                            </button>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        <button
                            class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-8 py-4 rounded-2xl font-semibold shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300 flex items-center justify-center gap-3 mx-auto group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 4v16m8-8H4"/>
                            </svg>
                            <span>Create Your First Reminder</span>
                        </button>
                    </div>
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\ARK\resources\views/livewire/reminder/reminder-index.blade.php ENDPATH**/ ?>