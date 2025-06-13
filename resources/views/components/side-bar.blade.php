<!-- Mobile Toggle Button -->
<button @click="sidebarOpen = !sidebarOpen"
        class="lg:hidden absolute top-4 right-4 p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200 z-50 group">
    <svg xmlns="http://www.w3.org/2000/svg"
         class="h-6 w-6 transition-transform duration-200 group-hover:scale-110"
         fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              :d="sidebarOpen ? 'M6 18L18 6M6 6l12 12' : 'M4 6h16M4 12h16M4 18h16'" d=""/>
    </svg>
</button>

<!-- Desktop Toggle Button -->
<button @click="sidebarOpen = !sidebarOpen"
        class="hidden lg:block absolute -right-3 top-8 bg-white border border-gray-200 rounded-full p-1.5 shadow-md hover:shadow-lg transition-all duration-200 group z-10">
    <svg xmlns="http://www.w3.org/2000/svg"
         class="h-4 w-4 transition-transform duration-200"
         :class="sidebarOpen ? 'rotate-180' : ''"
         fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
    </svg>
</button>

<!-- Logo and Chapter Name -->
<div class="px-4 py-6 border-b border-gray-100">
    <div class="flex items-center justify-center lg:justify-start">
        <div class="flex-shrink-0">
            <img class="h-12 w-12 rounded-xl object-cover"
                 src="{{ asset('storage/logo/UAP-Fort-Bonifacio-Chapter-Logo 1.png') }}"
                 alt="UAP Fort-Bonifacio Chapter Logo"
                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"/>
            <!-- Fallback logo -->
            <div class="h-12 w-12 rounded-xl logo-gradient items-center justify-center hidden">
                <span class="text-white font-bold text-sm">UAP</span>
            </div>
        </div>
        <div class="ml-3 transition-all duration-300 overflow-hidden"
             :class="{'lg:w-0 lg:opacity-0': !sidebarOpen, 'w-auto opacity-100': sidebarOpen}">
            <p class="font-bold text-[12px] text-gray-800 leading-tight">United Architects of the Philippines</p>
            <p class="font-semibold text-xs text-gray-600 leading-tight">Fort-Bonifacio Chapter</p>
        </div>
    </div>
</div>

