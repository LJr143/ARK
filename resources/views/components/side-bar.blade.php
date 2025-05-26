<div class="fixed lg:relative h-full bg-white z-50 transition-all duration-300 ease-in-out"
     :class="{'w-64': sidebarOpen, 'w-20': !sidebarOpen}">

    <!-- Logo and Chapter Name -->
    <div class="px-2 py-6 flex items-center justify-center lg:justify-start">
        <div class="flex py-2 px-2">
            <img class="h-[45px] mr-2" src="{{ asset('storage/logo/UAP-Fort-Bonifacio-Chapter-Logo 1.png') }}"
                 alt="uap-fort-bonifacio-Chapter-logo"/>
            <div class="text-left lg:block hidden">
                <p class="font-semibold text-[11px]">United Architects of the Philippines</p>
                <p class="font-semibold text-[11px]">Fort-Bonifacio Chapter</p>
            </div>
        </div>
    </div>

    <!-- Mobile Toggle Button (visible on mobile) -->
    <button class="lg:hidden absolute top-4 right-4 p-2 rounded-md hover:bg-gray-100">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <!-- Navigation Links -->
    <nav class="px-2">
        <ul class="space-y-2">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 rounded-lg transition-colors
                   {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-black' : 'text-gray-600 hover:bg-[#F1F5F9]' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-blue-600' : 'text-gray-500' }}" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 6.49967L8 1.83301L14 6.49967V13.833C14 14.1866 13.8595 14.5258 13.6095 14.7758C13.3594 15.0259 13.0203 15.1663 12.6667 15.1663H3.33333C2.97971 15.1663 2.64057 15.0259 2.39052 14.7758C2.14048 14.5258 2 14.1866 2 13.833V6.49967Z" stroke="#020617" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6 15.1667V8.5H10V15.1667" stroke="#020617" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>


                    <span class="ml-3 lg:block hidden">Dashboard</span>
                </a>
            </li>

            <!-- Reminders -->
            <li>
                <a href="{{ route('reminders.index') }}" class="flex items-center p-3 rounded-lg transition-colors
                   {{ request()->routeIs('reminders.index') ||  request()->routeIs('manage.reminder') ? 'bg-blue-50 text-black' : 'text-gray-600 hover:bg-[#F1F5F9]' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('reminders.index') ||  request()->routeIs('manage.reminder') ? 'bg-blue-50 text-black' : 'text-gray-600 hover:bg-[#F1F5F9]' }}" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 5.83301C12 4.77214 11.5786 3.75473 10.8284 3.00458C10.0783 2.25444 9.06087 1.83301 8 1.83301C6.93913 1.83301 5.92172 2.25444 5.17157 3.00458C4.42143 3.75473 4 4.77214 4 5.83301C4 10.4997 2 11.833 2 11.833H14C14 11.833 12 10.4997 12 5.83301Z" stroke="#64748B" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9.15335 14.5C9.03614 14.7021 8.86791 14.8698 8.6655 14.9864C8.46309 15.1029 8.2336 15.1643 8.00001 15.1643C7.76643 15.1643 7.53694 15.1029 7.33453 14.9864C7.13212 14.8698 6.96389 14.7021 6.84668 14.5" stroke="#64748B" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M1.33337 5.83301C1.33337 4.36634 1.80004 2.96634 2.66671 1.83301" stroke="#64748B" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14.6667 5.83301C14.6667 4.39054 14.1989 2.98698 13.3334 1.83301" stroke="#64748B" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="ml-3 lg:block hidden">Reminders</span>
                </a>
            </li>

            <!-- Members -->
            <li>
                <a href="#" class="flex items-center p-3 rounded-lg transition-colors
                   {{ request()->routeIs('members*') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 {{ request()->is('members*') ? 'text-blue-600' : 'text-gray-500' }}"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="ml-3 lg:block hidden">Members</span>
                </a>
            </li>

            <!-- Reports -->
            <li>
                <a href="#" class="flex items-center p-3 rounded-lg transition-colors
                   {{ request()->is('reports*') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 {{ request()->is('reports*') ? 'text-blue-600' : 'text-gray-500' }}"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span class="ml-3 lg:block hidden">Reports</span>
                </a>
            </li>

            <!-- Settings -->
            <li>
                <a href="#" class="flex items-center p-3 rounded-lg transition-colors
                   {{ request()->is('settings*') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 {{ request()->is('settings*') ? 'text-blue-600' : 'text-gray-500' }}"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="ml-3 lg:block hidden">Settings</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
