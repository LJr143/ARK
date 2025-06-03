<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" id="photo" class="hidden"
                       wire:model.live="photo"
                       x-ref="photo"
                       accept="image/*"
                       x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            "/>

                <x-label for="photo" value="{{ __('Profile Photo') }}"
                         class="text-sm font-medium text-gray-700 mb-3 block"/>

                <div class="flex items-center space-x-6">
                    <!-- Current Profile Photo -->
                    <div class="relative" x-show="! photoPreview">
                        <img
                            src="{{ $this->user->profile_photo_path ? asset('storage/' . $this->user->profile_photo_path) : $this->user->profile_photo_url }}"
                            alt="{{ $this->user->first_name }}"
                            class="rounded-full size-20 object-cover ring-4 ring-gray-100 shadow-md">
                        <div class="absolute -bottom-1 -right-1 bg-blue-500 rounded-full p-1.5 ring-2 ring-white">
                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>

                    <!-- New Profile Photo Preview -->
                    <div class="relative" x-show="photoPreview" style="display: none;">
                        <span
                            class="block rounded-full size-20 bg-cover bg-no-repeat bg-center ring-4 ring-green-100 shadow-md"
                            x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                        </span>
                        <div class="absolute -bottom-1 -right-1 bg-green-500 rounded-full p-1.5 ring-2 ring-white">
                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2">
                        <x-secondary-button type="button"
                                            x-on:click.prevent="$refs.photo.click()"
                                            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ __('Select New Photo') }}
                        </x-secondary-button>

                        @if ($this->user->profile_photo_path)
                            <x-secondary-button type="button"
                                                wire:click="deleteProfilePhoto"
                                                onclick="return confirm('Are you sure you want to remove your profile photo?')"
                                                class="inline-flex items-center px-4 py-2 bg-white border border-red-300 rounded-md font-semibold text-xs text-red-700 uppercase tracking-widest shadow-sm hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                {{ __('Remove Photo') }}
                            </x-secondary-button>
                        @endif
                    </div>
                </div>

                <x-input-error for="photo" class="mt-2"/>

                <!-- Photo Upload Tips -->
                <div class="mt-3 text-sm text-gray-500">
                    <p class="flex items-center">
                        <svg class="w-4 h-4 mr-1 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        Recommended: Square image, at least 400x400px, max 2MB
                    </p>
                </div>
            </div>
        @endif

        <!-- Name Fields -->
        <div class="col-span-6 sm:col-span-4 space-y-6">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <!-- First Name -->
                <div class="relative">
                    <x-label for="first_name" value="{{ __('First Name') }}" class="text-sm font-medium text-gray-700"/>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <x-input id="first_name"
                                 type="text"
                                 class="pl-10 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                 wire:model="state.first_name"
                                 required
                                 autocomplete="given-name"
                                 placeholder="Enter your first name"/>
                    </div>
                    <x-input-error for="first_name" class="mt-2"/>
                </div>

                <!-- Middle Name -->
                <div class="relative w-full">
                    <x-label for="middle_name" value="{{ __('Middle Name') }}"
                             class="text-sm font-medium text-gray-700"/>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <x-input id="middle_name"
                                 type="text"
                                 class="pl-10 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                 wire:model="state.middle_name"
                                 autocomplete="additional-name"
                                 placeholder="Enter your middle name (optional)"/>
                    </div>
                    <x-input-error for="middle_name" class="mt-2"/>
                </div>
            </div>

            <!-- Last Name -->
            <div class="relative">
                <x-label for="family_name" value="{{ __('Last Name') }}" class="text-sm font-medium text-gray-700"/>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <x-input id="family_name"
                             type="text"
                             class="pl-10 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                             wire:model="state.family_name"
                             required
                             autocomplete="family-name"
                             placeholder="Enter your last name"/>
                </div>
                <x-input-error for="family_name" class="mt-2"/>
            </div>
        </div>

        <!-- Email -->
        <div class="col-span-4 sm:col-span-4">
            <x-label for="email" value="{{ __('Email Address') }}" class="text-sm font-medium text-gray-700"/>
            <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                    </svg>
                </div>
                <x-input id="email"
                         type="email"
                         class="pl-10 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                         wire:model="state.email"
                         required
                         autocomplete="username"
                         placeholder="Enter your email address"/>
            </div>
            <x-input-error for="email" class="mt-2"/>

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <div class="mt-3 p-4 bg-yellow-50 border border-yellow-200 rounded-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">
                                {{ __('Email Verification Required') }}
                            </h3>
                            <div class="mt-2 text-sm text-yellow-700">
                                <p>{{ __('Your email address is unverified.') }}</p>
                            </div>
                            <div class="mt-3">
                                <button type="button"
                                        class="bg-yellow-50 text-yellow-800 font-medium text-sm hover:bg-yellow-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 border border-yellow-300 rounded-md px-3 py-2 transition-colors duration-200"
                                        wire:click.prevent="sendEmailVerification">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($this->verificationLinkSent)
                    <div class="mt-3 p-4 bg-green-50 border border-green-200 rounded-md">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <div class="flex items-center justify-end space-x-4">
            <x-action-message class="text-sm text-green-600 font-medium" on="saved">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                              clip-rule="evenodd"></path>
                    </svg>
                    {{ __('Profile Updated Successfully!') }}
                </div>
            </x-action-message>

            <x-button wire:loading.attr="disabled"
                      wire:target="photo"
                      class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                <svg wire:loading wire:target="photo" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none"
                     viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span wire:loading.remove wire:target="photo">{{ __('Save Changes') }}</span>
                <span wire:loading wire:target="photo">{{ __('Saving...') }}</span>
            </x-button>
        </div>
    </x-slot>
</x-form-section>
