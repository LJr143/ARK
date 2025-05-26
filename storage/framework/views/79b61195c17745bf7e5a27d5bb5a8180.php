<div class="border-b border-gray-200 pb-4 mb-4 last:border-b-0 last:pb-0 last:mb-0">
    <h3 class="font-semibold text-lg"><?php echo e($reminder->title); ?></h3>

    <div class="text-gray-600 mt-1">
        <?php echo e($reminder->formatted_date); ?>

        <?php if($reminder->formatted_time): ?>
            • <?php echo e($reminder->formatted_time); ?>

        <?php endif; ?>
    </div>

    <?php if($reminder->location): ?>
        <div class="text-gray-600"><?php echo e($reminder->location); ?></div>
    <?php endif; ?>

    <div class="text-gray-600 mt-1">
        <?php if($reminder->recipient_type === 'public'): ?>
            <i class="fas fa-thumbs-up text-green-500"></i> Public — Sent to all
        <?php else: ?>
            <i class="fas fa-map-marker-alt text-blue-500"></i> Custom Recipients
        <?php endif; ?>
    </div>

    <div class="mt-3 flex justify-end">
        <a href="<?php echo e(route('reminders.edit', $reminder)); ?>" class="text-blue-500 hover:text-blue-700 mr-3">
            <i class="fas fa-edit"></i> Manage Reminder
        </a>
        <form action="<?php echo e(route('reminders.destroy', $reminder)); ?>" method="POST" class="inline">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="text-red-500 hover:text-red-700">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    </div>
</div>
<?php /**PATH C:\laragon\www\ARK\resources\views/ark/admin/reminders/partials/reminder-card.blade.php ENDPATH**/ ?>