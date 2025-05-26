<div class="flex items-center justify-between px-4 py-3 bg-white rounded-lg">
    <!-- Results Info -->
    <div class="text-sm text-gray-600">
        Showing <span class="font-medium"><?php echo e($paginator->firstItem()); ?>-<?php echo e($paginator->lastItem()); ?></span> of <span class="font-medium"><?php echo e($paginator->total()); ?></span> members
    </div>

    <!-- Pagination Controls -->
    <div class="flex items-center space-x-2">
        <!-- Previous Button -->
        <!--[if BLOCK]><![endif]--><?php if($paginator->onFirstPage()): ?>
            <span class="px-3 py-1 text-sm text-gray-400 cursor-not-allowed">
                &lt; Previous
            </span>
        <?php else: ?>
            <button wire:click="previousPage" class="px-3 py-1 text-sm text-gray-600 hover:text-gray-800">
                &lt; Previous
            </button>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        <!-- Page Numbers -->
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <!--[if BLOCK]><![endif]--><?php if(is_string($element)): ?>
                <span class="px-1 text-sm text-gray-600">...</span>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

            <!--[if BLOCK]><![endif]--><?php if(is_array($element)): ?>
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!--[if BLOCK]><![endif]--><?php if($page == $paginator->currentPage()): ?>
                        <span class="px-3 py-1 text-sm font-medium text-white bg-blue-600 rounded">
                            <?php echo e($page); ?>

                        </span>
                    <?php else: ?>
                        <button wire:click="gotoPage(<?php echo e($page); ?>)" class="px-3 py-1 text-sm text-gray-600 hover:text-gray-800">
                            <?php echo e($page); ?>

                        </button>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->

        <!-- Next Button -->
        <!--[if BLOCK]><![endif]--><?php if($paginator->hasMorePages()): ?>
            <button wire:click="nextPage" class="px-3 py-1 text-sm text-gray-600 hover:text-gray-800">
                Next &gt;
            </button>
        <?php else: ?>
            <span class="px-3 py-1 text-sm text-gray-400 cursor-not-allowed">
                Next &gt;
            </span>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </div>
</div>
<?php /**PATH C:\laragon\www\ARK\resources\views/ark/components/pagination/tailwind-pagination.blade.php ENDPATH**/ ?>