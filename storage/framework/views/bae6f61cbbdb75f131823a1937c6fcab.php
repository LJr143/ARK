<?php $__env->startComponent('mail::message'); ?>
    # Welcome to UAP, <?php echo new \Illuminate\Support\EncodedHtmlString($user->first_name); ?>!

    Your membership application has been approved.

    **Email:** <?php echo new \Illuminate\Support\EncodedHtmlString($user->email); ?>

    **Password:** <?php echo new \Illuminate\Support\EncodedHtmlString($password); ?>


    <?php $__env->startComponent('mail::button', ['url' => route('login')]); ?>
        Login Now
    <?php echo $__env->renderComponent(); ?>

    Please change your password after first login.

    Thanks,
    <?php echo new \Illuminate\Support\EncodedHtmlString(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\laragon\www\ARK\resources\views/emails/membership/credentials.blade.php ENDPATH**/ ?>