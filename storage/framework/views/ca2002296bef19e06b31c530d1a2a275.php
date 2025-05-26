<div id="laravel-notify">
    <?php if(session()->has('notify.message')): ?>

        <?php echo $__env->make('notify::notifications.toast', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php echo $__env->make('notify::notifications.smiley', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php echo $__env->make('notify::notifications.drakify', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php echo $__env->make('notify::notifications.connectify', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <?php echo $__env->make('notify::notifications.emotify', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php endif; ?>

    <?php echo e(session()->forget('notify.message')); ?>


    <script>
        var notify = {
            timeout: "<?php echo e(config('notify.timeout')); ?>",
        }
    </script>
</div>
<?php /**PATH C:\laragon\www\ARK\vendor\mckenziearts\laravel-notify\src/../resources/views/components/notify.blade.php ENDPATH**/ ?>