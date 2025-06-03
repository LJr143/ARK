<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Update Password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Current Password -->
        <div class="col-span-6 sm:col-span-4" x-data="{ showPassword: false }" x-cloak>
            <x-label for="current_password" value="{{ __('Current Password') }}" class="text-sm font-medium text-gray-700" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <x-input id="current_password"
                         x-bind:type="showPassword ? 'text' : 'password'"
                         class="pl-10 pr-10 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                         wire:model="state.current_password"
                         autocomplete="current-password"
                         placeholder="Enter your current password" />
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <button type="button"
                            @click="showPassword = !showPassword"
                            class="text-gray-400 hover:text-gray-600 focus:outline-none focus:text-gray-600">
                        <svg x-show="!showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <svg x-show="showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <x-input-error for="current_password" class="mt-2" />
        </div>

        <!-- New Password -->
        <div class="col-span-6 sm:col-span-4"
             x-data="{
                showNewPassword: false,
                strength: 0,
                strengthText: '',
                strengthColor: '',
                checkStrength(value) {
                    let score = 0;
                    if (value && value.length >= 8) score++;
                    if (value && /[a-z]/.test(value)) score++;
                    if (value && /[A-Z]/.test(value)) score++;
                    if (value && /[0-9]/.test(value)) score++;
                    if (value && /[^A-Za-z0-9]/.test(value)) score++;

                    this.strength = score;
                    if (score === 0) {
                        this.strengthText = '';
                        this.strengthColor = '';
                    } else if (score <= 2) {
                        this.strengthText = 'Weak';
                        this.strengthColor = 'text-red-600';
                    } else if (score === 3) {
                        this.strengthText = 'Fair';
                        this.strengthColor = 'text-yellow-600';
                    } else if (score === 4) {
                        this.strengthText = 'Good';
                        this.strengthColor = 'text-blue-600';
                    } else {
                        this.strengthText = 'Strong';
                        this.strengthColor = 'text-green-600';
                    }
                }
             }" x-cloak>
            <x-label for="password" value="{{ __('New Password') }}" class="text-sm font-medium text-gray-700" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                    </svg>
                </div>
                <x-input id="password"
                         x-ref="newPassword"
                         x-bind:type="showNewPassword ? 'text' : 'password'"
                         class="pl-10 pr-10 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                         wire:model="state.password"
                         autocomplete="new-password"
                         placeholder="Enter a strong password"
                         @input="checkStrength($event.target.value)" />
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <button type="button"
                            @click="showNewPassword = !showNewPassword"
                            class="text-gray-400 hover:text-gray-600 focus:outline-none focus:text-gray-600">
                        <svg x-show="!showNewPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <svg x-show="showNewPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Password Strength Indicator -->
            <div class="mt-2" x-show="strength > 0">
                <div class="flex items-center justify-between">
                    <div class="flex space-x-1">
                        <div class="h-1 w-6 rounded-full" :class="strength >= 1 ? (strength <= 2 ? 'bg-red-500' : strength === 3 ? 'bg-yellow-500' : strength === 4 ? 'bg-blue-500' : 'bg-green-500') : 'bg-gray-200'"></div>
                        <div class="h-1 w-6 rounded-full" :class="strength >= 2 ? (strength <= 2 ? 'bg-red-500' : strength === 3 ? 'bg-yellow-500' : strength === 4 ? 'bg-blue-500' : 'bg-green-500') : 'bg-gray-200'"></div>
                        <div class="h-1 w-6 rounded-full" :class="strength >= 3 ? (strength === 3 ? 'bg-yellow-500' : strength === 4 ? 'bg-blue-500' : 'bg-green-500') : 'bg-gray-200'"></div>
                        <div class="h-1 w-6 rounded-full" :class="strength >= 4 ? (strength === 4 ? 'bg-blue-500' : 'bg-green-500') : 'bg-gray-200'"></div>
                        <div class="h-1 w-6 rounded-full" :class="strength >= 5 ? 'bg-green-500' : 'bg-gray-200'"></div>
                    </div>
                    <span class="text-xs font-medium" :class="strengthColor" x-text="strengthText"></span>
                </div>
            </div>

            <!-- Password Requirements -->
            <div class="mt-3 text-xs text-gray-500 space-y-1">
                <p class="font-medium">Password must contain:</p>
                <ul class="space-y-1 ml-4">
                    <li class="flex items-center">
                        <svg class="w-3 h-3 mr-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        At least 8 characters
                    </li>
                    <li class="flex items-center">
                        <svg class="w-3 h-3 mr-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Mix of uppercase & lowercase letters
                    </li>
                    <li class="flex items-center">
                        <svg class="w-3 h-3 mr-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        At least one number & special character
                    </li>
                </ul>
            </div>

            <x-input-error for="password" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="col-span-6 sm:col-span-4" x-data="{ showConfirmPassword: false }" x-cloak>
            <x-label for="password_confirmation" value="{{ __('Confirm New Password') }}" class="text-sm font-medium text-gray-700" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <x-input id="password_confirmation"
                         x-bind:type="showConfirmPassword ? 'text' : 'password'"
                         class="pl-10 pr-10 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                         wire:model="state.password_confirmation"
                         autocomplete="new-password"
                         placeholder="Confirm your new password" />
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <button type="button"
                            @click="showConfirmPassword = !showConfirmPassword"
                            class="text-gray-400 hover:text-gray-600 focus:outline-none focus:text-gray-600">
                        <svg x-show="!showConfirmPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <svg x-show="showConfirmPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <x-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Password updated successfully.') }}
        </x-action-message>

        <x-button type="submit" class="bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ __('Update Password') }}
        </x-button>
    </x-slot>
</x-form-section>
