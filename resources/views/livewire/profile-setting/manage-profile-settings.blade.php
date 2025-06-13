<div class="py-6 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen" x-data="{
        activeTab: 'general',
        showAddMemberModal: false,
        showRoleModal: false,
        selectedRole: null,
        searchQuery: '',
        editingMember: false
    }" x-init="
         $watch('showAddMemberModal', value => console.log('showAddMemberModal:', value));
         window.addEventListener('show-add-member-modal', () => {
             console.log('Received show-add-member-modal event');
             showAddMemberModal = true;
         });
         window.addEventListener('show-role-modal', () => {
             console.log('Received show-role-modal event');
             showRoleModal = true;
         });
     ">
    <div class="max-w-12xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Settings</h1>
            <p class="mt-2 text-gray-600">Manage your account settings and preferences</p>
        </div>

        <!-- Navigation Tabs -->
        <div class="mb-8">
            <div class="border-b border-gray-200 bg-white rounded-t-xl shadow-sm">
                <nav class="flex space-x-8 px-6" aria-label="Tabs">
                    <button
                        @click="activeTab = 'general'"
                        :class="activeTab === 'general' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200"
                    >
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        General Settings
                    </button>
                    @can('manage-role')
                        <button
                            @click="activeTab = 'roles'"
                            :class="activeTab === 'roles' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 "
                        >
                            <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                            Manage Roles
                        </button>
                    @endcan
                    @can('admin-setting')
                        <button
                            @click="activeTab = 'admin'"
                            :class="activeTab === 'admin' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 "
                        >
                            <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Admin Settings
                        </button>
                    @endcan
                </nav>
            </div>
        </div>

        <!-- Tab Content -->
        <div class="bg-white shadow-xl rounded-b-xl rounded-t-none overflow-hidden">
            <!-- General Settings Tab -->
            <div x-show="activeTab === 'general'" x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform translate-x-4"
                 x-transition:enter-end="opacity-100 transform translate-x-0">
                <div class="p-6 sm:p-8">
                    <!-- Profile Overview Card -->
                    <div
                        class="bg-gradient-to-r from-indigo-50 to-blue-50 rounded-xl p-6 mb-8 border border-indigo-100">
                        <div class="flex items-center space-x-6">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <div class="relative">
                                    <img
                                        src="{{ auth()->user()->profile_photo_path ? asset('storage/' . auth()->user()->profile_photo_path) : auth()->user()->profile_photo_url }}"
                                        alt="{{ auth()->user()->first_name . ' ' . auth()->user()->family_name }}"
                                        class="h-24 w-24 rounded-full object-cover ring-4 ring-white shadow-lg">
                                    <div class="absolute -bottom-1 -right-1 bg-green-400 rounded-full p-2">
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                            @endif
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-gray-900">{{ auth()->user()->first_name . ' ' . auth()->user()->family_name }}</h3>
                                <p class="text-indigo-600 font-medium">{{ auth()->user()->email }}</p>
                                <div class="flex items-center mt-2">
                                        <span
                                            class="inline-flex capitalize items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                          {{ auth()->user()->getRoleNames()->first() }}
                                        </span>
                                    <span
                                        class="ml-2 text-sm text-gray-500">Active since {{ auth()->user()->created_at->format('M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Settings Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Profile Information -->
                        <div class="space-y-6">
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Profile Information
                                </h4>
                                @livewire('profile.update-profile-information-form')
                            </div>
                        </div>

                        <!-- Password Settings -->
                        <div class="space-y-6">
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    Security Settings
                                </h4>
                                @livewire('profile.update-password-form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Manage Roles Tab -->
            <div x-show="activeTab === 'roles'" x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform translate-x-4"
                 x-transition:enter-end="opacity-100 transform translate-x-0">
                <div class="p-6 sm:p-8">
                    <!-- Header with Add Button and Search -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">Role Management</h3>
                            <p class="text-gray-600 mt-1">Manage team members and their permissions</p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                            <div class="relative w-full sm:w-64">
                                <input
                                    type="text"
                                    wire:model.live.debounce.300ms="searchQuery"
                                    placeholder="Search members..."
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                >
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>

                            <button @click="showAddMemberModal = true; $wire.resetForm()"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center whitespace-nowrap">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Assign Admin Role
                            </button>
                        </div>
                    </div>

                    <!-- Tab Navigation -->
                    <div class="border-b border-gray-200 mb-6" x-data="{ roleTab: 'general' }">
                        <nav class="flex space-x-8 overflow-x-auto pb-1 -mb-px">
                            <button @click="roleTab = 'general'"
                                    :class="roleTab === 'general' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                                    class="py-2 px-1 border-b-2 font-medium text-sm transition-colors duration-200 whitespace-nowrap">
                                General
                            </button>
                            <button @click="roleTab = 'admin'"
                                    :class="roleTab === 'admin' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                                    class="py-2 px-1 border-b-2 font-medium text-sm transition-colors duration-200 whitespace-nowrap">
                                Admin Settings
                            </button>
                            <button @click="roleTab = 'roles'"
                                    :class="roleTab === 'roles' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                                    class="py-2 px-1 border-b-2 font-medium text-sm transition-colors duration-200 whitespace-nowrap">
                                Manage Roles
                            </button>
                            <button @click="roleTab = 'computation'"
                                    :class="roleTab === 'computation' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                                    class="py-2 px-1 border-b-2 font-medium text-sm transition-colors duration-200 whitespace-nowrap">
                                Manage Computation
                            </button>
                        </nav>

                        <!-- Members Table -->
                        <div x-show="roleTab === 'general'" class="mt-6">
                            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                                @if($users->isEmpty())
                                    <div class="p-8 text-center text-gray-500">
                                        No members found. Start by assigning roles to users.
                                    </div>
                                @else
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Member
                                                </th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Email
                                                </th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Role
                                                </th>
                                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Actions
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($users as $user)
                                                <tr wire:key="user-{{ $user->id }}">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                <img class="h-10 w-10 rounded-full"
                                                                     src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : $user->profile_photo_url }}"
                                                                     alt="{{ $user->first_name . ' ' . $user->family_name }}">
                                                            </div>
                                                            <div class="ml-4">
                                                                <div
                                                                    class="text-sm font-medium text-gray-900">{{ $user->first_name . ' ' . ($user->middle_name ? $user->middle_name . ' ' : '') . $user->family_name }}</div>
                                                                <div
                                                                    class="text-sm text-gray-500">{{ $user->position ?? 'No position' }}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                    {{ $user->getRoleNames()->first() === 'superadmin' || $user->getRoleNames()->first() === 'admin' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                                    {{ $user->getRoleNames()->first() ?? 'No Role' }}
                                                </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        {{--                                                        <button wire:click="editMember({{ $user->id }})"--}}
                                                        {{--                                                                class="text-blue-600 hover:text-blue-900 mr-3 inline-flex items-center">--}}
                                                        {{--                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
                                                        {{--                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>--}}
                                                        {{--                                                            </svg>--}}
                                                        {{--                                                            Edit--}}
                                                        {{--                                                        </button>--}}
                                                        <button wire:click="removeMember({{ $user->id }})"
                                                                class="text-red-600 hover:text-red-900 inline-flex items-center"
                                                                x-data="{ loading: false }"
                                                                @click="loading = true"
                                                                wire:loading.attr="disabled">
                                                                <span x-show="!loading" class="flex">
                                                                    <svg class="w-4 h-4 mr-1" fill="none"
                                                                         stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round"
                                                                              stroke-linejoin="round" stroke-width="2"
                                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                                    </svg>
                                                                    Remove
                                                                </span>
                                                            <span x-show="loading" class="inline-flex items-center">
                                                        <svg class="animate-spin -ml-1 mr-1 h-4 w-4 text-red-600"
                                                             xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24">
                                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                                    stroke="currentColor" stroke-width="4"></circle>
                                                            <path class="opacity-75" fill="currentColor"
                                                                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                        </svg>
                                                        Removing...
                                                    </span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Role Settings -->
                        <div x-show="roleTab === 'roles'" class="mt-6">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                <!-- Roles List -->
                                <div>
                                    <div class="flex justify-between items-center mb-4">
                                        <h4 class="text-lg font-medium text-gray-900">Available Roles</h4>
                                        <button class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                            + Create New Role
                                        </button>
                                    </div>
                                    <div class="space-y-4">
                                        @forelse(\Spatie\Permission\Models\Role::all() as $role)
                                            <div
                                                class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                                                <div class="flex items-center justify-between">
                                                    <div>
                                                        <h5 class="font-medium text-gray-900 capitalize">{{ $role->name }}</h5>
                                                        <p class="text-sm text-gray-500">{{ $role->permissions->count() }}
                                                            permissions assigned</p>
                                                    </div>
                                                    <button wire:click="configureRole('{{ $role->name }}')"
                                                            class="text-blue-600 hover:text-blue-800 text-sm font-medium inline-flex items-center">
                                                        Configure
                                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                                             viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        @empty
                                            <div
                                                class="bg-white border border-gray-200 rounded-lg p-6 text-center text-gray-500">
                                                No roles found. Create your first role to get started.
                                            </div>
                                        @endforelse
                                    </div>
                                </div>

                                <!-- Permissions List -->
                                <div>
                                    <div class="flex justify-between items-center mb-4">
                                        <h4 class="text-lg font-medium text-gray-900">Available Permissions</h4>
                                        <button class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                            + Add New Permission
                                        </button>
                                    </div>
                                    <div
                                        class="bg-white border border-gray-200 rounded-lg p-4 max-h-[500px] overflow-y-auto shadow-inner">
                                        @forelse(\Spatie\Permission\Models\Permission::all() as $permission)
                                            <div
                                                class="flex items-center justify-between py-3 px-4 bg-white hover:bg-gray-50 rounded-lg transition-colors duration-150">
                                                <div>
                                                    <span
                                                        class="text-sm font-medium text-gray-700">{{ $permission->name }}</span>
                                                    <p class="text-xs text-gray-500 mt-1">Used
                                                        by {{ $permission->roles_count }} roles</p>
                                                </div>
                                                <span
                                                    class="text-xs text-gray-500 bg-gray-100 px-2.5 py-1 rounded-full">
                                            {{ $permission->guard_name }}
                                        </span>
                                            </div>
                                        @empty
                                            <div class="text-center py-8 text-gray-500">
                                                No permissions found. Permissions will appear here once created.
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Admin Settings Tab -->
                        <div x-show="roleTab === 'admin'" class="mt-6">
                            <div
                                class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 mb-6 border border-blue-100">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 pt-0.5">
                                        <svg class="h-6 w-6 text-blue-500" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-lg font-medium text-blue-900 mb-2">Admin Role Settings</h4>
                                        <p class="text-blue-700 text-sm">Configure permissions for admin users. Any
                                            member assigned as an admin can access the following features:</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                                <div class="space-y-4">
                                    @php
                                        $adminPermissions = [
                                            'Create and send reminder',
                                            'Add new member',
                                            'Customize notification settings',
                                            'Customize reminder settings',
                                            'Approve deactivation and activation of member account',
                                            'Edit member\'s information'
                                        ];
                                    @endphp

                                    @foreach($adminPermissions as $permission)
                                        <div
                                            class="flex items-center p-3 hover:bg-gray-50 rounded-lg transition-colors duration-150">
                                            <input type="checkbox" checked
                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label class="ml-3 text-sm text-gray-700">{{ $permission }}</label>
                                            <span
                                                class="ml-auto text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                                        Admin only
                                    </span>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-6 pt-6 border-t border-gray-200 flex justify-end">
                                    <button type="button"
                                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Save Admin Settings
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Admin Settings Tab (Original) -->
            <div x-show="activeTab === 'admin'" x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform translate-x-4"
                 x-transition:enter-end="opacity-100 transform translate-x-0">
                <div class="p-6 sm:p-8">
                    <!-- Admin Overview -->
                    <div
                        class="bg-gradient-to-r from-red-50 to-orange-50 rounded-xl p-6 mb-8 border border-red-100">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div
                                    class="flex items-center justify-center h-12 w-12 rounded-md bg-red-500 text-white">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-red-900">Administrator Settings</h3>
                                <p class="text-red-700">Manage system-wide settings and configurations</p>
                            </div>
                        </div>
                    </div>

                    <!-- Admin Settings Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- User Management -->
                        <div
                            class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow duration-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-medium text-gray-900">User Management</h4>
                                    <p class="text-sm text-gray-500">Manage user accounts and permissions</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button
                                    class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors duration-200">
                                    Manage Users
                                </button>
                            </div>
                        </div>

                        <!-- System Settings -->
                        <div
                            class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow duration-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-medium text-gray-900">System Settings</h4>
                                    <p class="text-sm text-gray-500">Configure system preferences</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button
                                    class="w-full bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition-colors duration-200">
                                    System Config
                                </button>
                            </div>
                        </div>

                        <!-- Reports & Analytics -->
                        <div
                            class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow duration-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-purple-600" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-medium text-gray-900">Reports & Analytics</h4>
                                    <p class="text-sm text-gray-500">View system reports and analytics</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button
                                    class="w-full bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700 transition-colors duration-200">
                                    View Reports
                                </button>
                            </div>
                        </div>

                        <!-- Security & Backup -->
                        <div
                            class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow duration-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-medium text-gray-900">Security & Backup</h4>
                                    <p class="text-sm text-gray-500">Manage security and backup settings</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button
                                    class="w-full bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition-colors duration-200">
                                    Security Settings
                                </button>
                            </div>
                        </div>

                        <!-- API Management -->
                        <div
                            class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow duration-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-yellow-600" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-medium text-gray-900">API Management</h4>
                                    <p class="text-sm text-gray-500">Manage API keys and integrations</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button
                                    class="w-full bg-yellow-600 text-white px-4 py-2 rounded-md hover:bg-yellow-700 transition-colors duration-200">
                                    API Settings
                                </button>
                            </div>
                        </div>

                        <!-- Maintenance -->
                        <div
                            class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow duration-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-gray-600" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-medium text-gray-900">Maintenance</h4>
                                    <p class="text-sm text-gray-500">System maintenance and updates</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button
                                    class="w-full bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition-colors duration-200">
                                    Maintenance
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Assign/Edit Admin Role Modal -->
    <div x-show="showAddMemberModal"
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50"
         @click.away="showAddMemberModal = false; $wire.resetForm()">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white"
             @click.stop>
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">
                        <span x-text="$wire.editingMember ? 'Edit Admin Role' : 'Assign Admin Role'"></span>
                    </h3>
                    <button @click="showAddMemberModal = false; $wire.resetForm()"
                            class="text-gray-400 hover:text-gray-600 rounded-full p-1 hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form wire:submit.prevent="saveMember">
                    @csrf
                    <div class="space-y-4">
                        <!-- Debug Output -->
                        <div>Debug: Selected User ID: {{ $selectedUserId }}</div>
                        <div>Debug: Role: {{ $newMember['role'] }}</div>

                        <!-- Search User Field -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Search User</label>
                            <div class="relative">
                                <input type="text"
                                       wire:model.live.debounce.300ms="searchQuery"
                                       placeholder="Search by name or email"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            @error('searchQuery') <span
                                class="text-red-600 text-xs mt-1">{{ $message }}</span> @enderror

                            <!-- Search Results Dropdown -->
                            <div x-show="$wire.searchQuery.length >= 2"
                                 x-transition
                                 class="mt-1 max-h-60 overflow-y-auto border border-gray-200 rounded-md shadow-lg">
                                @forelse($searchedUsers as $user)
                                    <div wire:click="selectUser({{ $user->id }})"
                                         class="px-3 py-2 hover:bg-gray-100 cursor-pointer flex items-center">
                                        <img class="h-8 w-8 rounded-full mr-2"
                                             src="{{ $user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : $user->profile_photo_url }}"
                                             alt="{{ $user->name }}">
                                        <div>
                                            <div
                                                class="text-sm font-medium text-gray-900">{{ $user->first_name }} {{ $user->family_name }}</div>
                                            <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="px-3 py-2 text-sm text-gray-500">
                                        @if(strlen($searchQuery) >= 2)
                                            No users found for "{{ $searchQuery }}"
                                        @endif
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Selected User Field -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Selected User</label>
                            <div class="flex items-center bg-gray-50 rounded-md px-3 py-2 border border-gray-300">
                                @if($selectedUser)
                                    <img class="h-8 w-8 rounded-full mr-2"
                                         src="{{ $selectedUser->profile_photo_url }}"
                                         alt="{{ $selectedUserName }}">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $selectedUserName }}</div>
                                        <div class="text-xs text-gray-500">{{ $selectedUser->email }}</div>
                                    </div>
                                @else
                                    <span class="text-sm text-gray-500">No user selected</span>
                                @endif
                            </div>
                            @error('selectedUserId') <span
                                class="text-red-600 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Role Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                            <select wire:model="newMember.role"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select Role</option>
                                <option value="superadmin">Superadmin</option>
                                <option value="admin">Admin</option>
                            </select>
                            @error('newMember.role') <span
                                class="text-red-600 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 mt-6">
                            <button type="button"
                                    @click="showAddMemberModal = false; $wire.resetForm()"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Cancel
                            </button>
                            <button type="submit"
                                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 inline-flex items-center"
                                    wire:loading.attr="disabled">
                                <span wire:loading.remove>
                                    <span x-text="$wire.editingMember ? 'Update Role' : 'Assign Role'"></span>
                                </span>
                                <span wire:loading>
                                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Processing...
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Role Configuration Modal -->
    <div x-show="showRoleModal"
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50"
         @click.away="showRoleModal = false">
        <div class="relative top-10 mx-auto p-5 border w-full max-w-4xl shadow-lg rounded-md bg-white"
             @click.stop>
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">
                        Configure Role: <span x-text="$wire.selectedRole" class="capitalize font-semibold"></span>
                    </h3>
                    <button @click="showRoleModal = false"
                            class="text-gray-400 hover:text-gray-600 rounded-full p-1 hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form wire:submit.prevent="saveRolePermissions">
                    <div class="mb-4">
                        <div class="relative">
                            <input type="text"
                                   placeholder="Search permissions..."
                                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="max-h-[500px] overflow-y-auto border border-gray-200 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4">
                            @forelse(\Spatie\Permission\Models\Permission::all() as $permission)
                                <div
                                    class="flex items-center p-3 bg-white hover:bg-gray-50 rounded-lg border border-gray-100 transition-colors duration-150">
                                    <input type="checkbox"
                                           wire:model="selectedPermissions.{{ $permission->id }}"
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label class="ml-3 text-sm text-gray-700 flex-1">{{ $permission->name }}</label>
                                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                                        {{ $permission->guard_name }}
                                    </span>
                                </div>
                            @empty
                                <div class="col-span-2 text-center py-8 text-gray-500">
                                    No permissions available. Create permissions first.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4 mt-6 border-t">
                        <button type="button"
                                @click="showRoleModal = false"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 inline-flex items-center"
                                wire:loading.attr="disabled">
                            <span wire:loading.remove>Save Changes</span>
                            <span wire:loading>
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Saving...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
