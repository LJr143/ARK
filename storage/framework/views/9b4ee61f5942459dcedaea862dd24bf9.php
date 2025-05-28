<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['mainClass' => '', 'bodyClass' => '', 'headerClass' => '','page_title' => ' ']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['mainClass' => '', 'bodyClass' => '', 'headerClass' => '','page_title' => ' ']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=Poppins:400,500,600&display=swap" rel="stylesheet"/>
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
              integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
              crossorigin="anonymous"
              referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.44.0/apexcharts.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>


        <!-- Styles -->
        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    </head>
    <body class="font-poppins antialiased">
    <?php if (isset($component)) { $__componentOriginalff9615640ecc9fe720b9f7641382872b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalff9615640ecc9fe720b9f7641382872b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.banner','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalff9615640ecc9fe720b9f7641382872b)): ?>
<?php $attributes = $__attributesOriginalff9615640ecc9fe720b9f7641382872b; ?>
<?php unset($__attributesOriginalff9615640ecc9fe720b9f7641382872b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalff9615640ecc9fe720b9f7641382872b)): ?>
<?php $component = $__componentOriginalff9615640ecc9fe720b9f7641382872b; ?>
<?php unset($__componentOriginalff9615640ecc9fe720b9f7641382872b); ?>
<?php endif; ?>

    <!-- Main Layout Container -->
    <div class="min-h-screen bg-[#F7F7F9] flex flex-col" id="main-content">
        <!-- Navigation Menu -->
        

        <!-- Main Content Area -->
        <div class="flex flex-1">
            <!-- Sidebar (Conditional) -->
            <?php if(isset($sidebar)): ?>
                <aside class="hidden lg:block w-[280px] bg-white shadow-lg z-20 fixed left-0 top-0 h-screen overflow-y-auto">
                    <?php echo e($sidebar); ?>

                </aside>
            <?php endif; ?>

            <!-- Primary Content Section -->
            <div class="flex-1 flex flex-col <?php if(isset($sidebar)): ?> lg:ml-[280px] <?php endif; ?>">
                <!-- Page Header (Conditional) -->
                <?php if(isset($header)): ?>
                    <header class="bg-white shadow-sm fixed top-0 <?php if(isset($sidebar)): ?> left-0 lg:left-[280px] <?php else: ?> left-0 <?php endif; ?> right-0 z-30">
                        <div class="w-full mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            <?php echo e($header); ?>

                        </div>
                        <?php if (isset($component)) { $__componentOriginal58ef761b4a8d895ed279bb45cfc348ea = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal58ef761b4a8d895ed279bb45cfc348ea = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'notify::components.notify','data' => ['class' => 'z-50 fixed top-4 right-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('notify::notify'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'z-50 fixed top-4 right-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal58ef761b4a8d895ed279bb45cfc348ea)): ?>
<?php $attributes = $__attributesOriginal58ef761b4a8d895ed279bb45cfc348ea; ?>
<?php unset($__attributesOriginal58ef761b4a8d895ed279bb45cfc348ea); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal58ef761b4a8d895ed279bb45cfc348ea)): ?>
<?php $component = $__componentOriginal58ef761b4a8d895ed279bb45cfc348ea; ?>
<?php unset($__componentOriginal58ef761b4a8d895ed279bb45cfc348ea); ?>
<?php endif; ?>
                    </header>
                <?php endif; ?>

                <!-- Main Page Content -->
                <main class="flex-1 <?php if(isset($header)): ?> pt-[100px] <?php endif; ?>">
                    <?php echo e($slot); ?>

                </main>
            </div>
        </div>
    </div>

    <?php echo $__env->yieldPushContent('modals'); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

    <?php echo notifyJs(); ?>
    </body>
</html>
<?php /**PATH C:\laragon\www\ARK\resources\views/layouts/app.blade.php ENDPATH**/ ?>