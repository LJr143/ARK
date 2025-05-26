<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" x-data="{
    activeMainTab: 'list',
    activeSubTab: 'members'
}">
    <div class="bg-white rounded-lg shadow-sm mb-6 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Reminders</h1>
                <nav class="flex space-x-6 mt-4">
                    <a href="#"
                       @click.prevent="activeMainTab = 'list'"
                       :class="{
                           'text-blue-600 border-b-2 border-blue-600 pb-2 font-medium': activeMainTab === 'list',
                           'text-gray-500 hover:text-gray-700 pb-2': activeMainTab !== 'list'
                       }">List</a>
                    <a href="#"
                       @click.prevent="activeMainTab = 'manage'"
                       :class="{
                           'text-blue-600 border-b-2 border-blue-600 pb-2 font-medium': activeMainTab === 'manage',
                           'text-gray-500 hover:text-gray-700 pb-2': activeMainTab !== 'manage'
                       }">Manage Reminder</a>
                    <a href="#"
                       @click.prevent="activeMainTab = 'recipients'"
                       :class="{
                           'text-blue-600 border-b-2 border-blue-600 pb-2 font-medium': activeMainTab === 'recipients',
                           'text-gray-500 hover:text-gray-700 pb-2': activeMainTab !== 'recipients'
                       }">Recipients</a>
                </nav>
            </div>
            <button
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
                <i class="fas fa-paper-plane"></i>
                <span>Send Reminder</span>
            </button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-white rounded-lg shadow-sm">
        <!-- Sub Navigation -->
        <div class="border-b border-gray-200 px-6 py-4">
            <div class="flex justify-between items-center">
                <nav class="flex space-x-6">
                    <a href="#"
                       @click.prevent="activeSubTab = 'details'"
                       :class="{
                           'text-blue-600 border-b-2 border-blue-600 pb-2 font-medium': activeSubTab === 'details',
                           'text-gray-500 hover:text-gray-700 font-medium': activeSubTab !== 'details'
                       }">Reminder Details</a>
                    <a href="#"
                       @click.prevent="activeSubTab = 'members'"
                       :class="{
                           'text-blue-600 border-b-2 border-blue-600 pb-2 font-medium': activeSubTab === 'members',
                           'text-gray-500 hover:text-gray-700 font-medium': activeSubTab !== 'members'
                       }">Members</a>
                </nav>
                <button class="text-blue-600 hover:text-blue-700 flex items-center space-x-1 font-medium">
                    <i class="fas fa-plus text-sm"></i>
                    <span>Add Member</span>
                </button>
            </div>
        </div>

        <!-- Tab Content -->
        <div x-show="activeSubTab === 'members'" class="p-6">
            <div class="overflow-x-auto">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <!-- Table -->
                        <div class="p-6">
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                    <tr class="border-b border-gray-200">
                                        <th class="text-left py-3 px-4 font-medium text-gray-700">Member</th>
                                        <th class="text-left py-3 px-4 font-medium text-gray-700">Payment Status</th>
                                        <th class="text-left py-3 px-4 font-medium text-gray-700">Contact Details</th>
                                        <th class="text-left py-3 px-4 font-medium text-gray-700">Date Added</th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                    <!-- Member 1 -->
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="py-4 px-4">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-user text-white text-sm"></i>
                                                </div>
                                                <div>
                                                    <div class="font-medium text-gray-900">Name of the member</div>
                                                    <div class="text-sm text-gray-500">PRC No. 11111</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Paid
                                    </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="text-sm text-gray-900">sample@email.com</div>
                                            <div class="text-sm text-gray-500">+63 123 1234 123</div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="text-sm text-gray-900">2025-05-12 10:42 AM</div>
                                        </td>
                                    </tr>

                                    <!-- Member 2 -->
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="py-4 px-4">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-user text-white text-sm"></i>
                                                </div>
                                                <div>
                                                    <div class="font-medium text-gray-900">Name of the member</div>
                                                    <div class="text-sm text-gray-500">PRC No. 11111</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Paid
                                    </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="text-sm text-gray-900">sample@email.com</div>
                                            <div class="text-sm text-gray-500">+63 123 1234 123</div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="text-sm text-gray-900">2025-05-12 10:42 AM</div>
                                        </td>
                                    </tr>

                                    <!-- Member 3 -->
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="py-4 px-4">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-user text-white text-sm"></i>
                                                </div>
                                                <div>
                                                    <div class="font-medium text-gray-900">Name of the member</div>
                                                    <div class="text-sm text-gray-500">PRC No. 11111</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Unpaid
                                    </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="text-sm text-gray-900">sample@email.com</div>
                                            <div class="text-sm text-gray-500">+63 123 1234 123</div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="text-sm text-gray-900">2025-05-12 10:42 AM</div>
                                        </td>
                                    </tr>

                                    <!-- Member 4 -->
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="py-4 px-4">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-user text-white text-sm"></i>
                                                </div>
                                                <div>
                                                    <div class="font-medium text-gray-900">Name of the member</div>
                                                    <div class="text-sm text-gray-500">PRC No. 11111</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Overdue
                                    </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="text-sm text-gray-900">sample@email.com</div>
                                            <div class="text-sm text-gray-500">+63 123 1234 123</div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="text-sm text-gray-900">2025-05-12 10:42 AM</div>
                                        </td>
                                    </tr>

                                    <!-- Member 5 -->
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="py-4 px-4">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-user text-white text-sm"></i>
                                                </div>
                                                <div>
                                                    <div class="font-medium text-gray-900">Name of the member</div>
                                                    <div class="text-sm text-gray-500">PRC No. 11111</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Unpaid
                                    </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="text-sm text-gray-900">sample@email.com</div>
                                            <div class="text-sm text-gray-500">+63 123 1234 123</div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="text-sm text-gray-900">2025-05-12 10:42 AM</div>
                                        </td>
                                    </tr>

                                    <!-- Member 6 -->
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="py-4 px-4">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-user text-white text-sm"></i>
                                                </div>
                                                <div>
                                                    <div class="font-medium text-gray-900">Name of the member</div>
                                                    <div class="text-sm text-gray-500">PRC No. 11111</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Paid
                                    </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="text-sm text-gray-900">sample@email.com</div>
                                            <div class="text-sm text-gray-500">+63 123 1234 123</div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="text-sm text-gray-900">2025-05-12 10:42 AM</div>
                                        </td>
                                    </tr>

                                    <!-- Member 7 -->
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="py-4 px-4">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-user text-white text-sm"></i>
                                                </div>
                                                <div>
                                                    <div class="font-medium text-gray-900">Name of the member</div>
                                                    <div class="text-sm text-gray-500">PRC No. 11111</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Paid
                                    </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="text-sm text-gray-900">sample@email.com</div>
                                            <div class="text-sm text-gray-500">+63 123 1234 123</div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="text-sm text-gray-900">2025-05-12 10:42 AM</div>
                                        </td>
                                    </tr>

                                    <!-- Member 8 -->
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="py-4 px-4">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-user text-white text-sm"></i>
                                                </div>
                                                <div>
                                                    <div class="font-medium text-gray-900">Name of the member</div>
                                                    <div class="text-sm text-gray-500">PRC No. 11111</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Unpaid
                                    </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="text-sm text-gray-900">sample@email.com</div>
                                            <div class="text-sm text-gray-500">+63 123 1234 123</div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="text-sm text-gray-900">2025-05-12 10:42 AM</div>
                                        </td>
                                    </tr>

                                    <!-- Member 9 -->
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="py-4 px-4">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-user text-white text-sm"></i>
                                                </div>
                                                <div>
                                                    <div class="font-medium text-gray-900">Name of the member</div>
                                                    <div class="text-sm text-gray-500">PRC No. 11111</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Unpaid
                                    </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="text-sm text-gray-900">sample@email.com</div>
                                            <div class="text-sm text-gray-500">+63 123 1234 123</div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="text-sm text-gray-900">2025-05-12 10:42 AM</div>
                                        </td>
                                    </tr>

                                    <!-- Member 10 -->
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="py-4 px-4">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-user text-white text-sm"></i>
                                                </div>
                                                <div>
                                                    <div class="font-medium text-gray-900">Name of the member</div>
                                                    <div class="text-sm text-gray-500">PRC No. 11111</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Unpaid
                                    </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="text-sm text-gray-900">sample@email.com</div>
                                            <div class="text-sm text-gray-500">+63 123 1234 123</div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="text-sm text-gray-900">2025-05-12 10:42 AM</div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>

        <div x-show="activeSubTab === 'details'" class="p-6">
            <!-- Content for Reminder Details tab -->
            <div class="max-w-full mx-auto bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Header Section -->
                <div class="bg-blue-800 px-6 py-4">
                    <h1 class="text-2xl font-bold text-white">Membership Annual Dues 2025</h1>
                    <div class="mt-2">
                        <span class="text-blue-200">Reminder ID: 00123</span>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="p-6 space-y-6">
                    <!-- Location Section -->
                    <div class="border-b border-gray-200 pb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Location</h2>
                        <div class="mt-2 flex items-center">
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">Start</span>
                        </div>
                    </div>

                    <!-- Period Covered -->
                    <div class="border-b border-gray-200 pb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Period Covered</h2>
                        <p class="mt-2 text-gray-600">June 2025 - July 2026</p>
                    </div>

                    <!-- Description -->
                    <div class="border-b border-gray-200 pb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Description</h2>
                        <div class="mt-2 text-gray-600 space-y-2">
                            <p>Dear valued members,</p>
                            <p>This is a sample description for this reminder wherein every members of UAP Fort-Bonifacio Chapter will receive and see details such as the <strong class="font-semibold">deadline for the Membership Dues Payment</strong> for the Calendar Year 2025 is June 4 2024.</p>
                            <p>All members may request computation breakdown through this app.</p>
                        </div>
                    </div>

                    <!-- Regards -->
                    <div class="border-b border-gray-200 pb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Regards,</h2>
                        <p class="mt-2 text-gray-600">UAP Fort-Bonifacio Chapter</p>
                    </div>

                    <!-- Activity Log -->
                    <div class="border-b border-gray-200 pb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Activity Log</h2>
                        <p class="mt-2 text-gray-600 mb-4">Recent send logs for this reminder</p>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date last sent</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notification Send via</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Activity made by</th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">21-May-2025</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">SMS</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">Juan Cruz (Admin)</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">16-May-2025</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">App Notification, SMS, Email</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">Juan Cruz (Admin)</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Attachments -->
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">Attachment</h2>
                        <p class="mt-2 text-gray-600 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>

                        <div class="space-y-2">
                            <div class="flex items-center">
                                <input type="checkbox" class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                                <span class="ml-2 text-gray-600">Membership Annual Dues DL...</span>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                                <span class="ml-2 text-gray-600">About UAP Fort-Bonifacio C...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content for other main tabs -->
    <div x-show="activeMainTab === 'manage'" class="bg-white rounded-lg shadow-sm mt-4 p-6">
        <!-- Content for Manage Reminder tab -->
        <p>Manage reminder content goes here</p>
    </div>

    <div x-show="activeMainTab === 'recipients'" class="bg-white rounded-lg shadow-sm mt-4 p-6">
        <!-- Content for Recipients tab -->
        <p>Recipients content goes here</p>
    </div>
</div>
