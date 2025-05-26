<div class="bg-white rounded-lg shadow-md p-6">
    <form method="POST" action="<?php echo e(isset($reminder) ? route('reminders.update', $reminder) : route('reminders.store')); ?>">
        <?php echo csrf_field(); ?>
        <?php if(isset($reminder)): ?>
            <?php echo method_field('PUT'); ?>
        <?php endif; ?>

        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
            <input type="text" name="title" id="title" value="<?php echo e(old('title', $reminder->title ?? '')); ?>"
                   class="w-full px-3 py-2 border rounded-md" required>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="start_datetime" class="block text-gray-700 font-medium mb-2">Start Date/Time</label>
                <input type="datetime-local" name="start_datetime" id="start_datetime"
                       value="<?php echo e(old('start_datetime', isset($reminder) ? $reminder->start_datetime->format('Y-m-d\TH:i') : '')); ?>"
                       class="w-full px-3 py-2 border rounded-md" required>
            </div>
            <div>
                <label for="end_datetime" class="block text-gray-700 font-medium mb-2">End Date/Time (optional)</label>
                <input type="datetime-local" name="end_datetime" id="end_datetime"
                       value="<?php echo e(old('end_datetime', isset($reminder) && $reminder->end_datetime ? $reminder->end_datetime->format('Y-m-d\TH:i') : '')); ?>"
                       class="w-full px-3 py-2 border rounded-md">
            </div>
        </div>

        <div class="mb-4">
            <label for="location" class="block text-gray-700 font-medium mb-2">Location (optional)</label>
            <input type="text" name="location" id="location" value="<?php echo e(old('location', $reminder->location ?? '')); ?>"
                   class="w-full px-3 py-2 border rounded-md">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Recipient Type</label>
            <div class="flex items-center space-x-4">
                <label class="inline-flex items-center">
                    <input type="radio" name="recipient_type" value="public"
                           <?php echo e(old('recipient_type', $reminder->recipient_type ?? 'public') === 'public' ? 'checked' : ''); ?>

                           class="form-radio text-blue-500">
                    <span class="ml-2">Public (all users)</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="recipient_type" value="custom"
                           <?php echo e(old('recipient_type', $reminder->recipient_type ?? '') === 'custom' ? 'checked' : ''); ?>

                           class="form-radio text-blue-500">
                    <span class="ml-2">Custom Recipients</span>
                </label>
            </div>
        </div>

        <?php if(isset($reminder) && $reminder->recipient_type === 'custom' || old('recipient_type') === 'custom'): ?>
            <div class="mb-4" id="custom-recipients">
                <label class="block text-gray-700 font-medium mb-2">Select Recipients</label>
                <select name="recipients[]" multiple class="w-full px-3 py-2 border rounded-md h-auto">
                    <?php $__currentLoopData = App\Models\User::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->id); ?>"
                            <?php echo e(in_array($user->id, old('recipients', $reminder->recipients->pluck('id')->toArray() ?? [])) ? 'selected' : ''); ?>>
                            <?php echo e($user->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        <?php endif; ?>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-medium mb-2">Description (optional)</label>
            <textarea name="description" id="description" rows="3"
                      class="w-full px-3 py-2 border rounded-md"><?php echo e(old('description', $reminder->description ?? '')); ?></textarea>
        </div>

        <?php if(isset($reminder)): ?>
            <div class="mb-4">
                <label for="status" class="block text-gray-700 font-medium mb-2">Status</label>
                <select name="status" id="status" class="w-full px-3 py-2 border rounded-md">
                    <option value="upcoming" <?php echo e($reminder->status === 'upcoming' ? 'selected' : ''); ?>>Upcoming</option>
                    <option value="ended" <?php echo e($reminder->status === 'ended' ? 'selected' : ''); ?>>Ended</option>
                    <option value="archived" <?php echo e($reminder->status === 'archived' ? 'selected' : ''); ?>>Archived</option>
                </select>
            </div>
        <?php endif; ?>

        <div class="flex justify-end">
            <a href="<?php echo e(route('reminders.index')); ?>" class="px-4 py-2 border rounded-md mr-2">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                <?php echo e(isset($reminder) ? 'Update' : 'Create'); ?> Reminder
            </button>
        </div>
    </form>
</div>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const recipientTypeRadios = document.querySelectorAll('input[name="recipient_type"]');
            const customRecipientsDiv = document.getElementById('custom-recipients');

            function toggleCustomRecipients() {
                const isCustom = document.querySelector('input[name="recipient_type"]:checked').value === 'custom';
                if (customRecipientsDiv) {
                    customRecipientsDiv.style.display = isCustom ? 'block' : 'none';
                }
            }

            recipientTypeRadios.forEach(radio => {
                radio.addEventListener('change', toggleCustomRecipients);
            });

            toggleCustomRecipients();
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\ARK\resources\views/ark/admin/reminders/form.blade.php ENDPATH**/ ?>