@if ($errors->any())
    <div x-data="{ show: false }"
         x-init="setTimeout( () => { show = true }, 100 )"
    >

        <div class="bg-red-300 w-full p-3 mt-2 rounded sm:max-w-[420px] lg:max-w-full">
            <div class="flex">
                <div class="text-red-700">
                    <svg class="h-4 w-4 lg:h-6 lg:w-6 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
                <div class="text-xxs lg:text-sm text-red-800 font-light mt-1">
                    <ul class="list-disc pl-2">
                        @foreach ($errors->all() as $error)
                            <li><p>{{ $error }}</p></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>
@endif