<!-- Navigation Content -->
<nav class="px-3 py-4 flex-1 overflow-y-auto">
    <ul class="space-y-1">
        <!-- Dashboard -->
        <li>
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center p-3 rounded-xl transition-all duration-200 group
                                          {{ request()->routeIs('admin.dashboard') ? 'nav-item-active' : 'nav-item-hover' }}">
                <div class="flex-shrink-0">
                    <svg
                        class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-blue-600 icon-active' : 'text-gray-500 group-hover:text-gray-700' }}"
                        viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2 6.49967L8 1.83301L14 6.49967V13.833C14 14.1866 13.8595 14.5258 13.6095 14.7758C13.3594 15.0259 13.0203 15.1663 12.6667 15.1663H3.33333C2.97971 15.1663 2.64057 15.0259 2.39052 14.7758C2.14048 14.5258 2 14.1866 2 13.833V6.49967Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"/>
                        <path d="M6 15.1667V8.5H10V15.1667" stroke="currentColor" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <span class="ml-3 font-medium transition-all duration-300 overflow-hidden whitespace-nowrap
                                                 {{ request()->routeIs('admin.dashboard') ? 'text-gray-800' : 'text-gray-600 group-hover:text-gray-800' }}"
                      :class="{'lg:w-0 lg:opacity-0': !sidebarOpen, 'w-auto opacity-100': sidebarOpen}">Dashboard</span>
            </a>
        </li>

        <!-- Reminders -->
        <li>
            <a href="{{ route('reminders.index')  }}"
               class="flex items-center p-3 rounded-xl transition-all duration-200 group
                                          {{ request()->routeIs('reminders.*') || request()->routeIs('manage.reminder') ? 'nav-item-active' : 'nav-item-hover' }}">
                <div class="flex-shrink-0">
                    <svg
                        class="w-5 h-5 {{ request()->routeIs('reminders.*') || request()->routeIs('manage.reminder') ? 'text-blue-600 icon-active' : 'text-gray-500 group-hover:text-gray-700' }}"
                        viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 5.83301C12 4.77214 11.5786 3.75473 10.8284 3.00458C10.0783 2.25444 9.06087 1.83301 8 1.83301C6.93913 1.83301 5.92172 2.25444 5.17157 3.00458C4.42143 3.75473 4 4.77214 4 5.83301C4 10.4997 2 11.833 2 11.833H14C14 11.833 12 10.4997 12 5.83301Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"/>
                        <path
                            d="M9.15335 14.5C9.03614 14.7021 8.86791 14.8698 8.6655 14.9864C8.46309 15.1029 8.2336 15.1643 8.00001 15.1643C7.76643 15.1643 7.53694 15.1029 7.33453 14.9864C7.13212 14.8698 6.96389 14.7021 6.84668 14.5"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"/>
                    </svg>
                </div>
                <span class="ml-3 font-medium transition-all duration-300 overflow-hidden whitespace-nowrap
                                                 {{ request()->routeIs('reminders.*') || request()->routeIs('manage.reminder') ? 'text-gray-800' : 'text-gray-600 group-hover:text-gray-800' }}"
                      :class="{'lg:w-0 lg:opacity-0': !sidebarOpen, 'w-auto opacity-100': sidebarOpen}">Reminders</span>
            </a>
        </li>

        @if(auth()->user()->hasAnyRole(['admin', 'superadmin']))
            <!-- Section Divider -->
            <li class="py-2">
                <div class="border-t border-gray-200 transition-all duration-300"
                     :class="{'lg:opacity-0': !sidebarOpen, 'opacity-100': sidebarOpen}"></div>
            </li>

            <!-- Financial Section Header -->
            <li class="transition-all duration-300"
                :class="{'lg:opacity-0 lg:h-0 overflow-hidden': !sidebarOpen, 'opacity-100 h-auto': sidebarOpen}">
                <div class="px-3 py-2">
                    <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Financial</h3>
                </div>
            </li>

            <!-- Members -->
            <li>
                <a href="{{ route('members.index') }}"
                   class="flex items-center p-3 rounded-xl transition-all duration-200 group
                                          {{ request()->routeIs('members.index') ? 'nav-item-active' : 'nav-item-hover' }}">
                    <div class="flex-shrink-0">
                        <svg
                            class="w-5 h-5 {{ request()->routeIs('members.index') ? 'text-blue-600 icon-active' : 'text-gray-500 group-hover:text-gray-700' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <span class="ml-3 font-medium transition-all duration-300 overflow-hidden whitespace-nowrap
                                                 {{ request()->routeIs('members.index') ? 'text-gray-800' : 'text-gray-600 group-hover:text-gray-800' }}"
                          :class="{'lg:w-0 lg:opacity-0': !sidebarOpen, 'w-auto opacity-100': sidebarOpen}">Members</span>
                </a>
            </li>

            <!-- Payments -->
            <li>
                <a href="{{ route('admin.membership.payment') }}"
                   class="flex items-center p-3 rounded-xl transition-all duration-200 group
                 {{ request()->routeIs('admin.membership.payment') ? 'nav-item-active' : 'nav-item-hover' }}">
                    <div class="flex-shrink-0">
                        <svg
                            class="w-5 h-5 {{ request()->routeIs('admin.membership.payment') ? 'text-blue-600 icon-active' : 'text-gray-500 group-hover:text-gray-700' }}"
                            fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <span
                        class="ml-3 font-medium text-gray-600 group-hover:text-gray-800 transition-all duration-300 overflow-hidden whitespace-nowrap {{ request()->routeIs('admin.membership.payment') ? 'text-gray-800' : 'text-gray-600 group-hover:text-gray-800' }}"
                        :class="{'lg:w-0 lg:opacity-0': !sidebarOpen, 'w-auto opacity-100': sidebarOpen}">Payments</span>
                </a>
            </li>

            <!-- Dues -->
            <li>
                <a href="{{ route('membership-fee.dues') }}"
                   class="flex items-center p-3 rounded-xl transition-all duration-200 nav-item-hover group
                   {{ request()->routeIs('membership-fee.dues') ? 'nav-item-active' : 'nav-item-hover' }}">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 {{ request()->routeIs('membership-fee.dues') ? 'text-blue-600 icon-active' : 'text-gray-500 group-hover:text-gray-700' }}" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <span
                        class="ml-3 font-medium text-gray-600 group-hover:text-gray-800 transition-all duration-300 overflow-hidden whitespace-nowrap {{ request()->routeIs('membership-fee.dues') ? 'text-gray-800' : 'text-gray-600 group-hover:text-gray-800' }}"
                        :class="{'lg:w-0 lg:opacity-0': !sidebarOpen, 'w-auto opacity-100': sidebarOpen}">Dues</span>
                </a>
            </li>

            <!-- Transactions -->
            <li>
                <a href="{{ route('admin.membership.transactions') }}"
                   class="flex items-center p-3 rounded-xl transition-all duration-200 group
               {{ request()->routeIs('admin.membership.transactions') ? 'nav-item-active' : 'nav-item-hover' }}">
                    <div class="flex-shrink-0">
                        <svg
                            class="w-5 h-5 {{ request()->routeIs('admin.membership.transactions') ? 'text-blue-600 icon-active' : 'text-gray-500 group-hover:text-gray-700' }}"
                            fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <span
                        class="ml-3 font-medium text-gray-600 group-hover:text-gray-800 transition-all duration-300 overflow-hidden whitespace-nowrap {{ request()->routeIs('admin.membership.transactions') ? 'text-gray-800' : 'text-gray-600 group-hover:text-gray-800' }}"
                        :class="{'lg:w-0 lg:opacity-0': !sidebarOpen, 'w-auto opacity-100': sidebarOpen}">Transactions</span>
                </a>
            </li>

            <!-- Computational Request -->
            <li>
                <a href="{{ route('admin.request.computational.request') }}"
                   class="flex items-center p-3 rounded-xl transition-all duration-200 group
               {{ request()->routeIs('admin.request.computational.request') ? 'nav-item-active' : 'nav-item-hover' }}">
                    <div class="flex-shrink-0">
                        <svg
                            class="w-5 h-5 {{ request()->routeIs('admin.request.computational.request') ? 'text-blue-600 icon-active' : 'text-gray-500 group-hover:text-gray-700' }}"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.5"
                                d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"
                            ></path>
                        </svg>
                    </div>
                    <span
                        class="ml-3 font-medium text-gray-600 group-hover:text-gray-800 transition-all duration-300 overflow-hidden whitespace-nowrap {{ request()->routeIs('admin.request.computational.request') ? 'text-gray-800' : 'text-gray-600 group-hover:text-gray-800' }}"
                        :class="{'lg:w-0 lg:opacity-0': !sidebarOpen, 'w-auto opacity-100': sidebarOpen}">Requests</span>
                </a>
            </li>
        @endif

        <!-- Settings -->
        <li class="mt-8">
            <div class="border-t border-gray-200 pt-4">
                <a href="{{ route('admin.settings.account.settings') }}"
                   class="flex items-center p-3 rounded-xl transition-all duration-200 group
                     {{ request()->routeIs('admin.settings.account.settings') ? 'nav-item-active' : 'nav-item-hover' }}">
                    <div class="flex-shrink-0">
                        <svg
                            class="w-5 h-5 {{ request()->routeIs('admin.settings.account.settings') ? 'text-blue-600 icon-active' : 'text-gray-500 group-hover:text-gray-700' }}"
                            fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <span
                        class="ml-3 font-medium text-gray-600 group-hover:text-gray-800 transition-all duration-300 overflow-hidden whitespace-nowrap {{ request()->routeIs('admin.settings.account.settings') ? 'text-gray-800' : 'text-gray-600 group-hover:text-gray-800' }}"
                        :class="{'lg:w-0 lg:opacity-0': !sidebarOpen, 'w-auto opacity-100': sidebarOpen}">Settings</span>
                </a>
            </div>
        </li>
    </ul>
</nav>
