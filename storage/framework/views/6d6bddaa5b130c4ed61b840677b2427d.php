<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'ARK:Auto Reminder Kit')); ?></title>
    <link rel="shortcut icon" href="<?php echo e(asset('storage/logo/ark-logo-bg-none.ico')); ?>">

    <!-- Fonts -->
    <link rel="shortcut icon" href="<?php echo e(asset('storage/pmsAssets/icon_img.png')); ?>">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <!-- Styles -->
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>
<body class="custom-gradient">
<div class="w-full md:w-1/2 relative min-h-[600px] overflow-hidden">
    <!-- Background Image -->
    <img alt="Background image"
         class="absolute inset-0 w-full h-full object-cover opacity-30"
         src="<?php echo e(asset('storage/background-img/ark-login-bg.jpg')); ?>" />

    <!-- Logo Container (centered) -->
    <div class="absolute inset-0 flex top-20 justify-start z-20 px-8 py-4">
       <div class="flex flex-col px-12 gap-4">
           <img alt="ARK logo"
                class="w-48 h-48 md:w-80 md:h-64 object-contain"
                src="<?php echo e(asset('storage/background-img/ark-logo.png')); ?>"/>
           <img alt="ARK logo"
                class="w-50 h-50 md:w-100 mt-[-50px] md:h-64 object-contain"
                src="<?php echo e(asset('storage/background-img/ark-slogan.png')); ?>"/>
       </div>
    </div>
</div>

<div class="w-full md:w-1/2 flex items-center justify-center p-6 md:p-10">
    <div class="w-full max-w-md">
        <?php echo e($slot); ?>

    </div>
</div>



<?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>
</html>
<?php /**PATH C:\laragon\www\ARK\resources\views/layouts/guest.blade.php ENDPATH**/ ?>