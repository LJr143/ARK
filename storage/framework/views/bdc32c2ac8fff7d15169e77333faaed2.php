<div class="flex flex-col sm:flex-row items-center justify-between gap-3 px-3 sm:px-4 py-3 bg-white rounded-lg">
    <!-- Results Info -->
    <div class="text-xs sm:text-sm text-gray-600 whitespace-nowrap">
        Showing <span class="font-medium"><?php echo e($paginator->firstItem()); ?>-<?php echo e($paginator->lastItem()); ?></span>
        of <span class="font-medium"><?php echo e($paginator->total()); ?></span> members
    </div>

    <!-- Pagination Controls -->
    <div class="flex items-center space-x-1 sm:space-x-2">
        <!-- Previous Button -->
        <!--[if BLOCK]><![endif]--><?php if($paginator->onFirstPage()): ?>
            <span class="px-2 sm:px-3 py-1 text-xs sm:text-sm text-gray-400 cursor-not-allowed">
                <span class="hidden sm:inline">&lt; Previous</span>
                <span class="sm:hidden">&lt;</span>
            </span>
        <?php else: ?>
            <button wire:click="previousPage"
                    class="px-2 sm:px-3 py-1 text-xs sm:text-sm text-gray-600 hover:text-gray-800">
                <span class="hidden sm:inline">&lt; Previous</span>
                <span class="sm:hidden">&lt;</span>
            </button>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <!-- Page Numbers - Hidden on small screens if too many -->
        <div class="hidden sm:flex items-center space-x-1 sm:space-x-2">
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <!--[if BLOCK]><![endif]--><?php if(is_string($element)): ?>
                    <span class="px-1 text-xs sm:text-sm text-gray-600">...</span>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                <!--[if BLOCK]><![endif]--><?php if(is_array($element)): ?>
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!--[if BLOCK]><![endif]--><?php if($page == $paginator->currentPage()): ?>
                            <span
                                class="px-2 sm:px-3 py-1 text-xs sm:text-sm font-medium text-white bg-blue-600 rounded">
                                <?php echo e($page); ?>

                            </span>
                        <?php else: ?>
                            <button wire:click="gotoPage(<?php echo e($page); ?>)"
                                    class="px-2 sm:px-3 py-1 text-xs sm:text-sm text-gray-600 hover:text-gray-800">
                                <?php echo e($page); ?>

                            </button>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        </div>

        <!-- Mobile current page indicator -->
        <div class="sm:hidden px-2 py-1 text-xs font-medium text-white bg-blue-600 rounded">
            <?php echo e($paginator->currentPage()); ?>

        </div>

        <!-- Next Button -->
        <!--[if BLOCK]><![endif]--><?php if($paginator->hasMorePages()): ?>
            <button wire:click="nextPage"
                    class="px-2 sm:px-3 py-1 text-xs sm:text-sm text-gray-600 hover:text-gray-800">
                <span class="hidden sm:inline">Next &gt;</span>
                <span class="sm:hidden">&gt;</span>
            </button>
        <?php else: ?>
            <span class="px-2 sm:px-3 py-1 text-xs sm:text-sm text-gray-400 cursor-not-allowed">
                <span class="hidden sm:inline">Next &gt;</span>
                <span class="sm:hidden">&gt;</span>
            </span>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>
</div>
<?php /**PATH C:\laragon\www\ARK\resources\views/ark/components/pagination/tailwind-pagination.blade.php ENDPATH**/ ?>