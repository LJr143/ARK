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
          referrerpolicy="no-referrer"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.44.0/apexcharts.min.js"></script>

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <!-- Custom Styles for Sidebar -->
    <style>
        .logo-gradient {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }

        .nav-item-active {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-left: 4px solid #3b82f6;
        }

        .nav-item-hover:hover {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            transform: translateX(2px);
        }

        .sidebar-shadow {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1), 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .icon-active {
            filter: drop-shadow(0 2px 4px rgba(59, 130, 246, 0.3));
        }

        .mobile-overlay {
            backdrop-filter: blur(4px);
            background: rgba(0, 0, 0, 0.3);
        }

        .main-content-transition {
            transition: margin-left 300ms ease-in-out;
        }

        .scrollable-main-content {
            overflow-y: auto;
            height: calc(100vh - 3.5rem);
        }
    </style>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>
<body class="font-poppins antialiased"
      x-data="{
          sidebarOpen: $persist(window.innerWidth >= 1024)
      }"
      x-init="
          window.addEventListener('resize', () => {
              if (window.innerWidth >= 1024) {
                  sidebarOpen = true;
              } else {
                  sidebarOpen = false;
              }
          })
      ">
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
    <!-- Main Content Area -->
    <div class="flex flex-1">
        <!-- Mobile Overlay -->
        <div x-show="sidebarOpen && window.innerWidth < 1024"
             x-transition:enter="transition-opacity ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false"
             class="fixed inset-0 mobile-overlay lg:hidden z-40"
             style="display: none;">
        </div>

        <!-- Improved Sidebar -->
        <?php if(isset($sidebar)): ?>
            <aside
                class="fixed inset-y-0 left-0 lg:relative min-h-full bg-white z-50 max-w-[290px] sidebar-shadow transition-all duration-300 ease-in-out transform"
                :class="{
                    'w-72 translate-x-0': sidebarOpen,
                    '-translate-x-full w-20 lg:translate-x-0 lg:w-20': !sidebarOpen,
                    'lg:w-72': sidebarOpen
                }">
                <?php echo e($sidebar); ?>

            </aside>
        <?php endif; ?>

        <!-- Primary Content Section -->
        <div class="flex-1 flex flex-col main-content-transition scrollable-main-content"
             :class="{
                 'lg:ml-72': sidebarOpen && typeof $sidebar !== 'undefined',
                 'lg:ml-20': !sidebarOpen && typeof $sidebar !== 'undefined'
             }">

            <!-- Page Header (Conditional) -->
            <?php if(isset($header)): ?>
                <header class="bg-white shadow-sm sticky top-0 z-30 border-b border-gray-100">
                    <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8 py-4">
                        <!-- Mobile menu button (when sidebar exists) -->
                        <?php if(isset($sidebar)): ?>
                            <button @click="sidebarOpen = !sidebarOpen"
                                    class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 6h16M4 12h16M4 18h16"/>
                                </svg>
                            </button>
                        <?php endif; ?>

                        <!-- Header Content -->
                        <div class="flex-1">
                            <?php echo e($header); ?>

                        </div>
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
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
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