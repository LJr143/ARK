@props(['name', 'tabindex' => -1, 'class' => '', 'placeholder' => '', 'icon_class' => ''])

<div class="flex flex-col relative w-full"
     x-data=
         "
            {
                input: null,
                show: false,
                isOpen: false,
                isMinLength: false,
                hasLowerCase: false,
                hasUpperCase: false,
                hasNumber: false,
                hasSpecialChar: false,
                checkPassword(password) {
                    this.isMinLength = password.length >= 8;
                    this.hasLowerCase = /[a-z]/.test(password);
                    this.hasUpperCase = /[A-Z]/.test(password);
                    this.hasNumber = /\d/.test(password);
                    this.hasSpecialChar = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test(password);
                    this.isOpen = !(this.isMinLength && this.hasLowerCase && this.hasUpperCase && this.hasNumber && this.hasSpecialChar);
                    if (this.isMinLength && this.hasLowerCase && this.hasUpperCase && this.hasNumber && this.hasSpecialChar) {
                        this.input.setCustomValidity('');
                        this.input.reportValidity();
                    } else {
                        this.input.setCustomValidity('Please enter a valid password.');
                        this.input.reportValidity();
                    }
                }
            }
         "
     x-init="input = document.getElementById('{{ $name }}')"
>
    <label for="{{ $name }}" class="sr-only">Password</label>
    <input tabindex="{{ $tabindex }}"
           id="{{ $name }}"
           type="password"
           placeholder="{{ $placeholder }}"
           :type="show ? 'text' : 'password'" name="{{ $name }}"
           @click="isOpen = true"
           @focusin="isOpen = true"
           @focusout="isOpen = false"
           @input="checkPassword($event.target.value)"
           class="rounded border px-7 focus:ring-transparent text-xs  border-gray-400 focus:border-[#61FFBD] active:border-[#61FFBD] hover:border-[#61FFBD] {{ ' '.$class }}"
           required>
    <span class="absolute top-1.5 left-0 px-2 {{ ' '.$icon_class }}">
        <svg class="w-4" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.6664 9.64941H4.38573C3.41681 9.64941 2.63135 10.4349 2.63135 11.4038V17.5442C2.63135 18.5131 3.41681 19.2985 4.38573 19.2985H16.6664C17.6354 19.2985 18.4208 18.5131 18.4208 17.5442V11.4038C18.4208 10.4349 17.6354 9.64941 16.6664 9.64941Z" stroke="#6B7280" stroke-width="1.75439" stroke-linecap="round" stroke-linejoin="round"/><path d="M6.14014 9.64864V6.13987C6.14014 4.97664 6.60223 3.86105 7.42476 3.03853C8.24728 2.216 9.36287 1.75391 10.5261 1.75391C11.6893 1.75391 12.8049 2.216 13.6274 3.03853C14.45 3.86105 14.9121 4.97664 14.9121 6.13987V9.64864" stroke="#6B7280" stroke-width="1.75439" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </span>
    <button type="button" class="absolute top-1.5 right-0 px-2 {{ ' '.$icon_class }}" @click="show = !show">
        <svg x-cloak
             x-show="show"
             x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             class="w-[18px] text-green-400"
             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
             stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
        <svg x-cloak
             x-show="!show"
             x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             class="w-[18px] text-green-400"
             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
             stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" /><path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" /><path d="M3 3l18 18" /></svg>
    </button>

    <div x-cloak
         x-show="isOpen"
         x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="absolute top-8 z-10 w-full bg-white shadow-[0px_2px_6px_-1px_rgba(0,0,0,0.1)] rounded-lg p-4 dark:bg-gray-800 dark:border dark:border-gray-700 dark:divide-gray-700">
        <h4 class="mb-0 mt-0 text-sm font-semibold text-gray-800 dark:text-white">
            Your password must contain:
        </h4>

        <ul class="space-y-1 text-xs text-red-500">
            <li :class="{ 'text-primary': isMinLength }" class=" flex items-center gap-x-2">
                <span :class="{ 'flex': isMinLength, 'hidden': !isMinLength  }" data-check>
                    <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12" />
                    </svg>
                </span>
                <span :class="{ 'flex': !isMinLength, 'hidden': isMinLength }" data-uncheck>
                    <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </span>
                Minimum number of characters is 8.
            </li>
            <li :class="{ 'text-primary': hasLowerCase }" class=" flex items-center gap-x-2">
                <span :class="{ 'flex': hasLowerCase, 'hidden': !hasLowerCase }" data-check>
                    <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12" />
                    </svg>
                </span>
                <span :class="{ 'flex': !hasLowerCase, 'hidden': hasLowerCase }" data-uncheck>
                    <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </span>
                Should contain lowercase.
            </li>
            <li :class="{ 'text-primary': hasUpperCase }" class=" flex items-center gap-x-2">
                <span :class="{ 'flex': hasUpperCase, 'hidden': !hasUpperCase }" data-check>
                    <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12" />
                    </svg>
                </span>
                <span :class="{ 'flex': !hasUpperCase, 'hidden': hasUpperCase }" data-uncheck>
                    <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </span>
                Should contain uppercase.
            </li>
            <li :class="{ 'text-primary': hasNumber }" class=" flex items-center gap-x-2">
                <span :class="{ 'flex': hasNumber, 'hidden': !hasNumber }" data-check>
                    <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12" />
                    </svg>
                </span>
                <span :class="{ 'flex': !hasNumber, 'hidden': hasNumber }" data-uncheck>
                    <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </span>
                Should contain numbers.
            </li>
            <li :class="{ 'text-primary': hasSpecialChar }" class=" flex items-center gap-x-2">
                <span :class="{ 'flex': hasSpecialChar, 'hidden': !hasSpecialChar }" data-check>
                    <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12" />
                    </svg>
                </span>
                <span :class="{ 'flex': !hasSpecialChar, 'hidden': hasSpecialChar }" data-uncheck>
                    <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </span>
                Should contain special characters. e.g(@#$%&*-+)
            </li>
        </ul>
    </div>
</div>
