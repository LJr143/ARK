<div>
    <!--[if BLOCK]><![endif]--><?php if(auth()->user()?->force_password_change): ?>
        <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50">
            <div class="bg-white p-6 rounded shadow w-full max-w-md">
                <h2 class="text-xl font-semibold mb-4">Change Your Password</h2>

                <form wire:submit.prevent="updatePassword">
                    <div class="mb-4">
                        <label class="block">New Password</label>
                        <input type="password" wire:model.defer="newPassword" class="w-full border p-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block">Confirm Password</label>
                        <input type="password" wire:model.defer="newPassword_confirmation" class="w-full border p-2 rounded" required>
                    </div>

                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['newPassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

                    <div class="text-right">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH C:\laragon\www\ARK\resources\views/livewire/force-password-change-modal.blade.php ENDPATH**/ ?>