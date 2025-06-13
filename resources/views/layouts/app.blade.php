@props(['mainClass' => '', 'bodyClass' => '', 'headerClass' => '','page_title' => ' '])
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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
    @vite(['resources/css/app.css', 'resources/js/app.js'])

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

    @livewireStyles
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
<x-banner/>

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
        @if(isset($sidebar))
            <aside
                class="fixed inset-y-0 left-0 lg:relative min-h-full bg-white z-50 max-w-[290px] sidebar-shadow transition-all duration-300 ease-in-out transform"
                :class="{
                    'w-72 translate-x-0': sidebarOpen,
                    '-translate-x-full w-20 lg:translate-x-0 lg:w-20': !sidebarOpen,
                    'lg:w-72': sidebarOpen
                }">
                {{ $sidebar }}
            </aside>
        @endif

        <!-- Primary Content Section -->
        <div class="flex-1 flex flex-col main-content-transition scrollable-main-content"
             :class="{
                 'lg:ml-72': sidebarOpen && typeof $sidebar !== 'undefined',
                 'lg:ml-20': !sidebarOpen && typeof $sidebar !== 'undefined'
             }">

            <!-- Page Header (Conditional) -->
            @if(isset($header))
                <header class="bg-white shadow-sm sticky top-0 z-30 border-b border-gray-100">
                    <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8 py-4">
                        <!-- Mobile menu button (when sidebar exists) -->
                        @if(isset($sidebar))
                            <button @click="sidebarOpen = !sidebarOpen"
                                    class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 6h16M4 12h16M4 18h16"/>
                                </svg>
                            </button>
                        @endif

                        <!-- Header Content -->
                        <div class="flex-1">
                            {{ $header }}
                        </div>
                    </div>
                    <x-notify::notify class="z-50 fixed top-4 right-4"/>
                </header>
            @endif

            <!-- Main Page Content -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                {{ $slot }}
            </main>
        </div>
    </div>
</div>

@stack('modals')
@livewireScripts
@notifyJs
</body>
</html>
