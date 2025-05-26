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
              referrerpolicy="no-referrer" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])


        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-poppins antialiased">
    <x-banner />

    <!-- Main Layout Container -->
    <div class="min-h-screen bg-[#F7F7F9] flex flex-col" id="main-content">
        <!-- Navigation Menu -->
        {{--        @livewire('navigation-menu')--}}

        <!-- Main Content Area -->
        <div class="flex flex-1">
            <!-- Sidebar (Conditional) -->
            @if(isset($sidebar))
                <aside class="hidden lg:block w-[280px] bg-white shadow-lg z-20 fixed left-0 top-0 h-screen overflow-y-auto">
                    {{ $sidebar }}
                </aside>
            @endif

            <!-- Primary Content Section -->
            <div class="flex-1 flex flex-col @if(isset($sidebar)) lg:ml-[280px] @endif">
                <!-- Page Header (Conditional) -->
                @if(isset($header))
                    <header class="bg-white shadow-sm fixed top-0 @if(isset($sidebar)) left-0 lg:left-[280px] @else left-0 @endif right-0 z-30">
                        <div class="w-full mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Main Page Content -->
                <main class="flex-1 @if(isset($header)) pt-[100px] @endif">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>

    @stack('modals')
    @livewireScripts
    <x-notify::notify />
    @notifyJs
    </body>
</html>
