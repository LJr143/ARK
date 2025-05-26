@props(['main_class' => '', 'page_title' => 'Dashboard'])

<x-app-layout>

    <div>

        <!-- Static sidebar for desktop -->
        <div class="fixed inset-y-0 z-50 flex w-50 flex-col ">
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-primary px-10 pb-4">
                <div class="flex h-16 shrink-0 items-center">
                    <h1 class="text-white text-[36px] font-semibold text-center">MIR<span class="text-primary-yellow">KA</span>DO</h1>
                </div>

                <nav class="flex flex-1 flex-col mb-14">
                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                        <li>
                            <ul role="list" class="-mx-2 space-y-1">
                                <li><!-- dashboard -->
                                    <a href="{{route('admin.dashboard')}}" class="flex items-center group text-white gap-x-2 rounded-md p-1 hover:bg-white hover:text-primary">
                                        <svg class="ml-2" width="28" height="27" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g filter="url(#filter0_d_2055_41)">
                                                <rect class="group-hover:fill-primary" x="1" y="1" width="24" height="23" rx="5" fill="white"/>
                                            </g>
                                            <path d="M19.9963 11.9863C19.9963 12.4785 19.6317 12.8641 19.2185 12.8641H18.4406L18.4577 17.2445C18.4577 17.3184 18.4528 17.3922 18.4455 17.466V17.9062C18.4455 18.5105 18.0104 19 17.4732 19H17.0843C17.0575 19 17.0308 19 17.0041 18.9973C16.97 19 16.936 19 16.902 19H16.112H15.5286C14.9914 19 14.5563 18.5105 14.5563 17.9062V17.25V15.5C14.5563 15.016 14.2087 14.625 13.7784 14.625H12.2228C11.7925 14.625 11.4449 15.016 11.4449 15.5V17.25V17.9062C11.4449 18.5105 11.0098 19 10.4726 19H9.88922H9.11381C9.07735 19 9.04088 18.9973 9.00442 18.9945C8.97525 18.9973 8.94608 19 8.91691 19H8.52799C7.99079 19 7.55569 18.5105 7.55569 17.9062V14.8438C7.55569 14.8191 7.55569 14.7918 7.55812 14.7672V12.8641H6.77784C6.34031 12.8641 6 12.4813 6 11.9863C6 11.7402 6.07292 11.5215 6.24308 11.3301L12.4756 5.21875C12.6457 5.02734 12.8402 5 13.0103 5C13.1805 5 13.3749 5.05469 13.5208 5.19141L19.7289 11.3301C19.9234 11.5215 20.0206 11.7402 19.9963 11.9863Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                            <defs>
                                                <filter id="filter0_d_2055_41" x="0" y="0" width="28" height="27" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                                    <feOffset dx="1" dy="1"/>
                                                    <feGaussianBlur stdDeviation="1"/>
                                                    <feComposite in2="hardAlpha" operator="out"/>
                                                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2055_41"/>
                                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2055_41" result="shape"/>
                                                </filter>
                                            </defs>
                                        </svg>
                                        <span class=" text-[12px]">Dashboard</span>
                                    </a>
                                </li>


                                <li><!-- Verifiers -->
                                    <a href="{{route('admin.manageVerifiers')}}" class="flex items-center group text-white gap-x-2 rounded-md p-1 hover:bg-white hover:text-primary">
                                        <svg class="ml-2"  width="28" height="27" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g filter="url(#filter0_d_2054_15)">
                                                <rect class="group-hover:fill-primary" x="1" y="1" width="24" height="23" rx="5" fill="white"/>
                                            </g>
                                            <mask id="mask0_2054_15" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="7" y="15" width="5" height="5">
                                                <path d="M7.53906 15.4072H11.0536V19.5377H7.53906V15.4072Z" fill="white" class="group-hover:fill-white"/>
                                            </mask>
                                            <g mask="url(#mask0_2054_15)">
                                                <path d="M7.54688 19.5375H11.053C10.3668 18.0818 10.1047 16.4525 10.0046 15.418C8.0149 16.5046 7.6224 18.8032 7.54688 19.5375Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                            </g>
                                            <mask id="mask1_2054_15" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="14" y="15" width="4" height="5">
                                                <path d="M14.1094 15.4072H17.6279V19.5377H14.1094V15.4072Z" fill="white" class="group-hover:fill-white"/>
                                            </mask>
                                            <g mask="url(#mask1_2054_15)">
                                                <path d="M15.1696 15.418C15.0694 16.4525 14.8073 18.0818 14.1211 19.5375H17.6272C17.5504 18.8028 17.1544 16.5028 15.1696 15.418Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                            </g>
                                            <path d="M10.9503 9.84842C10.4203 9.85775 9.82265 9.86838 9.64977 9.90752C9.44223 10.1431 9.34544 11.4302 9.44664 12.648L9.46241 12.8375C10.0313 14.0007 11.2228 14.8054 12.6015 14.8054C13.9506 14.8054 15.1217 14.0353 15.7045 12.9124L15.7257 12.6017C15.7688 11.974 15.7849 10.3198 15.4388 9.33496C14.2313 9.79047 12.3608 9.82353 10.9503 9.84842Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                            <mask id="mask2_2054_15" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="8" y="5" width="10" height="8">
                                                <path d="M8.25781 5.71875H17.0726V12.704H8.25781V5.71875Z" fill="white" class="group-hover:fill-white"/>
                                            </mask>
                                            <g mask="url(#mask2_2054_15)">
                                                <path d="M9.47923 9.48958C10.0634 9.28089 14.1097 9.62095 15.6608 8.73987C16.3608 9.92412 16.1752 12.633 16.1752 12.633C16.9348 11.4578 17.1863 10.0244 16.9972 8.88968C16.8999 8.30512 16.5833 8.09903 16.2434 8.05613C16.2572 7.99515 16.2656 7.93193 16.2656 7.86531C16.2656 6.6577 14.5244 5.71875 12.6555 5.71875C11.5017 5.71875 10.2995 6.07624 9.42722 6.94922C7.57935 8.79868 8.33021 10.715 8.99956 12.6859C8.99956 12.6859 8.75419 9.7487 9.47923 9.48958Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                            </g>
                                            <mask id="mask3_2054_15" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="10" y="14" width="5" height="6">
                                                <path d="M10.4258 14.9814H14.7406V19.5379H10.4258V14.9814Z" fill="white" class="group-hover:fill-white"/>
                                            </mask>
                                            <g mask="url(#mask3_2054_15)">
                                                <path d="M14.0173 14.9894C13.5779 15.1588 13.1029 15.2556 12.6046 15.2556C12.102 15.2556 11.6229 15.1575 11.1804 14.9854C10.923 15.0455 10.6736 15.1172 10.4414 15.2125C10.5296 16.2422 10.7901 18.0197 11.5574 19.5379H12.0295L12.3299 16.9796C12.0543 16.8745 11.8574 16.6093 11.8574 16.2964C11.8574 15.8917 12.1854 15.5635 12.5899 15.5635C12.9944 15.5635 13.3223 15.8917 13.3223 16.2964C13.3223 16.6093 13.1256 16.8745 12.85 16.9796L13.1504 19.5379H13.6222C14.3896 18.0197 14.65 16.2422 14.7382 15.2125C14.5115 15.1195 14.2682 15.049 14.0173 14.9894Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                            </g>
                                            <defs>
                                                <filter id="filter0_d_2054_15" x="0" y="0" width="28" height="27" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                                    <feOffset dx="1" dy="1"/>
                                                    <feGaussianBlur stdDeviation="1"/>
                                                    <feComposite in2="hardAlpha" operator="out"/>
                                                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2054_15"/>
                                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2054_15" result="shape"/>
                                                </filter>
                                            </defs>
                                        </svg>

                                        <span class="text-[12px] mr-11">Verifiers</span>
                                    </a>
                                </li>



                                <li class="group" x-data="{ isOpen: false }"><!--Manage Users-->
                                    <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
                                    <div id="ManageUsers">
                                        <div>
                                            <h2 class="mb-0" id="userHeader">

                                                <button id="dropdownDefaultButton"  @click="isOpen = !isOpen" :aria-expanded="isOpen.toString()" @keydown.space.prevent="isOpen = !isOpen" data-dropdown-toggle="dropdown" class="flex items-center w-full text-white gap-x-2 group rounded-md p-1 group-hover:bg-white group-hover:text-primary transition [overflow-anchor:none] hover:z-[2] focus:z-[3] focus:outline-none dark:bg-neutral-800 dark:text-white [&:not([data-te-collapse-collapsed])]:bg-white [&:not([data-te-collapse-collapsed])]:text-primary  [&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(229,231,235)] dark:[&:not([data-te-collapse-collapsed])]:bg-neutral-800 dark:[&:not([data-te-collapse-collapsed])]:text-primary-400 dark:[&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(75,85,99)]"
                                                        type="button"
                                                        data-te-collapse-init
                                                        data-te-collapse-collapsed
                                                        data-te-target="#collapseUsers"
                                                        aria-expanded="false"
                                                        aria-controls="collapseUsers">

                                                    <svg class="ml-2" width="28" height="27" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g filter="url(#filter0_d_2230_3)">
                                                            <rect :class="{ 'fill-primary': isOpen }" class="group-hover:fill-primary" x="1" y="1" width="24" height="23" rx="5" fill="white"/>
                                                        </g>
                                                        <path :class="{ 'fill-white': isOpen }" class="group-hover:fill-white" d="M12.4932 11.9534C13.4408 11.9534 14.2095 11.1851 14.2095 10.2384C14.2095 9.29074 13.4408 8.52295 12.4932 8.52295C11.5455 8.52295 10.7773 9.29074 10.7773 10.2384C10.7773 11.1849 11.5455 11.9534 12.4932 11.9534Z" fill="#0BAA67"/>
                                                        <mask id="mask0_2230_3" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="9" y="12" width="7" height="6">
                                                            <path :class="{ 'fill-white': isOpen }"  class="group-hover:fill-white" d="M9.37109 12.5186H15.6118V17.8426H9.37109V12.5186Z" fill="white"/>
                                                        </mask>
                                                        <g mask="url(#mask0_2230_3)">
                                                            <path :class="{ 'fill-white': isOpen }"  class="group-hover:fill-white" d="M14.06 12.5244H13.6381L12.4939 14.24L11.35 12.5246H10.928C10.0704 12.5246 9.37551 13.2196 9.37551 14.0763L9.375 17.8335H10.5041V14.6279C10.5041 14.5562 10.5623 14.4986 10.6334 14.4986C10.7052 14.4986 10.7629 14.5562 10.7629 14.6279V17.8335H14.2248V14.6279C14.2248 14.5562 14.2829 14.4986 14.3542 14.4986C14.4259 14.4986 14.4835 14.5562 14.4835 14.6279V17.8335H15.6126V14.0761C15.6126 13.2196 14.9176 12.5244 14.06 12.5244Z" fill="#0BAA67"/>
                                                        </g>
                                                        <mask id="mask1_2230_3" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="15" y="7" width="4" height="4">
                                                            <path :class="{ 'fill-white': isOpen }"  class="group-hover:fill-white" d="M15.2969 7.49561H18.4635V10.6299H15.2969V7.49561Z" fill="white"/>
                                                        </mask>
                                                        <g mask="url(#mask1_2230_3)">
                                                            <path :class="{ 'fill-white': isOpen }"  class="group-hover:fill-white" d="M16.8862 10.6262C17.7529 10.6262 18.456 9.92303 18.456 9.05729C18.456 8.19039 17.7531 7.48828 16.8862 7.48828C16.0194 7.48828 15.3164 8.19039 15.3164 9.05729C15.3164 9.92318 16.0194 10.6262 16.8862 10.6262Z" fill="#0BAA67"/>
                                                        </g>
                                                        <mask id="mask2_2230_3" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="6" y="7" width="4" height="4">
                                                            <path :class="{ 'fill-white': isOpen }"  class="group-hover:fill-white" d="M6.51953 7.49561H9.6862V10.6299H6.51953V7.49561Z" fill="white"/>
                                                        </mask>
                                                        <g mask="url(#mask2_2230_3)">
                                                            <path :class="{ 'fill-white': isOpen }"  class="group-hover:fill-white" d="M8.10106 10.6262C8.96723 10.6262 9.67036 9.92303 9.67036 9.05729C9.67036 8.19039 8.96738 7.48828 8.10106 7.48828C7.2343 7.48828 6.53125 8.19039 6.53125 9.05729C6.53139 9.92318 7.2343 10.6262 8.10106 10.6262Z" fill="#0BAA67"/>
                                                        </g>
                                                        <path :class="{ 'fill-white': isOpen }"  class="group-hover:fill-white" d="M18.3177 11.1484H17.9316L16.8854 12.7174L15.8393 11.1484H15.4531C14.7723 11.1484 14.2049 11.6278 14.0664 12.2669C15.0614 12.2709 15.8702 13.0812 15.8702 14.0762V16.0038H18.4689V13.072C18.4689 13.0063 18.5214 12.9538 18.5871 12.9538C18.6523 12.9538 18.7053 13.0063 18.7053 13.072V16.0036H19.7378V12.5678C19.7378 11.7839 19.102 11.1484 18.3177 11.1484Z" fill="#0BAA67"/>
                                                        <path :class="{ 'fill-white': isOpen }"  class="group-hover:fill-white" d="M6.27857 13.0721C6.27857 13.0064 6.33174 12.954 6.39677 12.954C6.46246 12.954 6.51497 13.0064 6.51497 13.0721V16.0038H9.11372L9.11422 14.0762C9.11422 13.0811 9.92245 12.2716 10.917 12.2669C10.779 11.6278 10.2114 11.1484 9.53074 11.1484H9.14468L8.09845 12.7174L7.05223 11.1484H6.66616C5.88173 11.1484 5.24609 11.7839 5.24609 12.5678V16.0036H6.27857V13.0721Z" fill="#0BAA67"/>
                                                        <defs>
                                                            <filter id="filter0_d_2230_3" x="0" y="0" width="28" height="27" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                                <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                                                <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                                                <feOffset dx="1" dy="1"/>
                                                                <feGaussianBlur stdDeviation="1"/>
                                                                <feComposite in2="hardAlpha" operator="out"/>
                                                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2230_3"/>
                                                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2230_3" result="shape"/>
                                                            </filter>
                                                        </defs>
                                                    </svg>
                                                    <span class="text-[12px] mr-11">Users</span>
                                                    <span class="-mr-0 ml-auto mt-[2px] h-3 w-3 shrink-0 rotate-[-180deg] fill-[#336dec] transition-transform duration-200 ease-in-out group-[[data-te-collapse-collapsed]]:mr-0 group-[[data-te-collapse-collapsed]]:rotate-0 group-[[data-te-collapse-collapsed]]:fill-[#212529] motion-reduce:transition-none dark:fill-blue-300 dark:group-[[data-te-collapse-collapsed]]:fill-white">
                                                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-3 w-3">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                          </svg>
                                                     </span>
                                                </button>
                                            </h2>
                                            {{--Dropdown--}}
                                            <div id="collapseUsers" class="!visible hidden bg-black bg-opacity-10  py-0 px-3 rounded-bl-[10px] rounded-br-[10px] mb-3 " data-te-collapse-item aria-labelledby="userHeader" data-te-parent="#ManageUsers">
                                                <div class="ml-3 text-white border-l-[1px] py-1 border-[#DEDEDE]">
                                                    <ul class="mt-1">
                                                        <li class="text-[12px] px-2 py-1 hover:font-semibold">
                                                            <a href="{{route('admin.manageFarmers')}}" class="pl-6  ml-[-9px] hover:border-l-[3px] border-white">Farmers</a>
                                                        </li>
                                                        <li class="text-[12px] px-2 py-1  hover:font-semibold">
                                                            <a href="{{route('admin.manageBidders')}}" class="pl-6  ml-[-9px] hover:border-l-[3px] border-white">Bidders</a>
                                                        </li>


                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>


                                <li class="group" x-data="{ isOpen: false }"><!--Manage Reports-->
                                    <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com -->
                                    <div id="ManageReports">
                                        <div>
                                            <h2 class="mb-0" id="reportHeader">

                                                <button id="dropdownDefaultButton"  @click="isOpen = !isOpen" :aria-expanded="isOpen.toString()" @keydown.space.prevent="isOpen = !isOpen" data-dropdown-toggle="dropdown" class="flex items-center w-full text-white gap-x-2 group rounded-md p-1 group-hover:bg-white group-hover:text-primary transition [overflow-anchor:none] hover:z-[2] focus:z-[3] focus:outline-none dark:bg-neutral-800 dark:text-white [&:not([data-te-collapse-collapsed])]:bg-white [&:not([data-te-collapse-collapsed])]:text-primary  [&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(229,231,235)] dark:[&:not([data-te-collapse-collapsed])]:bg-neutral-800 dark:[&:not([data-te-collapse-collapsed])]:text-primary-400 dark:[&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(75,85,99)]"
                                                        type="button"
                                                        data-te-collapse-init
                                                        data-te-collapse-collapsed
                                                        data-te-target="#collapseReports"
                                                        aria-expanded="false"
                                                        aria-controls="collapseReports">

                                                    <svg class="ml-2"  width="28" height="27" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g filter="url(#filter0_d_2054_15)">
                                                            <rect  :class="{ 'fill-primary': isOpen }" class="group-hover:fill-primary" x="1" y="1" width="24" height="23" rx="5" fill="white"/>
                                                        </g>
                                                        <mask id="mask0_2054_15" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="7" y="15" width="5" height="5">
                                                            <path :class="{ 'fill-white': isOpen }"  d="M7.53906 15.4072H11.0536V19.5377H7.53906V15.4072Z" fill="white" class="group-hover:fill-white"/>
                                                        </mask>
                                                        <g mask="url(#mask0_2054_15)">
                                                            <path :class="{ 'fill-white': isOpen }" d="M7.54688 19.5375H11.053C10.3668 18.0818 10.1047 16.4525 10.0046 15.418C8.0149 16.5046 7.6224 18.8032 7.54688 19.5375Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                                        </g>
                                                        <mask id="mask1_2054_15" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="14" y="15" width="4" height="5">
                                                            <path :class="{ 'fill-white': isOpen }" d="M14.1094 15.4072H17.6279V19.5377H14.1094V15.4072Z" fill="white" class="group-hover:fill-white"/>
                                                        </mask>
                                                        <g mask="url(#mask1_2054_15)">
                                                            <path :class="{ 'fill-white': isOpen }" d="M15.1696 15.418C15.0694 16.4525 14.8073 18.0818 14.1211 19.5375H17.6272C17.5504 18.8028 17.1544 16.5028 15.1696 15.418Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                                        </g>
                                                        <path :class="{ 'fill-white': isOpen }" d="M10.9503 9.84842C10.4203 9.85775 9.82265 9.86838 9.64977 9.90752C9.44223 10.1431 9.34544 11.4302 9.44664 12.648L9.46241 12.8375C10.0313 14.0007 11.2228 14.8054 12.6015 14.8054C13.9506 14.8054 15.1217 14.0353 15.7045 12.9124L15.7257 12.6017C15.7688 11.974 15.7849 10.3198 15.4388 9.33496C14.2313 9.79047 12.3608 9.82353 10.9503 9.84842Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                                        <mask id="mask2_2054_15" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="8" y="5" width="10" height="8">
                                                            <path :class="{ 'fill-white': isOpen }" d="M8.25781 5.71875H17.0726V12.704H8.25781V5.71875Z" fill="white" class="group-hover:fill-white"/>
                                                        </mask>
                                                        <g mask="url(#mask2_2054_15)">
                                                            <path :class="{ 'fill-white': isOpen }" d="M9.47923 9.48958C10.0634 9.28089 14.1097 9.62095 15.6608 8.73987C16.3608 9.92412 16.1752 12.633 16.1752 12.633C16.9348 11.4578 17.1863 10.0244 16.9972 8.88968C16.8999 8.30512 16.5833 8.09903 16.2434 8.05613C16.2572 7.99515 16.2656 7.93193 16.2656 7.86531C16.2656 6.6577 14.5244 5.71875 12.6555 5.71875C11.5017 5.71875 10.2995 6.07624 9.42722 6.94922C7.57935 8.79868 8.33021 10.715 8.99956 12.6859C8.99956 12.6859 8.75419 9.7487 9.47923 9.48958Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                                        </g>
                                                        <mask id="mask3_2054_15" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="10" y="14" width="5" height="6">
                                                            <path :class="{ 'fill-white': isOpen }" d="M10.4258 14.9814H14.7406V19.5379H10.4258V14.9814Z" fill="white" class="group-hover:fill-white"/>
                                                        </mask>
                                                        <g mask="url(#mask3_2054_15)">
                                                            <path :class="{ 'fill-white': isOpen }" d="M14.0173 14.9894C13.5779 15.1588 13.1029 15.2556 12.6046 15.2556C12.102 15.2556 11.6229 15.1575 11.1804 14.9854C10.923 15.0455 10.6736 15.1172 10.4414 15.2125C10.5296 16.2422 10.7901 18.0197 11.5574 19.5379H12.0295L12.3299 16.9796C12.0543 16.8745 11.8574 16.6093 11.8574 16.2964C11.8574 15.8917 12.1854 15.5635 12.5899 15.5635C12.9944 15.5635 13.3223 15.8917 13.3223 16.2964C13.3223 16.6093 13.1256 16.8745 12.85 16.9796L13.1504 19.5379H13.6222C14.3896 18.0197 14.65 16.2422 14.7382 15.2125C14.5115 15.1195 14.2682 15.049 14.0173 14.9894Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                                        </g>
                                                        <defs>
                                                            <filter id="filter0_d_2054_15" x="0" y="0" width="28" height="27" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                                <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                                                <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                                                <feOffset dx="1" dy="1"/>
                                                                <feGaussianBlur stdDeviation="1"/>
                                                                <feComposite in2="hardAlpha" operator="out"/>
                                                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2054_15"/>
                                                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2054_15" result="shape"/>
                                                            </filter>
                                                        </defs>
                                                    </svg>

                                                    <span class="text-[12px] mr-11">Reports</span>
                                                    <span class="-mr-0 ml-auto mt-[2px] h-3 w-3 shrink-0 rotate-[-180deg] fill-[#336dec] transition-transform duration-200 ease-in-out group-[[data-te-collapse-collapsed]]:mr-0 group-[[data-te-collapse-collapsed]]:rotate-0 group-[[data-te-collapse-collapsed]]:fill-[#212529] motion-reduce:transition-none dark:fill-blue-300 dark:group-[[data-te-collapse-collapsed]]:fill-white">
                                                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-3 w-3">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                          </svg>
                                                     </span>
                                                </button>
                                            </h2>
                                            {{--Dropdown--}}
                                            <div id="collapseReports" class="!visible hidden bg-black bg-opacity-10  py-0 px-3 rounded-bl-[10px] rounded-br-[10px] mb-3 " data-te-collapse-item aria-labelledby="reportHeader" data-te-parent="#ManageReports">
                                                <div class="ml-3 text-white border-l-[1px] py-1 border-[#DEDEDE]">
                                                    <ul class="mt-1">
                                                        <li class="text-[12px] px-2 py-1 hover:font-semibold">
                                                            <a href="{{route('admin.reportsAuctionVerifiers')}}" class="pl-6  ml-[-9px] hover:border-l-[3px] border-white">Auctions Verifier</a>
                                                        </li>
                                                        <li class="text-[12px] px-2 py-1  hover:font-semibold">
                                                            <a href="{{route('admin.reportOfferVerifiers')}}" class="pl-6  ml-[-9px] hover:border-l-[3px] border-white">Offers Verifier</a>
                                                        </li>
                                                        <li class="text-[12px] px-2 py-1 hover:font-semibold">
                                                            <a href="{{route('admin.reportsFarmerVerifiers')}}" class="pl-6  ml-[-9px] hover:border-l-[3px] border-white">Farmers Verifier</a>
                                                        </li>
                                                        <li class="text-[12px] px-2 py-1  hover:font-semibold">
                                                            <a href="{{route('admin.reportsBidderVerifiers')}}" class="pl-6  ml-[-9px] hover:border-l-[3px] border-white">Bidders Verifier</a>
                                                        </li>
                                                        <li class="text-[12px] px-2 py-1 hover:font-semibold">
                                                            <a href="{{route('admin.reportReportsVerifiers')}}" class="pl-6  ml-[-9px] hover:border-l-[3px] border-white">Reports Verifier</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li><!-- Verifier Logs -->
                                    <a href="{{route('admin.verifierlogs')}}" class="flex items-center group text-white gap-x-2 rounded-md p-1 hover:bg-white hover:text-primary">
                                        <svg class="ml-2" width="28" height="27" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g filter="url(#filter0_d_2052_6)">
                                                <rect class="group-hover:fill-primary" x="1" y="1" width="24" height="23" rx="5" fill="white"/>
                                            </g>
                                            <mask id="mask0_2052_6" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="5" y="6" width="15" height="13">
                                                <path d="M5.35156 6.5H19.9812V18.9028H5.35156V6.5Z" fill="white" class="group-hover:fill-primary"/>
                                            </mask>
                                            <g mask="url(#mask0_2052_6)">
                                                <path d="M19.6576 10.5752L17.6423 18.6026H5.73488L7.78805 10.425C7.82248 10.2878 7.94531 10.1921 8.08666 10.1921H19.359C19.4545 10.1921 19.543 10.2354 19.6019 10.3108C19.6605 10.386 19.6808 10.4823 19.6576 10.5752ZM16.0231 9.14663V9.89301H15.0262V9.14663H14.8767V9.89301H13.8797V9.14663H13.7302V9.89301H12.7334V9.14663H12.5839V9.89301H11.587V9.14663H11.4374V9.89301H10.4405V9.14663H10.2909V9.89301H9.2942V9.14663H9.1446V9.89301H8.12276V9.14663H7.97324V9.90401C7.74421 9.94719 7.55642 10.1194 7.49805 10.3522L7.41204 10.6944V9.14648H6.87464V12.835L6.39171 14.7583V8.57321H16.6944V9.89301H16.1727V9.14663H16.0231ZM5.69285 8.22504C5.69285 8.08709 5.80498 7.97497 5.94285 7.97497H7.04507V7.22931C7.04507 6.99212 7.23792 6.79919 7.47512 6.79919H8.78552C9.35127 6.79919 9.81156 7.25955 9.81156 7.82538V7.97497H17.1433C17.2812 7.97497 17.3933 8.08709 17.3933 8.22504V9.89301H16.844V8.42368H6.24219V15.3539L5.69285 17.5425V8.22504ZM19.8375 10.1267C19.7217 9.97815 19.5474 9.89301 19.359 9.89301H17.6923V8.22504C17.6923 7.92224 17.446 7.67585 17.1433 7.67585H10.1023C10.0276 7.01519 9.46564 6.5 8.78552 6.5H7.47512C7.07306 6.5 6.74595 6.82718 6.74595 7.22931V7.67585H5.94285C5.63997 7.67585 5.39374 7.92224 5.39374 8.22504V18.7337L5.35156 18.9018H17.8755L19.9476 10.648C19.9935 10.4653 19.9535 10.2752 19.8375 10.1267Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                            </g>
                                            <mask id="mask1_2052_6" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="9" y="16" width="3" height="3">
                                                <path d="M9.50781 16.1484H11.6097V18.6053H9.50781V16.1484Z" fill="white" />
                                            </mask>
                                            <g mask="url(#mask1_2052_6)">
                                                <path d="M9.51172 18.6056H11.5904C11.1835 17.7439 11.0281 16.7794 10.9688 16.167C9.78921 16.8102 9.5565 18.1709 9.51172 18.6056Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                            </g>
                                            <mask id="mask2_2052_6" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="13" y="16" width="3" height="3">
                                                <path d="M13.4062 16.1484H15.4942V18.6053H13.4062V16.1484Z" fill="white"/>
                                            </mask>
                                            <g mask="url(#mask2_2052_6)">
                                                <path d="M14.0318 16.167C13.9724 16.7794 13.817 17.7439 13.4102 18.6056H15.4888C15.4432 18.1707 15.2085 16.8091 14.0318 16.167Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                            </g>
                                            <path d="M11.5325 12.8694C11.2183 12.8749 10.8641 12.8812 10.7615 12.9043C10.6385 13.0438 10.5812 13.8057 10.6411 14.5266L10.6505 14.6388C10.9877 15.3274 11.6941 15.8037 12.5115 15.8037C13.3113 15.8037 14.0056 15.3478 14.351 14.6831L14.3636 14.4992C14.3892 14.1276 14.3987 13.1484 14.1936 12.5654C13.4776 12.835 12.3688 12.8546 11.5325 12.8694Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                            <mask id="mask3_2052_6" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="9" y="10" width="7" height="5">
                                                <path d="M9.92578 10.4248H15.1665V14.5559H9.92578V10.4248Z" fill="white"/>
                                            </mask>
                                            <g mask="url(#mask3_2052_6)">
                                                <path d="M10.657 12.657C11.0033 12.5335 13.4021 12.7348 14.3217 12.2132C14.7367 12.9142 14.6267 14.5178 14.6267 14.5178C15.077 13.8222 15.2261 12.9736 15.114 12.3019C15.0563 11.9558 14.8687 11.8339 14.6671 11.8085C14.6753 11.7724 14.6803 11.7349 14.6803 11.6955C14.6803 10.9806 13.648 10.4248 12.54 10.4248C11.856 10.4248 11.1433 10.6365 10.6262 11.1532C9.53062 12.2481 9.97579 13.3824 10.3726 14.5492C10.3726 14.5492 10.2272 12.8104 10.657 12.657Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                            </g>
                                            <mask id="mask4_2052_6" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="11" y="15" width="3" height="4">
                                                <path d="M11.2227 15.9072H13.7782V18.6049H11.2227V15.9072Z" fill="white"/>
                                            </mask>
                                            <g mask="url(#mask4_2052_6)">
                                                <path d="M13.3465 15.9125C13.086 16.0129 12.8044 16.0702 12.509 16.0702C12.2111 16.0702 11.927 16.0121 11.6647 15.9102C11.5121 15.9458 11.3642 15.9883 11.2266 16.0446C11.2789 16.6542 11.4333 17.7064 11.8882 18.6051H12.168L12.3462 17.0907C12.1827 17.0285 12.0661 16.8715 12.0661 16.6863C12.0661 16.4467 12.2605 16.2524 12.5004 16.2524C12.7401 16.2524 12.9345 16.4467 12.9345 16.6863C12.9345 16.8715 12.8179 17.0285 12.6544 17.0907L12.8326 18.6051H13.1123C13.5673 17.7064 13.7216 16.6542 13.7739 16.0446C13.6395 15.9896 13.4952 15.9478 13.3465 15.9125Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                            </g>
                                            <defs>
                                                <filter id="filter0_d_2052_6" x="0" y="0" width="28" height="27" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                                    <feOffset dx="1" dy="1"/>
                                                    <feGaussianBlur stdDeviation="1"/>
                                                    <feComposite in2="hardAlpha" operator="out"/>
                                                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2052_6"/>
                                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2052_6" result="shape"/>
                                                </filter>
                                            </defs>
                                        </svg>


                                        <span class=" text-[12px]">Verifier Logs</span>
                                    </a>
                                </li>

                                <li><!-- User Logs -->
                                    <a href="{{route('admin.userlogs')}}" class="flex items-center group text-white gap-x-2 rounded-md p-1  hover:bg-white hover:text-primary">

                                        <svg class="ml-2" width="28" height="27" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g filter="url(#filter0_d_2052_7)">
                                                <rect x="1" y="1" width="24" height="23" rx="5" fill="white" class="group-hover:fill-primary"/>
                                            </g>
                                            <mask id="mask0_2052_7" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="5" y="6" width="15" height="13">
                                                <path d="M5.35156 6.5H19.9812V18.9028H5.35156V6.5Z" fill="white"/>
                                            </mask>
                                            <g mask="url(#mask0_2052_7)">
                                                <path d="M19.6576 10.5752L17.6423 18.6026H5.73488L7.78805 10.425C7.82248 10.2878 7.94531 10.1921 8.08666 10.1921H19.359C19.4545 10.1921 19.543 10.2354 19.6019 10.3108C19.6605 10.386 19.6808 10.4823 19.6576 10.5752ZM16.0231 9.14663V9.89301H15.0262V9.14663H14.8767V9.89301H13.8797V9.14663H13.7302V9.89301H12.7334V9.14663H12.5839V9.89301H11.587V9.14663H11.4374V9.89301H10.4405V9.14663H10.2909V9.89301H9.2942V9.14663H9.1446V9.89301H8.12276V9.14663H7.97323V9.90401C7.74421 9.94719 7.55642 10.1194 7.49805 10.3522L7.41204 10.6944V9.14648H6.87464V12.835L6.39171 14.7583V8.57321H16.6944V9.89301H16.1727V9.14663H16.0231ZM5.69285 8.22504C5.69285 8.08709 5.80498 7.97497 5.94285 7.97497H7.04507V7.22931C7.04507 6.99212 7.23792 6.79919 7.47512 6.79919H8.78552C9.35127 6.79919 9.81156 7.25955 9.81156 7.82538V7.97497H17.1433C17.2812 7.97497 17.3933 8.08709 17.3933 8.22504V9.89301H16.844V8.42368H6.24219V15.3539L5.69285 17.5425V8.22504ZM19.8375 10.1267C19.7217 9.97815 19.5474 9.89301 19.359 9.89301H17.6923V8.22504C17.6923 7.92224 17.446 7.67585 17.1433 7.67585H10.1023C10.0276 7.01519 9.46564 6.5 8.78552 6.5H7.47512C7.07306 6.5 6.74595 6.82718 6.74595 7.22931V7.67585H5.94285C5.63997 7.67585 5.39374 7.92224 5.39374 8.22504V18.7337L5.35156 18.9018H17.8755L19.9476 10.648C19.9935 10.4653 19.9535 10.2752 19.8375 10.1267Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                            </g>
                                            <path d="M12.4974 14.3499C13.1647 14.3499 13.706 13.8086 13.706 13.1415C13.706 12.4736 13.1647 11.9326 12.4974 11.9326C11.83 11.9326 11.2891 12.4736 11.2891 13.1415C11.2891 13.8085 11.83 14.3499 12.4974 14.3499Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                            <mask id="mask1_2052_7" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="10" y="14" width="5" height="5">
                                                <path d="M10.2969 14.7412H14.7043V18.5003H10.2969V14.7412Z" fill="white"/>
                                            </mask>
                                            <g mask="url(#mask1_2052_7)">
                                                <path d="M13.6039 14.7529H13.3068L12.501 15.9619L11.6955 14.7531H11.3984C10.7944 14.7531 10.305 15.2428 10.305 15.8465L10.3047 18.4942H11.0998V16.2353C11.0998 16.1847 11.1408 16.1441 11.1909 16.1441C11.2415 16.1441 11.282 16.1847 11.282 16.2353V18.4942H13.7199V16.2353C13.7199 16.1847 13.7609 16.1441 13.8111 16.1441C13.8615 16.1441 13.9021 16.1847 13.9021 16.2353V18.4942H14.6973V15.8465C14.6973 15.2428 14.2078 14.7529 13.6039 14.7529Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                            </g>
                                            <mask id="mask2_2052_7" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="14" y="11" width="3" height="3">
                                                <path d="M14.4805 11.208H16.7027V13.4258H14.4805V11.208Z" fill="white"/>
                                            </mask>
                                            <g mask="url(#mask2_2052_7)">
                                                <path d="M15.5898 13.4144C16.2002 13.4144 16.6952 12.9188 16.6952 12.3087C16.6952 11.6979 16.2002 11.2031 15.5898 11.2031C14.9794 11.2031 14.4844 11.6979 14.4844 12.3087C14.4844 12.919 14.9794 13.4144 15.5898 13.4144Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                            </g>
                                            <mask id="mask3_2052_7" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="8" y="11" width="3" height="3">
                                                <path d="M8.29688 11.208H10.5191V13.4258H8.29688V11.208Z" fill="white"/>
                                            </mask>
                                            <g mask="url(#mask3_2052_7)">
                                                <path d="M9.40625 13.4144C10.0163 13.4144 10.5114 12.9188 10.5114 12.3087C10.5114 11.6979 10.0163 11.2031 9.40625 11.2031C8.79593 11.2031 8.30078 11.6979 8.30078 12.3087C8.30093 12.919 8.79593 13.4144 9.40625 13.4144Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                            </g>
                                            <path d="M16.5992 13.7822H16.3273L15.5906 14.8878L14.8539 13.7822H14.582C14.1025 13.7822 13.703 14.12 13.6055 14.5703C14.3061 14.5732 14.8757 15.1441 14.8757 15.8454V17.2037H16.7057V15.1377C16.7057 15.0914 16.7427 15.0544 16.7889 15.0544C16.8349 15.0544 16.8722 15.0914 16.8722 15.1377V17.2036H17.5992V14.7824C17.5992 14.23 17.1515 13.7822 16.5992 13.7822Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                            <path d="M8.12558 15.1378C8.12558 15.0915 8.16298 15.0546 8.20877 15.0546C8.25506 15.0546 8.29203 15.0915 8.29203 15.1378V17.2037H10.122L10.1224 15.8455C10.1224 15.1442 10.6916 14.5737 11.3919 14.5703C11.2948 14.12 10.8951 13.7822 10.4157 13.7822H10.1438L9.40712 14.8879L8.67036 13.7822H8.39844C7.84606 13.7822 7.39844 14.2301 7.39844 14.7824V17.2037H8.12558V15.1378Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                            <defs>
                                                <filter id="filter0_d_2052_7" x="0" y="0" width="28" height="27" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                                    <feOffset dx="1" dy="1"/>
                                                    <feGaussianBlur stdDeviation="1"/>
                                                    <feComposite in2="hardAlpha" operator="out"/>
                                                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2052_7"/>
                                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2052_7" result="shape"/>
                                                </filter>
                                            </defs>
                                        </svg>


                                        <span class=" text-[12px]">User Logs</span>
                                    </a>
                                </li>

                                <li><!-- Category -->
                                    <a href="#" class="flex items-center group text-white gap-x-2 rounded-md p-1  hover:bg-white hover:text-primary">

                                        <svg class="ml-2" width="28" height="27" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g filter="url(#filter0_d_2052_8)">
                                                <rect class="group-hover:fill-primary" x="1" y="1" width="24" height="23" rx="5" fill="white"/>
                                            </g>
                                            <g clip-path="url(#clip0_2052_8)">
                                                <mask id="mask0_2052_8" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="5" y="12" width="7" height="8">
                                                    <path d="M5.17188 12.9443H11.998V19.7848H5.17188V12.9443Z" fill="white"/>
                                                </mask>
                                                <g mask="url(#mask0_2052_8)">
                                                    <path d="M11.9955 13.8581V17.3494C11.9955 17.3893 11.9945 17.4291 11.9925 17.4689C11.9905 17.5087 11.9876 17.5484 11.9837 17.588C11.9797 17.6277 11.9748 17.6672 11.9689 17.7066C11.963 17.746 11.9562 17.7853 11.9484 17.8244C11.9406 17.8634 11.9319 17.9023 11.9222 17.9409C11.9124 17.9796 11.9018 18.0179 11.8902 18.0561C11.8786 18.0942 11.8661 18.132 11.8526 18.1695C11.8392 18.207 11.8249 18.2441 11.8096 18.281C11.7943 18.3178 11.7781 18.3542 11.7611 18.3902C11.7441 18.4262 11.7261 18.4618 11.7073 18.4969C11.6886 18.532 11.6689 18.5667 11.6484 18.6008C11.6279 18.6351 11.6066 18.6687 11.5845 18.7018C11.5624 18.735 11.5394 18.7675 11.5156 18.7995C11.4919 18.8315 11.4674 18.8629 11.4421 18.8937C11.4168 18.9245 11.3908 18.9546 11.3641 18.9842C11.3373 19.0137 11.3098 19.0425 11.2817 19.0707C11.2535 19.0989 11.2246 19.1264 11.1951 19.1531C11.1656 19.1798 11.1354 19.2059 11.1046 19.2312C11.0739 19.2564 11.0425 19.281 11.0104 19.3047C10.9784 19.3284 10.9459 19.3513 10.9128 19.3736C10.8796 19.3957 10.846 19.417 10.8118 19.4375C10.7776 19.458 10.743 19.4776 10.7079 19.4964C10.6727 19.5152 10.6372 19.5331 10.6011 19.5502C10.5651 19.5672 10.5287 19.5834 10.4919 19.5987C10.4552 19.6139 10.418 19.6283 10.3804 19.6417C10.343 19.6552 10.3051 19.6677 10.267 19.6793C10.2289 19.6908 10.1905 19.7015 10.1518 19.7112C10.1132 19.7209 10.0744 19.7297 10.0353 19.7374C9.99624 19.7452 9.95696 19.7521 9.91753 19.758C9.87818 19.7638 9.83861 19.7687 9.79897 19.7726C9.75933 19.7766 9.71962 19.7796 9.67983 19.7815C9.64005 19.7836 9.60019 19.7846 9.56033 19.7846H7.60706C7.56727 19.7846 7.52742 19.7836 7.48763 19.7815C7.44784 19.7796 7.40813 19.7766 7.36849 19.7726C7.32885 19.7687 7.28928 19.7638 7.24986 19.758C7.2105 19.7521 7.17122 19.7452 7.13216 19.7374C7.0931 19.7297 7.05425 19.7209 7.01555 19.7112C6.97692 19.7015 6.93859 19.6908 6.90046 19.6793C6.86234 19.6677 6.82451 19.6552 6.78696 19.6417C6.74949 19.6283 6.71231 19.6139 6.67549 19.5987C6.63874 19.5834 6.60229 19.5672 6.56633 19.5502C6.53031 19.5331 6.49472 19.5152 6.45956 19.4964C6.42448 19.4776 6.38983 19.458 6.35561 19.4375C6.32147 19.417 6.28783 19.3957 6.2547 19.3736C6.22157 19.3513 6.18902 19.3284 6.15697 19.3047C6.125 19.281 6.09361 19.2564 6.06279 19.2312C6.03205 19.2059 6.00188 19.1798 5.97237 19.1531C5.94285 19.1264 5.91399 19.0989 5.88578 19.0707C5.85764 19.0425 5.83015 19.0137 5.80339 18.9842C5.77662 18.9546 5.75065 18.9245 5.72533 18.8937C5.70009 18.8629 5.67556 18.8315 5.65184 18.7995C5.62804 18.7675 5.60511 18.735 5.58297 18.7018C5.56084 18.6687 5.5395 18.6351 5.51902 18.6008C5.49855 18.5667 5.47888 18.532 5.46007 18.4969C5.44133 18.4618 5.42339 18.4262 5.40632 18.3902C5.38925 18.3542 5.37312 18.3178 5.35786 18.281C5.34259 18.2441 5.32827 18.207 5.31481 18.1695C5.30136 18.132 5.28885 18.0942 5.27727 18.0561C5.2657 18.0179 5.25499 17.9795 5.2453 17.9409C5.2356 17.9023 5.22685 17.8634 5.21904 17.8244C5.21123 17.7853 5.20443 17.746 5.19857 17.7066C5.19264 17.6672 5.18779 17.6277 5.18381 17.588C5.1799 17.5484 5.17694 17.5087 5.17491 17.4689C5.17296 17.4291 5.17195 17.3893 5.17188 17.3494V15.3961C5.17195 15.3563 5.17296 15.3165 5.17491 15.2767C5.17694 15.2369 5.1799 15.1972 5.18381 15.1576C5.18779 15.1178 5.19264 15.0783 5.19857 15.0389C5.20443 14.9995 5.21123 14.9603 5.21904 14.9212C5.22685 14.8822 5.2356 14.8433 5.2453 14.8046C5.25499 14.766 5.2657 14.7276 5.27727 14.6895C5.28885 14.6514 5.30136 14.6136 5.31481 14.576C5.32827 14.5386 5.34259 14.5014 5.35786 14.4646C5.37312 14.4278 5.38925 14.3913 5.40632 14.3553C5.42339 14.3194 5.44133 14.2838 5.46007 14.2486C5.47888 14.2135 5.49855 14.1789 5.51902 14.1447C5.5395 14.1105 5.56084 14.0769 5.58297 14.0438C5.60511 14.0106 5.62804 13.9781 5.65184 13.946C5.67556 13.9141 5.70009 13.8827 5.72533 13.8519C5.75065 13.8211 5.77662 13.7909 5.80339 13.7614C5.83015 13.7318 5.85764 13.7031 5.88578 13.6748C5.91399 13.6467 5.94285 13.6192 5.97237 13.5924C6.00188 13.5657 6.03205 13.5396 6.06279 13.5144C6.09361 13.4891 6.125 13.4646 6.15697 13.4409C6.18902 13.4171 6.22157 13.3942 6.2547 13.372C6.28783 13.3499 6.32147 13.3286 6.35561 13.3081C6.38983 13.2876 6.42448 13.2679 6.45956 13.2491C6.49472 13.2303 6.53031 13.2125 6.56633 13.1954C6.60229 13.1783 6.63874 13.1622 6.67549 13.1469C6.71231 13.1317 6.74949 13.1173 6.78696 13.1039C6.82451 13.0904 6.86234 13.0779 6.90046 13.0663C6.93859 13.0548 6.97692 13.0441 7.01555 13.0344C7.05425 13.0247 7.0931 13.0159 7.13216 13.0081C7.17122 13.0003 7.2105 12.9935 7.24986 12.9876C7.28928 12.9817 7.32885 12.9769 7.36849 12.9729C7.40813 12.969 7.44784 12.966 7.48763 12.964C7.52742 12.962 7.56727 12.961 7.60706 12.9609H11.0984C11.1277 12.961 11.157 12.9625 11.1863 12.9654C11.2155 12.9682 11.2445 12.9726 11.2734 12.9784C11.3022 12.9841 11.3306 12.9912 11.3587 12.9998C11.3868 13.0084 11.4144 13.0182 11.4416 13.0295C11.4687 13.0408 11.4952 13.0533 11.5211 13.0672C11.547 13.081 11.5722 13.0961 11.5966 13.1125C11.621 13.1288 11.6445 13.1463 11.6672 13.1649C11.69 13.1835 11.7117 13.2033 11.7325 13.224C11.7533 13.2448 11.7729 13.2666 11.7916 13.2892C11.8103 13.3119 11.8277 13.3355 11.844 13.36C11.8604 13.3843 11.8754 13.4095 11.8893 13.4354C11.9031 13.4613 11.9157 13.4878 11.927 13.515C11.9382 13.5421 11.9481 13.5697 11.9567 13.5978C11.9652 13.6259 11.9724 13.6544 11.9782 13.6832C11.9839 13.712 11.9882 13.741 11.9911 13.7703C11.9941 13.7995 11.9955 13.8288 11.9955 13.8581Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                                </g>
                                                <mask id="mask1_2052_8" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="12" y="12" width="8" height="8">
                                                    <path d="M12.9453 12.9443H19.7858V19.7848H12.9453V12.9443Z" fill="white"/>
                                                </mask>
                                                <g mask="url(#mask1_2052_8)">
                                                    <path d="M19.7846 15.3961V17.3494C19.7846 17.3893 19.7836 17.4291 19.7815 17.4689C19.7796 17.5087 19.7766 17.5484 19.7726 17.588C19.7687 17.6277 19.7638 17.6672 19.758 17.7066C19.7521 17.746 19.7452 17.7853 19.7374 17.8244C19.7297 17.8634 19.7209 17.9023 19.7112 17.9409C19.7015 17.9796 19.6908 18.0179 19.6793 18.0561C19.6677 18.0942 19.6552 18.132 19.6417 18.1695C19.6283 18.207 19.6139 18.2441 19.5987 18.281C19.5834 18.3178 19.5672 18.3542 19.5502 18.3902C19.5331 18.4262 19.5152 18.4618 19.4964 18.4969C19.4776 18.532 19.458 18.5667 19.4375 18.6008C19.417 18.6351 19.3957 18.6687 19.3736 18.7018C19.3513 18.735 19.3284 18.7675 19.3047 18.7995C19.281 18.8315 19.2564 18.8629 19.2312 18.8937C19.2059 18.9245 19.1798 18.9546 19.1531 18.9842C19.1264 19.0137 19.0989 19.0425 19.0707 19.0707C19.0425 19.0989 19.0137 19.1264 18.9842 19.1531C18.9546 19.1798 18.9245 19.2059 18.8937 19.2312C18.8629 19.2564 18.8315 19.281 18.7995 19.3047C18.7675 19.3284 18.735 19.3513 18.7018 19.3736C18.6687 19.3957 18.6351 19.417 18.6008 19.4375C18.5667 19.458 18.532 19.4776 18.4969 19.4964C18.4618 19.5152 18.4262 19.5331 18.3902 19.5502C18.3542 19.5672 18.3178 19.5834 18.281 19.5987C18.2441 19.6139 18.207 19.6283 18.1695 19.6417C18.132 19.6552 18.0942 19.6677 18.0561 19.6793C18.0179 19.6908 17.9795 19.7015 17.9409 19.7112C17.9023 19.7209 17.8634 19.7297 17.8244 19.7374C17.7853 19.7452 17.746 19.7521 17.7066 19.758C17.6672 19.7638 17.6277 19.7687 17.588 19.7726C17.5484 19.7766 17.5087 19.7796 17.4689 19.7815C17.4291 19.7836 17.3893 19.7846 17.3494 19.7846H15.3961C15.3563 19.7846 15.3165 19.7836 15.2767 19.7815C15.2369 19.7796 15.1972 19.7766 15.1576 19.7726C15.1178 19.7687 15.0783 19.7638 15.0389 19.758C14.9995 19.7521 14.9603 19.7452 14.9212 19.7374C14.8822 19.7297 14.8433 19.7209 14.8046 19.7112C14.766 19.7015 14.7276 19.6908 14.6895 19.6793C14.6514 19.6677 14.6136 19.6552 14.576 19.6417C14.5386 19.6283 14.5014 19.6139 14.4646 19.5987C14.4278 19.5834 14.3913 19.5672 14.3553 19.5502C14.3194 19.5331 14.2838 19.5152 14.2486 19.4964C14.2135 19.4776 14.1789 19.458 14.1447 19.4375C14.1105 19.417 14.0769 19.3957 14.0438 19.3736C14.0106 19.3513 13.9781 19.3284 13.946 19.3047C13.9141 19.281 13.8827 19.2564 13.8519 19.2312C13.8211 19.2059 13.7909 19.1798 13.7614 19.1531C13.7318 19.1264 13.7031 19.0989 13.6748 19.0707C13.6467 19.0425 13.6192 19.0137 13.5924 18.9842C13.5657 18.9546 13.5396 18.9245 13.5144 18.8937C13.4891 18.8629 13.4646 18.8315 13.4409 18.7995C13.4171 18.7675 13.3942 18.735 13.372 18.7018C13.3499 18.6687 13.3286 18.6351 13.3081 18.6008C13.2876 18.5667 13.2679 18.532 13.2491 18.4969C13.2303 18.4618 13.2125 18.4262 13.1954 18.3902C13.1783 18.3542 13.1622 18.3178 13.1469 18.281C13.1317 18.2442 13.1173 18.207 13.1039 18.1695C13.0904 18.132 13.0779 18.0942 13.0663 18.0561C13.0548 18.0179 13.0441 17.9796 13.0344 17.9409C13.0247 17.9023 13.0159 17.8634 13.0081 17.8244C13.0003 17.7853 12.9935 17.746 12.9876 17.7066C12.9817 17.6672 12.9769 17.6277 12.9729 17.588C12.969 17.5484 12.966 17.5087 12.964 17.4689C12.962 17.4291 12.961 17.3893 12.9609 17.3494V13.8581C12.961 13.8288 12.9625 13.7995 12.9654 13.7703C12.9682 13.741 12.9726 13.712 12.9784 13.6832C12.9841 13.6544 12.9912 13.6259 12.9998 13.5978C13.0084 13.5697 13.0182 13.5421 13.0295 13.515C13.0408 13.4878 13.0533 13.4613 13.0672 13.4354C13.081 13.4095 13.0961 13.3843 13.1125 13.36C13.1288 13.3355 13.1463 13.3119 13.1649 13.2892C13.1835 13.2666 13.2033 13.2448 13.224 13.224C13.2448 13.2033 13.2666 13.1835 13.2892 13.1649C13.3119 13.1463 13.3355 13.1288 13.36 13.1125C13.3843 13.0961 13.4095 13.081 13.4354 13.0672C13.4613 13.0533 13.4878 13.0408 13.515 13.0295C13.5421 13.0182 13.5697 13.0084 13.5978 12.9998C13.6259 12.9912 13.6544 12.9841 13.6832 12.9784C13.712 12.9726 13.741 12.9682 13.7703 12.9654C13.7995 12.9625 13.8288 12.961 13.8581 12.9609H17.3494C17.3893 12.961 17.4291 12.962 17.4689 12.964C17.5087 12.966 17.5484 12.969 17.588 12.9729C17.6277 12.9769 17.6672 12.9817 17.7066 12.9876C17.746 12.9935 17.7853 13.0003 17.8244 13.0081C17.8634 13.0159 17.9023 13.0247 17.9409 13.0344C17.9796 13.0441 18.0179 13.0547 18.0561 13.0663C18.0942 13.0779 18.132 13.0904 18.1695 13.1039C18.207 13.1173 18.2441 13.1317 18.281 13.1469C18.3178 13.1622 18.3542 13.1783 18.3902 13.1954C18.4262 13.2125 18.4618 13.2303 18.4969 13.2491C18.532 13.2679 18.5667 13.2876 18.6008 13.3081C18.6351 13.3286 18.6687 13.3499 18.7018 13.372C18.735 13.3942 18.7675 13.4171 18.7995 13.4409C18.8315 13.4646 18.8629 13.4891 18.8937 13.5144C18.9245 13.5396 18.9546 13.5657 18.9842 13.5924C19.0137 13.6192 19.0425 13.6467 19.0707 13.6748C19.0989 13.7031 19.1264 13.7318 19.1531 13.7614C19.1798 13.7909 19.2059 13.8211 19.2312 13.8519C19.2564 13.8827 19.281 13.9141 19.3047 13.946C19.3284 13.9781 19.3513 14.0106 19.3736 14.0438C19.3957 14.0769 19.417 14.1105 19.4375 14.1447C19.458 14.1789 19.4776 14.2135 19.4964 14.2486C19.5152 14.2838 19.5331 14.3194 19.5502 14.3553C19.5672 14.3913 19.5834 14.4278 19.5987 14.4646C19.6139 14.5014 19.6283 14.5386 19.6417 14.576C19.6552 14.6136 19.6677 14.6514 19.6793 14.6895C19.6908 14.7276 19.7015 14.766 19.7112 14.8046C19.7209 14.8433 19.7297 14.8822 19.7374 14.9212C19.7452 14.9603 19.7521 14.9996 19.758 15.0389C19.7638 15.0783 19.7687 15.1178 19.7726 15.1576C19.7766 15.1972 19.7796 15.2369 19.7815 15.2767C19.7836 15.3165 19.7846 15.3563 19.7846 15.3961Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                                </g>
                                                <mask id="mask2_2052_8" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="5" y="5" width="7" height="7">
                                                    <path d="M5.17188 5.17383H11.998V12H5.17188V5.17383Z" fill="white"/>
                                                </mask>
                                                <g mask="url(#mask2_2052_8)">
                                                    <path d="M11.9955 7.60901V11.1003C11.9955 11.1297 11.9941 11.159 11.9911 11.1882C11.9882 11.2174 11.9839 11.2465 11.9782 11.2753C11.9724 11.3041 11.9652 11.3325 11.9567 11.3607C11.9481 11.3887 11.9382 11.4164 11.927 11.4435C11.9157 11.4706 11.9031 11.4972 11.8893 11.5231C11.8754 11.549 11.8604 11.5741 11.844 11.5985C11.8277 11.623 11.8103 11.6465 11.7916 11.6692C11.7729 11.6919 11.7533 11.7137 11.7325 11.7344C11.7117 11.7552 11.69 11.7749 11.6672 11.7935C11.6445 11.8122 11.621 11.8296 11.5966 11.846C11.5722 11.8623 11.547 11.8774 11.5211 11.8913C11.4952 11.9051 11.4687 11.9177 11.4416 11.929C11.4144 11.9402 11.3868 11.9501 11.3587 11.9586C11.3306 11.9672 11.3022 11.9743 11.2734 11.9801C11.2445 11.9858 11.2155 11.9902 11.1863 11.9931C11.157 11.996 11.1277 11.9975 11.0984 11.9975H7.60706C7.56727 11.9975 7.52742 11.9965 7.48763 11.9944C7.44784 11.9925 7.40813 11.9895 7.36849 11.9856C7.32885 11.9816 7.28928 11.9767 7.24986 11.9708C7.2105 11.965 7.17122 11.9581 7.13216 11.9504C7.0931 11.9426 7.05425 11.9338 7.01555 11.9241C6.97692 11.9144 6.93859 11.9037 6.90046 11.8921C6.86234 11.8806 6.82451 11.8681 6.78696 11.8546C6.74949 11.8411 6.71231 11.8268 6.67549 11.8116C6.63874 11.7963 6.60229 11.7801 6.56633 11.7631C6.53031 11.746 6.49472 11.7281 6.45956 11.7093C6.42448 11.6905 6.38983 11.6709 6.35561 11.6504C6.32147 11.6298 6.28783 11.6086 6.2547 11.5864C6.22157 11.5643 6.18902 11.5413 6.15697 11.5176C6.125 11.4939 6.09361 11.4693 6.06279 11.4441C6.03205 11.4188 6.00188 11.3928 5.97237 11.366C5.94285 11.3393 5.91399 11.3118 5.88578 11.2836C5.85764 11.2554 5.83015 11.2266 5.80339 11.197C5.77662 11.1675 5.75065 11.1374 5.72533 11.1066C5.70009 11.0758 5.67556 11.0444 5.65184 11.0124C5.62804 10.9804 5.60511 10.9478 5.58297 10.9147C5.56084 10.8816 5.5395 10.8479 5.51902 10.8138C5.49855 10.7796 5.47888 10.7449 5.46007 10.7099C5.44133 10.6747 5.42339 10.6391 5.40632 10.6031C5.38925 10.5671 5.37312 10.5307 5.35786 10.4939C5.34259 10.4571 5.32827 10.4199 5.31481 10.3824C5.30136 10.3449 5.28885 10.3071 5.27727 10.269C5.2657 10.2308 5.25499 10.1925 5.2453 10.1538C5.2356 10.1152 5.22685 10.0763 5.21904 10.0373C5.21123 9.99819 5.20443 9.95891 5.19857 9.91949C5.19264 9.88014 5.18779 9.84057 5.18381 9.80093C5.1799 9.76128 5.17694 9.72157 5.17491 9.68179C5.17296 9.642 5.17195 9.60214 5.17188 9.56228V7.60901C5.17195 7.56923 5.17296 7.52937 5.17491 7.48958C5.17694 7.4498 5.1799 7.41008 5.18381 7.37044C5.18779 7.3308 5.19264 7.29123 5.19857 7.25181C5.20443 7.21246 5.21123 7.17318 5.21904 7.13411C5.22685 7.09505 5.2356 7.05621 5.2453 7.01751C5.25499 6.97888 5.2657 6.94054 5.27727 6.90242C5.28885 6.86429 5.30136 6.82646 5.31481 6.78892C5.32827 6.75145 5.34259 6.71427 5.35786 6.67745C5.37312 6.6407 5.38925 6.60424 5.40632 6.56829C5.42339 6.53226 5.44133 6.49667 5.46007 6.46152C5.47888 6.42643 5.49855 6.39178 5.51902 6.35757C5.5395 6.32342 5.56084 6.28979 5.58297 6.25666C5.60511 6.22352 5.62804 6.19097 5.65184 6.15893C5.67556 6.12695 5.70009 6.09556 5.72533 6.06474C5.75065 6.034 5.77662 6.00383 5.80339 5.97432C5.83015 5.94481 5.85764 5.91594 5.88578 5.88773C5.91399 5.85959 5.94285 5.8321 5.97237 5.80534C6.00188 5.77857 6.03205 5.7526 6.06279 5.72729C6.09361 5.70204 6.125 5.67752 6.15697 5.65379C6.18902 5.62999 6.22157 5.60706 6.2547 5.58492C6.28783 5.56279 6.32147 5.54145 6.35561 5.52098C6.38983 5.50051 6.42448 5.48083 6.45956 5.46202C6.49472 5.44329 6.53031 5.42535 6.56633 5.40828C6.60229 5.3912 6.63874 5.37507 6.67549 5.35981C6.71231 5.34455 6.74949 5.33022 6.78696 5.31677C6.82451 5.30331 6.86234 5.2908 6.90046 5.27922C6.93859 5.26765 6.97692 5.25694 7.01555 5.24725C7.05425 5.23756 7.0931 5.2288 7.13216 5.22099C7.17122 5.21318 7.2105 5.20638 7.24986 5.20052C7.28928 5.19459 7.32885 5.18974 7.36849 5.18576C7.40813 5.18186 7.44784 5.17889 7.48763 5.17687C7.52742 5.17491 7.56727 5.1739 7.60706 5.17383H9.56033C9.60019 5.1739 9.64005 5.17491 9.67983 5.17687C9.71962 5.17889 9.75933 5.18186 9.79897 5.18576C9.83861 5.18974 9.87818 5.19459 9.91753 5.20052C9.95696 5.20638 9.99624 5.21318 10.0353 5.22099C10.0744 5.2288 10.1132 5.23756 10.1518 5.24725C10.1905 5.25694 10.2289 5.26765 10.267 5.27922C10.3051 5.2908 10.343 5.30331 10.3804 5.31677C10.418 5.33022 10.4552 5.34455 10.4919 5.35981C10.5287 5.37507 10.5651 5.3912 10.6011 5.40828C10.6372 5.42535 10.6727 5.44329 10.7078 5.46202C10.743 5.48083 10.7776 5.50051 10.8118 5.52098C10.846 5.54145 10.8796 5.56279 10.9128 5.58492C10.9459 5.60706 10.9784 5.62999 11.0104 5.65379C11.0425 5.67752 11.0739 5.70204 11.1046 5.72729C11.1354 5.7526 11.1656 5.77857 11.1951 5.80534C11.2246 5.8321 11.2535 5.85959 11.2817 5.88773C11.3098 5.91594 11.3373 5.94481 11.3641 5.97432C11.3908 6.00383 11.4168 6.034 11.4421 6.06474C11.4674 6.09556 11.4919 6.12695 11.5156 6.15893C11.5394 6.19097 11.5624 6.22352 11.5845 6.25666C11.6066 6.28979 11.6279 6.32342 11.6484 6.35757C11.6689 6.39178 11.6886 6.42643 11.7073 6.46152C11.7261 6.49667 11.7441 6.53226 11.7611 6.56829C11.7781 6.60424 11.7943 6.6407 11.8096 6.67745C11.8249 6.71427 11.8392 6.75145 11.8526 6.78892C11.8661 6.82646 11.8786 6.86429 11.8902 6.90242C11.9018 6.94054 11.9124 6.97888 11.9222 7.01751C11.9319 7.05621 11.9406 7.09505 11.9484 7.13411C11.9562 7.17318 11.963 7.21246 11.9689 7.25181C11.9748 7.29123 11.9797 7.3308 11.9837 7.37044C11.9876 7.41008 11.9905 7.4498 11.9925 7.48958C11.9945 7.52937 11.9955 7.56923 11.9955 7.60901Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                                </g>
                                                <mask id="mask3_2052_8" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="12" y="5" width="8" height="7">
                                                    <path d="M12.9453 5.17383H19.7858V12H12.9453V5.17383Z" fill="white"/>
                                                </mask>
                                                <g mask="url(#mask3_2052_8)">
                                                    <path d="M19.7846 7.60901V9.56228C19.7846 9.60214 19.7836 9.642 19.7815 9.68179C19.7796 9.72157 19.7766 9.76128 19.7726 9.80093C19.7687 9.84057 19.7638 9.88014 19.758 9.91949C19.7521 9.95891 19.7452 9.99819 19.7374 10.0373C19.7297 10.0763 19.7209 10.1152 19.7112 10.1538C19.7015 10.1925 19.6908 10.2308 19.6793 10.269C19.6677 10.3071 19.6552 10.3449 19.6417 10.3824C19.6283 10.4199 19.6139 10.4571 19.5987 10.4939C19.5834 10.5307 19.5672 10.5671 19.5502 10.6031C19.5331 10.6391 19.5152 10.6747 19.4964 10.7098C19.4776 10.7449 19.458 10.7796 19.4375 10.8138C19.417 10.8479 19.3957 10.8816 19.3736 10.9147C19.3513 10.9478 19.3284 10.9804 19.3047 11.0124C19.281 11.0444 19.2564 11.0758 19.2312 11.1066C19.2059 11.1374 19.1798 11.1675 19.1531 11.197C19.1264 11.2266 19.0989 11.2554 19.0707 11.2836C19.0425 11.3118 19.0137 11.3393 18.9842 11.366C18.9546 11.3928 18.9245 11.4188 18.8937 11.4441C18.8629 11.4693 18.8315 11.4939 18.7995 11.5176C18.7675 11.5413 18.735 11.5643 18.7018 11.5864C18.6687 11.6086 18.6351 11.6298 18.6008 11.6504C18.5667 11.6709 18.532 11.6905 18.4969 11.7093C18.4618 11.7281 18.4262 11.746 18.3902 11.7631C18.3542 11.7801 18.3178 11.7963 18.281 11.8116C18.2441 11.8268 18.207 11.8411 18.1695 11.8546C18.132 11.8681 18.0942 11.8806 18.0561 11.8921C18.0179 11.9037 17.9795 11.9144 17.9409 11.9241C17.9023 11.9338 17.8634 11.9426 17.8244 11.9504C17.7853 11.9581 17.746 11.965 17.7066 11.9708C17.6672 11.9767 17.6277 11.9816 17.588 11.9856C17.5484 11.9895 17.5087 11.9925 17.4689 11.9944C17.4291 11.9965 17.3893 11.9975 17.3494 11.9975H13.8581C13.8288 11.9975 13.7995 11.996 13.7703 11.9931C13.741 11.9902 13.712 11.9858 13.6832 11.9801C13.6544 11.9743 13.6259 11.9672 13.5978 11.9586C13.5697 11.9501 13.5421 11.9402 13.515 11.929C13.4878 11.9177 13.4613 11.9051 13.4354 11.8913C13.4095 11.8774 13.3843 11.8623 13.36 11.846C13.3355 11.8296 13.3119 11.8122 13.2892 11.7935C13.2666 11.7749 13.2448 11.7552 13.224 11.7344C13.2033 11.7137 13.1835 11.6919 13.1649 11.6692C13.1463 11.6465 13.1288 11.623 13.1125 11.5985C13.0961 11.5741 13.081 11.549 13.0672 11.5231C13.0533 11.4972 13.0408 11.4706 13.0295 11.4435C13.0182 11.4164 13.0084 11.3887 12.9998 11.3607C12.9912 11.3325 12.9841 11.3041 12.9784 11.2753C12.9726 11.2465 12.9682 11.2174 12.9654 11.1882C12.9625 11.159 12.961 11.1297 12.9609 11.1003V7.60901C12.961 7.56923 12.962 7.52937 12.964 7.48958C12.966 7.4498 12.969 7.41008 12.9729 7.37044C12.9769 7.3308 12.9817 7.29123 12.9876 7.25181C12.9935 7.21246 13.0003 7.17318 13.0081 7.13411C13.0159 7.09505 13.0247 7.05621 13.0344 7.01751C13.0441 6.97888 13.0548 6.94054 13.0663 6.90242C13.0779 6.86429 13.0904 6.82646 13.1039 6.78892C13.1173 6.75145 13.1317 6.71427 13.1469 6.67745C13.1622 6.6407 13.1783 6.60424 13.1954 6.56829C13.2125 6.53226 13.2303 6.49667 13.2491 6.46152C13.2679 6.42643 13.2876 6.39178 13.3081 6.35757C13.3286 6.32342 13.3499 6.28979 13.372 6.25666C13.3942 6.22352 13.4171 6.19097 13.4409 6.15893C13.4646 6.12695 13.4891 6.09556 13.5144 6.06474C13.5396 6.034 13.5657 6.00383 13.5924 5.97432C13.6192 5.94481 13.6467 5.91594 13.6748 5.88773C13.7031 5.85959 13.7318 5.8321 13.7614 5.80534C13.7909 5.77857 13.8211 5.7526 13.8519 5.72729C13.8827 5.70204 13.9141 5.67752 13.946 5.65379C13.9781 5.62999 14.0106 5.60706 14.0438 5.58492C14.0769 5.56279 14.1105 5.54145 14.1447 5.52098C14.1789 5.50051 14.2135 5.48083 14.2486 5.46202C14.2838 5.44329 14.3194 5.42535 14.3553 5.40828C14.3913 5.3912 14.4278 5.37507 14.4646 5.35981C14.5014 5.34455 14.5386 5.33022 14.576 5.31677C14.6136 5.30331 14.6514 5.2908 14.6895 5.27922C14.7276 5.26765 14.766 5.25694 14.8046 5.24725C14.8433 5.23756 14.8822 5.2288 14.9212 5.22099C14.9603 5.21318 14.9996 5.20638 15.0389 5.20052C15.0783 5.19459 15.1178 5.18974 15.1576 5.18576C15.1972 5.18186 15.2369 5.17889 15.2767 5.17687C15.3165 5.17491 15.3563 5.1739 15.3961 5.17383H17.3494C17.3893 5.1739 17.4291 5.17491 17.4689 5.17687C17.5087 5.17889 17.5484 5.18186 17.588 5.18576C17.6277 5.18974 17.6672 5.19459 17.7066 5.20052C17.746 5.20638 17.7853 5.21318 17.8244 5.22099C17.8634 5.2288 17.9023 5.23756 17.9409 5.24725C17.9796 5.25694 18.0179 5.26765 18.0561 5.27922C18.0942 5.2908 18.132 5.30331 18.1695 5.31677C18.207 5.33022 18.2441 5.34455 18.281 5.35981C18.3178 5.37507 18.3542 5.3912 18.3902 5.40828C18.4262 5.42535 18.4618 5.44329 18.4969 5.46202C18.532 5.48083 18.5667 5.50051 18.6008 5.52098C18.6351 5.54145 18.6687 5.56279 18.7018 5.58492C18.735 5.60706 18.7675 5.62999 18.7995 5.65379C18.8315 5.67752 18.8629 5.70204 18.8937 5.72729C18.9245 5.7526 18.9546 5.77857 18.9842 5.80534C19.0137 5.8321 19.0425 5.85959 19.0707 5.88773C19.0989 5.91594 19.1264 5.94481 19.1531 5.97432C19.1798 6.00383 19.2059 6.034 19.2312 6.06474C19.2564 6.09556 19.281 6.12695 19.3047 6.15893C19.3284 6.19097 19.3513 6.22352 19.3736 6.25666C19.3957 6.28979 19.417 6.32342 19.4375 6.35757C19.458 6.39178 19.4776 6.42643 19.4964 6.46152C19.5152 6.49667 19.5331 6.53226 19.5502 6.56829C19.5672 6.60424 19.5834 6.6407 19.5987 6.67745C19.6139 6.71427 19.6283 6.75145 19.6417 6.78892C19.6552 6.82646 19.6677 6.86429 19.6793 6.90242C19.6908 6.94054 19.7015 6.97888 19.7112 7.01751C19.7209 7.05621 19.7297 7.09505 19.7374 7.13411C19.7452 7.17318 19.7521 7.21246 19.758 7.25181C19.7638 7.29123 19.7687 7.3308 19.7726 7.37044C19.7766 7.41008 19.7796 7.4498 19.7815 7.48958C19.7836 7.52937 19.7846 7.56923 19.7846 7.60901Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                                </g>
                                            </g>
                                            <defs>
                                                <filter id="filter0_d_2052_8" x="0" y="0" width="28" height="27" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                                    <feOffset dx="1" dy="1"/>
                                                    <feGaussianBlur stdDeviation="1"/>
                                                    <feComposite in2="hardAlpha" operator="out"/>
                                                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2052_8"/>
                                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2052_8" result="shape"/>
                                                </filter>
                                                <clipPath id="clip0_2052_8">
                                                    <rect width="15" height="15" fill="white" transform="translate(5 5)"/>
                                                </clipPath>
                                            </defs>
                                        </svg>


                                        <span class=" text-[12px]">Category</span>
                                    </a>
                                </li>

                                <li class="mb-10"><!-- My History -->
                                    <a href="{{route('admin.history')}}" class="flex items-center group text-white gap-x-2 rounded-md p-1  hover:bg-white hover:text-primary">
                                        <svg class="ml-2" width="28" height="27" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g filter="url(#filter0_d_2052_9)">
                                                <rect class="group-hover:fill-primary"  x="1" y="1" width="24" height="23" rx="5" fill="white"/>
                                            </g>
                                            <g clip-path="url(#clip0_2052_9)">
                                                <path d="M20 12.6965C20 12.8102 19.997 12.9238 19.9909 13.0373C19.9849 13.1507 19.9759 13.264 19.9639 13.3771C19.9519 13.4902 19.9368 13.6029 19.9188 13.7153C19.9008 13.8277 19.8798 13.9396 19.8559 14.051C19.832 14.1625 19.8051 14.2733 19.7752 14.3835C19.7454 14.4937 19.7127 14.6032 19.677 14.7119C19.6414 14.8207 19.6029 14.9285 19.5616 15.0354C19.5202 15.1424 19.4761 15.2484 19.4291 15.3534C19.3821 15.4584 19.3324 15.5622 19.2799 15.6649C19.2274 15.7676 19.1723 15.8691 19.1144 15.9693C19.0566 16.0695 18.9961 16.1683 18.933 16.2658C18.8698 16.3633 18.8042 16.4592 18.736 16.5537C18.6678 16.6481 18.5972 16.741 18.5241 16.8323C18.4509 16.9235 18.3755 17.0131 18.2976 17.1009C18.2197 17.1888 18.1395 17.2748 18.0571 17.3589C17.9747 17.4431 17.8901 17.5254 17.8033 17.6058C17.7165 17.6861 17.6277 17.7645 17.5367 17.8407C17.4458 17.917 17.3528 17.9912 17.258 18.0633C17.163 18.1354 17.0663 18.2053 16.9677 18.2729C16.8691 18.3406 16.7688 18.406 16.6668 18.4692C16.5647 18.5323 16.461 18.5931 16.3558 18.6515C16.2505 18.7099 16.1437 18.7659 16.0355 18.8194C15.9272 18.873 15.8177 18.924 15.7066 18.9727C15.5957 19.0213 15.4835 19.0673 15.3702 19.1107C15.2567 19.1542 15.1423 19.1951 15.0266 19.2334C14.9111 19.2716 14.7946 19.3073 14.6771 19.3403C14.5597 19.3733 14.4414 19.4036 14.3223 19.4311C14.2033 19.4588 14.0836 19.4837 13.9632 19.5059C13.8428 19.528 13.7219 19.5474 13.6005 19.5641C13.4791 19.5807 13.3573 19.5947 13.2352 19.6058C13.113 19.6169 12.9906 19.6253 12.868 19.6309C12.7454 19.6364 12.6227 19.6392 12.5 19.6392C12.3773 19.6392 12.2546 19.6364 12.132 19.6309C12.0094 19.6253 11.887 19.6169 11.7648 19.6058C11.6427 19.5947 11.5209 19.5807 11.3995 19.5641C11.2781 19.5474 11.1572 19.528 11.0368 19.5059C10.9164 19.4837 10.7967 19.4588 10.6777 19.4311C10.5586 19.4036 10.4403 19.3733 10.3229 19.3403C10.2054 19.3073 10.0889 19.2716 9.97336 19.2334C9.85773 19.1951 9.74328 19.1542 9.62984 19.1107C9.51648 19.0673 9.4043 19.0213 9.29336 18.9727C9.18234 18.924 9.07281 18.873 8.96453 18.8194C8.85625 18.7659 8.74953 18.7099 8.64422 18.6515C8.53898 18.5931 8.43531 18.5323 8.3332 18.4692C8.23117 18.406 8.13086 18.3406 8.03227 18.2729C7.93367 18.2053 7.83695 18.1354 7.74203 18.0633C7.64719 17.9912 7.55422 17.917 7.46328 17.8407C7.37234 17.7645 7.28352 17.6861 7.19672 17.6058C7.10992 17.5254 7.02531 17.4431 6.94289 17.3589C6.86047 17.2748 6.78031 17.1888 6.70242 17.1009C6.62453 17.0131 6.54906 16.9235 6.47594 16.8323C6.40281 16.741 6.33219 16.6481 6.26398 16.5537C6.19578 16.4592 6.13016 16.3633 6.06703 16.2658C6.00391 16.1683 5.94344 16.0695 5.88562 15.9693C5.82773 15.8691 5.77258 15.7676 5.72008 15.6649C5.66758 15.5622 5.61789 15.4584 5.57094 15.3534C5.52391 15.2484 5.47977 15.1424 5.43844 15.0354C5.39703 14.9285 5.35859 14.8207 5.32297 14.7119C5.28734 14.6032 5.25461 14.4937 5.22477 14.3835C5.19492 14.2733 5.16805 14.1625 5.14414 14.051C5.12016 13.9396 5.09922 13.8277 5.08117 13.7153C5.0632 13.6029 5.04812 13.4902 5.03609 13.3771C5.02406 13.264 5.01508 13.1507 5.00906 13.0373C5.00305 12.9238 5 12.8102 5 12.6965C5 12.6803 5.00086 12.6641 5.00258 12.6479C5.0043 12.6318 5.00687 12.6157 5.01031 12.5998C5.01375 12.5839 5.01797 12.5681 5.02305 12.5526C5.02812 12.537 5.03406 12.5218 5.04078 12.5068C5.0475 12.4918 5.055 12.4771 5.06328 12.4628C5.07156 12.4485 5.08055 12.4345 5.09031 12.4211C5.1 12.4076 5.11047 12.3945 5.12164 12.3819C5.13273 12.3694 5.14453 12.3574 5.15687 12.3459C5.1693 12.3344 5.18227 12.3235 5.19586 12.3132C5.20945 12.303 5.22352 12.2933 5.23812 12.2842C5.25266 12.2752 5.26773 12.2669 5.2832 12.2592C5.29867 12.2516 5.31453 12.2446 5.3307 12.2384C5.34695 12.2322 5.36344 12.2267 5.38023 12.222C5.39703 12.2173 5.41398 12.2133 5.43117 12.2102C5.44844 12.207 5.46578 12.2046 5.4832 12.2031C5.5007 12.2015 5.5182 12.2007 5.5357 12.2007C5.55328 12.2007 5.57078 12.2015 5.5882 12.2031C5.6057 12.2046 5.62305 12.207 5.64023 12.2102C5.65742 12.2133 5.67445 12.2173 5.69125 12.222C5.70805 12.2267 5.72453 12.2322 5.7407 12.2384C5.75695 12.2446 5.77281 12.2516 5.78828 12.2592C5.80375 12.2669 5.81875 12.2752 5.83336 12.2842C5.84789 12.2933 5.86203 12.303 5.87555 12.3132C5.88914 12.3235 5.90211 12.3344 5.91453 12.3459C5.92695 12.3574 5.93867 12.3694 5.94984 12.3819C5.96094 12.3945 5.97141 12.4076 5.98117 12.4211C5.99086 12.4345 5.99992 12.4485 6.0082 12.4628C6.01641 12.4771 6.02391 12.4918 6.03062 12.5068C6.03734 12.5218 6.04328 12.537 6.04836 12.5526C6.05344 12.5681 6.05773 12.5839 6.06117 12.5998C6.06453 12.6157 6.06711 12.6318 6.06883 12.6479C6.07055 12.6641 6.07141 12.6803 6.07141 12.6965C6.07125 12.8063 6.07437 12.9159 6.0807 13.0254C6.08703 13.1349 6.09672 13.2442 6.10953 13.3532C6.12242 13.4622 6.13859 13.5709 6.15789 13.6791C6.17727 13.7873 6.19984 13.895 6.22562 14.002C6.25141 14.1091 6.28031 14.2154 6.3125 14.321C6.34461 14.4266 6.37984 14.5312 6.4182 14.635C6.45656 14.7388 6.49797 14.8415 6.5425 14.9431C6.58695 15.0448 6.63445 15.1453 6.68492 15.2445C6.73539 15.3437 6.78883 15.4416 6.84516 15.5381C6.90141 15.6346 6.96062 15.7296 7.02258 15.8231C7.08453 15.9166 7.1493 16.0084 7.21672 16.0986C7.28422 16.1887 7.3543 16.2771 7.42703 16.3637C7.49977 16.4503 7.575 16.535 7.65281 16.6178C7.73062 16.7004 7.81078 16.7812 7.89336 16.8598C7.97594 16.9384 8.06086 17.015 8.14797 17.0893C8.23516 17.1636 8.32445 17.2356 8.41594 17.3053C8.50734 17.3751 8.60086 17.4424 8.69633 17.5074C8.7918 17.5723 8.88914 17.6348 8.98828 17.6948C9.0875 17.7548 9.18844 17.8122 9.29102 17.867C9.39367 17.9219 9.49781 17.9741 9.60359 18.0236C9.7093 18.0731 9.81641 18.1199 9.925 18.1639C10.0335 18.208 10.1432 18.2492 10.2542 18.2876C10.3652 18.326 10.4773 18.3615 10.5904 18.3942C10.7034 18.427 10.8174 18.4567 10.9323 18.4837C11.0472 18.5105 11.1628 18.5344 11.2791 18.5554C11.3954 18.5764 11.5123 18.5943 11.6296 18.6093C11.747 18.6243 11.8648 18.6363 11.9828 18.6453C12.1009 18.6542 12.2192 18.6602 12.3377 18.6631C12.4561 18.6661 12.5745 18.6659 12.693 18.6628C12.8115 18.6597 12.9297 18.6536 13.0478 18.6444C13.1659 18.6352 13.2836 18.623 13.4009 18.6079C13.5183 18.5927 13.6351 18.5745 13.7513 18.5534C13.8677 18.5322 13.9832 18.5081 14.098 18.481C14.2128 18.454 14.3268 18.424 14.4398 18.3911C14.5528 18.3582 14.6648 18.3225 14.7757 18.2839C14.8866 18.2453 14.9963 18.2038 15.1048 18.1596C15.2132 18.1155 15.3202 18.0685 15.4259 18.0188C15.5315 17.9691 15.6355 17.9168 15.7381 17.8618C15.8406 17.8068 15.9414 17.7492 16.0405 17.689C16.1396 17.6289 16.2368 17.5663 16.3321 17.5012C16.4275 17.436 16.5209 17.3685 16.6121 17.2986C16.7034 17.2287 16.7927 17.1565 16.8797 17.0821C16.9666 17.0077 17.0514 16.9311 17.1338 16.8522C17.2162 16.7734 17.2963 16.6926 17.3739 16.6097C17.4516 16.5269 17.5266 16.4421 17.5992 16.3554C17.6718 16.2687 17.7417 16.1802 17.809 16.0899C17.8763 15.9996 17.9409 15.9077 18.0027 15.8141C18.0645 15.7205 18.1234 15.6254 18.1795 15.5289C18.2357 15.4322 18.2889 15.3343 18.3392 15.235C18.3895 15.1356 18.4368 15.0351 18.4811 14.9334C18.5254 14.8317 18.5666 14.7289 18.6048 14.625C18.643 14.5212 18.678 14.4164 18.7099 14.3108C18.7418 14.2051 18.7705 14.0988 18.7961 13.9917C18.8217 13.8846 18.8441 13.7769 18.8632 13.6687C18.8823 13.5605 18.8983 13.4518 18.9109 13.3427C18.9236 13.2337 18.933 13.1243 18.9391 13.0148C18.9453 12.9053 18.9482 12.7957 18.9478 12.686C18.9474 12.5763 18.9437 12.4667 18.9369 12.3572C18.9299 12.2478 18.9198 12.1385 18.9063 12.0295C18.8929 11.9206 18.8762 11.812 18.8562 11.7038C18.8363 11.5957 18.8132 11.4882 18.7869 11.3812C18.7605 11.2743 18.7311 11.1681 18.6984 11.0627C18.6658 10.9572 18.63 10.8527 18.5911 10.7491C18.5522 10.6455 18.5102 10.543 18.4652 10.4415C18.4202 10.3401 18.3722 10.2398 18.3212 10.1408C18.2702 10.0418 18.2163 9.94415 18.1595 9.84787C18.1027 9.75166 18.043 9.6569 17.9806 9.56373C17.9181 9.47049 17.853 9.37898 17.785 9.28906C17.7171 9.19922 17.6466 9.11111 17.5734 9.02488C17.5002 8.93858 17.4245 8.85424 17.3462 8.77185C17.268 8.68945 17.1875 8.60908 17.1045 8.53082C17.0215 8.45255 16.9362 8.37645 16.8487 8.30252C16.7611 8.22859 16.6715 8.15697 16.5796 8.0876C16.4878 8.0183 16.3941 7.95132 16.2982 7.88679C16.2024 7.82226 16.1048 7.7602 16.0052 7.70066C15.9058 7.64113 15.8045 7.58413 15.7016 7.52973C15.5987 7.4754 15.4943 7.42368 15.3883 7.37464C15.2823 7.32559 15.1749 7.2793 15.0662 7.23575C14.9574 7.19213 14.8475 7.1514 14.7363 7.1135C14.6252 7.07552 14.5129 7.04051 14.3996 7.00825C14.2863 6.97606 14.1722 6.94683 14.0572 6.92043C13.9422 6.8941 13.8265 6.87066 13.7101 6.85019C13.5937 6.82979 13.4767 6.81228 13.3592 6.79781C13.2418 6.78335 13.124 6.77185 13.0059 6.76345C12.8877 6.75499 12.7695 6.74957 12.6509 6.74711C12.5325 6.74472 12.4141 6.74537 12.2956 6.74899C12.1772 6.7526 12.059 6.75933 11.9409 6.76902C11.8229 6.77865 11.7052 6.79138 11.588 6.80707C11.4707 6.82277 11.354 6.84143 11.2379 6.86314C11.1217 6.88476 11.0062 6.90943 10.8916 6.93699C10.7769 6.96455 10.6631 6.99501 10.5502 7.02843C10.4373 7.06178 10.3256 7.09802 10.2148 7.13708C10.1041 7.17621 9.99469 7.2181 9.88648 7.2628C9.77828 7.30751 9.67148 7.35489 9.56609 7.40502C9.4607 7.45522 9.35695 7.50803 9.25469 7.56344C9.15242 7.61892 9.05195 7.67694 8.9532 7.73748H9.2857C9.30328 7.73748 9.32078 7.73828 9.3382 7.73987C9.3557 7.74146 9.37305 7.74385 9.39023 7.74703C9.40742 7.75022 9.42445 7.75412 9.44125 7.7589C9.45805 7.7636 9.47453 7.76902 9.4907 7.77525C9.50695 7.78147 9.52281 7.78841 9.53828 7.79608C9.55375 7.80375 9.56875 7.81207 9.58336 7.82111C9.59789 7.83015 9.61203 7.83977 9.62555 7.85011C9.63914 7.86039 9.65211 7.87131 9.66453 7.88274C9.67695 7.89424 9.68867 7.90625 9.69984 7.91884C9.71094 7.93135 9.72141 7.94437 9.73117 7.9579C9.74086 7.97143 9.74992 7.98531 9.7582 7.99964C9.76641 8.01396 9.77391 8.02865 9.78062 8.04362C9.78734 8.05867 9.79328 8.07393 9.79836 8.08948C9.80344 8.10503 9.80773 8.12073 9.81117 8.13665C9.81453 8.15263 9.81711 8.16862 9.81883 8.18482C9.82055 8.20095 9.82141 8.21716 9.82141 8.23343C9.82141 8.24964 9.82055 8.26584 9.81883 8.28204C9.81711 8.29818 9.81453 8.31424 9.81117 8.33015C9.80773 8.34606 9.80344 8.36183 9.79836 8.37739C9.79328 8.39294 9.78734 8.4082 9.78062 8.42318C9.77391 8.43822 9.76641 8.45283 9.7582 8.46716C9.74992 8.48148 9.74086 8.49544 9.73117 8.5089C9.72141 8.52242 9.71094 8.53544 9.69984 8.54803C9.68867 8.56055 9.67695 8.57263 9.66453 8.58406C9.65211 8.59556 9.63914 8.60648 9.62555 8.61675C9.61203 8.6271 9.59789 8.63672 9.58336 8.64576C9.56875 8.6548 9.55375 8.66312 9.53828 8.67079C9.52281 8.67846 9.50695 8.68533 9.4907 8.69155C9.47453 8.69777 9.45805 8.70327 9.44125 8.70797C9.42445 8.71267 9.40742 8.71665 9.39023 8.71976C9.37305 8.72294 9.3557 8.72533 9.3382 8.72692C9.32078 8.72851 9.30328 8.72931 9.2857 8.72931H7.67859C7.66102 8.72931 7.64352 8.72851 7.62602 8.727C7.60859 8.7254 7.59125 8.72302 7.57406 8.71983C7.5568 8.71665 7.53984 8.71275 7.52305 8.70804C7.50625 8.70334 7.48977 8.69784 7.47352 8.69162C7.45727 8.68547 7.44148 8.67853 7.42594 8.67086C7.41047 8.66319 7.39547 8.65487 7.38086 8.64583C7.36625 8.63679 7.35219 8.62717 7.33867 8.61682C7.32508 8.60655 7.31211 8.59563 7.29969 8.58413C7.28727 8.5727 7.27547 8.56062 7.26437 8.5481C7.2532 8.53552 7.24281 8.5225 7.23305 8.50897C7.22328 8.49551 7.2143 8.48155 7.20602 8.46723C7.19773 8.45291 7.19023 8.43822 7.18352 8.42325C7.17687 8.4082 7.17094 8.39294 7.16586 8.37739C7.16078 8.36183 7.15648 8.34614 7.15312 8.33022C7.14969 8.31424 7.14711 8.29818 7.14539 8.28204C7.14367 8.26584 7.14281 8.24964 7.14289 8.23343V6.74573C7.14289 6.72946 7.14375 6.71325 7.14547 6.69712C7.14719 6.68092 7.14977 6.66486 7.15312 6.64894C7.15656 6.63303 7.16086 6.61733 7.16594 6.60178C7.17102 6.58623 7.17695 6.57096 7.18367 6.55592C7.19031 6.54094 7.19781 6.52626 7.20609 6.51193C7.21437 6.49761 7.22336 6.48372 7.23312 6.4702C7.24289 6.45667 7.25336 6.44365 7.26445 6.43113C7.27562 6.41855 7.28734 6.40654 7.29977 6.39504C7.31219 6.38354 7.32516 6.37268 7.33875 6.36234C7.35227 6.35207 7.36633 6.34237 7.38094 6.3334C7.39555 6.32436 7.41055 6.31604 7.42602 6.30838C7.44148 6.30071 7.45734 6.29376 7.47359 6.28754C7.48977 6.28132 7.50625 6.2759 7.52305 6.27112C7.53984 6.26642 7.55687 6.26251 7.57406 6.25933C7.59125 6.25615 7.60859 6.25376 7.62609 6.25217C7.64352 6.25058 7.66102 6.24978 7.67859 6.24978C7.69609 6.24978 7.71359 6.25058 7.73109 6.25217C7.74852 6.25376 7.76586 6.25615 7.78305 6.25933C7.80031 6.26251 7.81727 6.26642 7.83406 6.27112C7.85086 6.2759 7.86734 6.28132 7.88359 6.28754C7.89977 6.29376 7.91562 6.30071 7.93109 6.30838C7.94656 6.31604 7.96164 6.32436 7.97617 6.3334C7.99078 6.34237 8.00484 6.35207 8.01844 6.36234C8.03195 6.37268 8.045 6.38354 8.05734 6.39504C8.06977 6.40654 8.08156 6.41855 8.09266 6.43113C8.10383 6.44365 8.11422 6.45667 8.12398 6.4702C8.13375 6.48372 8.14273 6.49761 8.15102 6.51193C8.1593 6.52626 8.1668 6.54094 8.17352 6.55592C8.18023 6.57096 8.18609 6.58623 8.19125 6.60178C8.19633 6.61733 8.20055 6.63303 8.20398 6.64894C8.20742 6.66486 8.21 6.68092 8.21172 6.69712C8.21344 6.71325 8.2143 6.72946 8.2143 6.74573V7.00058C8.28414 6.95551 8.35477 6.91153 8.42625 6.86871C8.49773 6.82588 8.56992 6.78422 8.64289 6.74363C8.71594 6.70305 8.78961 6.6637 8.86406 6.62543C8.93852 6.58724 9.01367 6.55013 9.08945 6.51432C9.16523 6.47844 9.24172 6.44379 9.31883 6.4103C9.39586 6.37688 9.47352 6.34462 9.5518 6.31366C9.63008 6.28262 9.70891 6.25289 9.78828 6.22432C9.86766 6.19582 9.9475 6.16855 10.0279 6.14258C10.1082 6.11654 10.1891 6.09187 10.2703 6.06836C10.3516 6.04492 10.4333 6.02279 10.5154 6.00188C10.5975 5.98105 10.6799 5.96144 10.7627 5.94314C10.8455 5.92491 10.9287 5.90791 11.0121 5.89229C11.0955 5.87659 11.1792 5.86227 11.2632 5.84925C11.3472 5.83623 11.4313 5.82451 11.5158 5.81416C11.6002 5.80382 11.6847 5.79478 11.7695 5.78711C11.8541 5.77937 11.939 5.773 12.024 5.76801C12.1089 5.76295 12.194 5.75933 12.2791 5.75694C12.3641 5.75463 12.4493 5.75362 12.5344 5.75398C12.6195 5.75434 12.7046 5.756 12.7897 5.75904C12.8748 5.76201 12.9598 5.76642 13.0447 5.77213C13.1296 5.77785 13.2144 5.78487 13.299 5.79326C13.3837 5.80165 13.4681 5.81134 13.5524 5.82234C13.6367 5.8334 13.7208 5.84577 13.8046 5.85945C13.8884 5.87319 13.972 5.88816 14.0553 5.90451C14.1386 5.92086 14.2216 5.93844 14.3042 5.95739C14.3869 5.97634 14.4691 5.9966 14.551 6.01816C14.6329 6.03964 14.7144 6.0625 14.7954 6.08659C14.8765 6.11068 14.957 6.13607 15.0372 6.16276C15.1173 6.18938 15.1969 6.2173 15.276 6.24645C15.3551 6.27561 15.4336 6.30599 15.5116 6.3376C15.5896 6.36928 15.667 6.40213 15.7437 6.4362C15.8205 6.47027 15.8966 6.50557 15.972 6.54203C16.0475 6.57849 16.1223 6.6161 16.1964 6.65495C16.2705 6.69379 16.3438 6.7338 16.4164 6.77496C16.4891 6.81604 16.5609 6.85836 16.632 6.90176C16.703 6.94517 16.7732 6.98965 16.8427 7.0353C16.912 7.08095 16.9806 7.1276 17.0483 7.17542C17.116 7.22323 17.1828 7.27206 17.2487 7.3219C17.3146 7.37182 17.3795 7.42274 17.4436 7.47468C17.5077 7.52662 17.5707 7.57957 17.6327 7.63346C17.6948 7.68743 17.7559 7.74226 17.8159 7.79818C17.876 7.85402 17.9351 7.91081 17.993 7.96846C18.051 8.02619 18.1079 8.08485 18.1637 8.14431C18.2195 8.20385 18.2742 8.26418 18.3278 8.32545C18.3814 8.38665 18.4338 8.44871 18.4852 8.51165C18.5365 8.57451 18.5866 8.63816 18.6355 8.70262C18.6845 8.76714 18.7323 8.83232 18.7789 8.89829C18.8255 8.96426 18.8708 9.03096 18.9149 9.09838C18.959 9.1658 19.0019 9.23387 19.0435 9.30259C19.0851 9.37138 19.1254 9.44075 19.1645 9.51078C19.2035 9.5808 19.2412 9.6514 19.2777 9.72266C19.3142 9.79384 19.3493 9.8656 19.3831 9.93793C19.417 10.0103 19.4495 10.0831 19.4805 10.1565C19.5117 10.2298 19.5415 10.3036 19.5699 10.3779C19.5983 10.4522 19.6254 10.5269 19.651 10.6021C19.6767 10.6772 19.701 10.7527 19.7239 10.8286C19.7468 10.9045 19.7683 10.9808 19.7884 11.0574C19.8084 11.134 19.8271 11.2108 19.8444 11.288C19.8616 11.3652 19.8774 11.4426 19.8919 11.5203C19.9062 11.5979 19.9192 11.6758 19.9308 11.7539C19.9423 11.832 19.9524 11.9102 19.9611 11.9886C19.9698 12.067 19.977 12.1455 19.9827 12.2241C19.9885 12.3027 19.9928 12.3814 19.9957 12.4602C19.9986 12.539 20 12.6178 20 12.6965ZM17.3214 12.6965C17.3214 12.7696 17.3195 12.8426 17.3156 12.9156C17.3117 12.9885 17.3059 13.0613 17.2982 13.134C17.2905 13.2067 17.2808 13.2792 17.2692 13.3514C17.2577 13.4237 17.2441 13.4957 17.2287 13.5673C17.2134 13.6389 17.1961 13.7101 17.177 13.781C17.1577 13.8519 17.1367 13.9222 17.1138 13.9921C17.0909 14.0621 17.0662 14.1314 17.0396 14.2002C17.013 14.269 16.9846 14.337 16.9545 14.4045C16.9242 14.472 16.8923 14.5388 16.8585 14.6048C16.8248 14.6709 16.7893 14.736 16.7521 14.8005C16.7149 14.8649 16.676 14.9285 16.6355 14.9911C16.5949 15.0537 16.5527 15.1155 16.5089 15.1761C16.465 15.2369 16.4196 15.2966 16.3726 15.3553C16.3256 15.4139 16.2771 15.4715 16.227 15.5279C16.177 15.5844 16.1255 15.6397 16.0724 15.6938C16.0195 15.748 15.9651 15.8009 15.9093 15.8525C15.8534 15.9042 15.7963 15.9545 15.7379 16.0035C15.6794 16.0526 15.6197 16.1003 15.5587 16.1466C15.4977 16.1929 15.4355 16.2378 15.3721 16.2814C15.3087 16.3249 15.2442 16.367 15.1787 16.4076C15.113 16.4481 15.0464 16.4872 14.9787 16.5247C14.911 16.5623 14.8424 16.5982 14.7728 16.6327C14.7032 16.6671 14.6327 16.6999 14.5614 16.7312C14.4901 16.7624 14.418 16.792 14.3451 16.8199C14.2722 16.8479 14.1986 16.8742 14.1243 16.8988C14.05 16.9234 13.9751 16.9463 13.8996 16.9675C13.8241 16.9887 13.748 17.0082 13.6715 17.026C13.595 17.0437 13.518 17.0597 13.4406 17.0739C13.3632 17.0882 13.2855 17.1007 13.2074 17.1114C13.1294 17.1221 13.0511 17.1311 12.9726 17.1382C12.8941 17.1454 12.8154 17.1508 12.7366 17.1543C12.6577 17.1579 12.5789 17.1597 12.5 17.1597C12.4211 17.1597 12.3423 17.1579 12.2634 17.1543C12.1846 17.1508 12.1059 17.1454 12.0274 17.1382C11.9489 17.1311 11.8706 17.1221 11.7926 17.1114C11.7145 17.1007 11.6368 17.0882 11.5594 17.0739C11.482 17.0597 11.405 17.0437 11.3285 17.026C11.252 17.0082 11.1759 16.9887 11.1004 16.9675C11.0249 16.9463 10.95 16.9234 10.8757 16.8988C10.8014 16.8742 10.7278 16.8479 10.6549 16.8199C10.582 16.792 10.5099 16.7624 10.4386 16.7312C10.3673 16.6999 10.2968 16.6671 10.2272 16.6327C10.1576 16.5982 10.089 16.5623 10.0213 16.5247C9.95359 16.4872 9.88695 16.4481 9.82133 16.4076C9.75578 16.367 9.69125 16.3249 9.62789 16.2814C9.56453 16.2378 9.50234 16.1929 9.44133 16.1466C9.38031 16.1003 9.32062 16.0526 9.26211 16.0035C9.20367 15.9545 9.14656 15.9042 9.0907 15.8525C9.03492 15.8009 8.98055 15.748 8.92758 15.6938C8.87453 15.6397 8.82305 15.5844 8.77297 15.5279C8.72289 15.4715 8.67437 15.4139 8.62742 15.3553C8.58039 15.2966 8.535 15.2369 8.49109 15.1761C8.44727 15.1155 8.40508 15.0537 8.36453 14.9911C8.32398 14.9285 8.28508 14.8649 8.24789 14.8005C8.2107 14.736 8.17523 14.6709 8.14148 14.6048C8.10773 14.5388 8.07578 14.472 8.04555 14.4045C8.01539 14.337 7.98703 14.269 7.96039 14.2002C7.93383 14.1314 7.90906 14.0621 7.88617 13.9921C7.86328 13.9222 7.84227 13.8519 7.82305 13.781C7.80391 13.7101 7.78664 13.6389 7.77125 13.5673C7.75578 13.4957 7.74234 13.4237 7.73078 13.3514C7.71914 13.2792 7.70953 13.2067 7.7018 13.134C7.69406 13.0613 7.68828 12.9885 7.68437 12.9156C7.68047 12.8426 7.67859 12.7696 7.67859 12.6965C7.67859 12.6236 7.68047 12.5505 7.68437 12.4776C7.68828 12.4046 7.69406 12.3318 7.7018 12.2591C7.70953 12.1864 7.71914 12.1139 7.73078 12.0417C7.74234 11.9694 7.75578 11.8975 7.77125 11.8259C7.78664 11.7542 7.80391 11.6829 7.82305 11.6121C7.84227 11.5412 7.86328 11.4708 7.88617 11.401C7.90906 11.3311 7.93383 11.2617 7.96039 11.193C7.98703 11.1242 8.01539 11.0561 8.04555 10.9886C8.07578 10.9211 8.10773 10.8544 8.14148 10.7883C8.17523 10.7223 8.2107 10.657 8.24789 10.5927C8.28508 10.5282 8.32398 10.4647 8.36453 10.4021C8.40508 10.3394 8.44727 10.2777 8.49109 10.2169C8.535 10.1562 8.58039 10.0966 8.62742 10.0379C8.67437 9.97924 8.72289 9.92166 8.77297 9.86516C8.82305 9.80874 8.87453 9.7534 8.92758 9.69929C8.98055 9.64518 9.03492 9.5923 9.0907 9.54065C9.14656 9.489 9.20367 9.43866 9.26211 9.38961C9.32062 9.34057 9.38031 9.29282 9.44133 9.24653C9.50234 9.20016 9.56453 9.15524 9.62789 9.11176C9.69125 9.06821 9.75578 9.02619 9.82133 8.9856C9.88695 8.94502 9.95359 8.90596 10.0213 8.86842C10.089 8.83087 10.1576 8.79485 10.2272 8.76042C10.2968 8.72598 10.3673 8.69314 10.4386 8.66196C10.5099 8.63071 10.582 8.60113 10.6549 8.57313C10.7278 8.54521 10.8014 8.51895 10.8757 8.49428C10.95 8.46969 11.0249 8.44683 11.1004 8.42564C11.1759 8.40437 11.252 8.38491 11.3285 8.36719C11.405 8.34946 11.482 8.3334 11.5594 8.31915C11.6368 8.3049 11.7145 8.29246 11.7926 8.28176C11.8706 8.27098 11.9489 8.26208 12.0274 8.25492C12.1059 8.24776 12.1846 8.2424 12.2634 8.23879C12.3423 8.23524 12.4211 8.23343 12.5 8.23343C12.5789 8.23351 12.6577 8.23539 12.7365 8.239C12.8153 8.24269 12.8939 8.24812 12.9724 8.25535C13.0509 8.26259 13.1291 8.27156 13.2072 8.28233C13.2852 8.29311 13.3629 8.3057 13.4402 8.31995C13.5176 8.33427 13.5945 8.35033 13.671 8.36813C13.7476 8.38592 13.8235 8.40545 13.899 8.42672C13.9745 8.44792 14.0493 8.47092 14.1236 8.49551C14.1978 8.52018 14.2714 8.54651 14.3443 8.57443C14.4171 8.60243 14.4892 8.63209 14.5605 8.66334C14.6318 8.69459 14.7022 8.72743 14.7718 8.76186C14.8413 8.7963 14.9099 8.83232 14.9776 8.86986C15.0452 8.90741 15.1118 8.94654 15.1774 8.98712C15.243 9.0277 15.3074 9.06973 15.3708 9.11321C15.4341 9.15676 15.4963 9.20168 15.5573 9.24797C15.6182 9.29434 15.678 9.34201 15.7364 9.39106C15.7948 9.4401 15.852 9.49045 15.9077 9.5421C15.9635 9.59368 16.0179 9.64656 16.0709 9.70066C16.1238 9.75477 16.1754 9.81004 16.2254 9.86646C16.2755 9.92296 16.324 9.98047 16.371 10.0391C16.418 10.0977 16.4634 10.1574 16.5073 10.2181C16.5511 10.2789 16.5933 10.3405 16.6339 10.4031C16.6745 10.4657 16.7134 10.5292 16.7505 10.5936C16.7878 10.658 16.8233 10.7232 16.857 10.7892C16.8908 10.8552 16.9228 10.9219 16.953 10.9894C16.9832 11.0568 17.0116 11.1249 17.0383 11.1936C17.0649 11.2624 17.0897 11.3317 17.1127 11.4015C17.1356 11.4714 17.1566 11.5417 17.1759 11.6126C17.1952 11.6834 17.2125 11.7546 17.2279 11.8262C17.2434 11.8978 17.257 11.9697 17.2686 12.042C17.2802 12.1141 17.2899 12.1866 17.2977 12.2593C17.3055 12.3319 17.3114 12.4047 17.3154 12.4776C17.3193 12.5506 17.3213 12.6236 17.3214 12.6965ZM14.4043 13.2758L13.0357 12.4312V10.217C13.0357 10.2008 13.0348 10.1846 13.0331 10.1684C13.0314 10.1523 13.0288 10.1362 13.0254 10.1203C13.022 10.1044 13.0177 10.0886 13.0127 10.0731C13.0076 10.0576 13.0016 10.0422 12.9949 10.0273C12.9882 10.0122 12.9807 9.99761 12.9724 9.98329C12.9642 9.96897 12.9552 9.955 12.9454 9.94155C12.9357 9.92802 12.9252 9.915 12.9141 9.90242C12.903 9.8899 12.8912 9.87789 12.8788 9.86639C12.8664 9.85489 12.8534 9.84404 12.8398 9.83369C12.8263 9.82342 12.8122 9.81373 12.7977 9.80469C12.783 9.79572 12.768 9.78733 12.7525 9.77966C12.737 9.77206 12.7212 9.76512 12.705 9.7589C12.6888 9.75268 12.6723 9.74718 12.6555 9.74248C12.6387 9.73777 12.6217 9.73387 12.6045 9.73068C12.5873 9.7275 12.57 9.72511 12.5525 9.72352C12.5351 9.72193 12.5176 9.72114 12.5 9.72114C12.4824 9.72114 12.4649 9.72193 12.4475 9.72352C12.43 9.72511 12.4127 9.7275 12.3955 9.73068C12.3783 9.73387 12.3612 9.73777 12.3445 9.74248C12.3277 9.74718 12.3112 9.75268 12.295 9.7589C12.2787 9.76512 12.263 9.77206 12.2475 9.77966C12.232 9.78733 12.217 9.79572 12.2023 9.80469C12.1878 9.81373 12.1737 9.82342 12.1602 9.83369C12.1466 9.84404 12.1336 9.85489 12.1212 9.86639C12.1087 9.87789 12.097 9.8899 12.0859 9.90242C12.0748 9.915 12.0643 9.92802 12.0545 9.94155C12.0448 9.955 12.0358 9.96897 12.0276 9.98329C12.0193 9.99761 12.0118 10.0122 12.0051 10.0273C11.9984 10.0422 11.9924 10.0576 11.9873 10.0731C11.9823 10.0886 11.978 10.1044 11.9746 10.1203C11.9712 10.1362 11.9686 10.1523 11.9669 10.1684C11.9652 10.1846 11.9643 10.2008 11.9643 10.217V12.6965C11.9643 12.7374 11.9697 12.7776 11.9804 12.8172C11.9911 12.8568 12.0069 12.8945 12.0277 12.9306C12.0485 12.9665 12.0737 12.9996 12.1034 13.0299C12.133 13.06 12.1662 13.0865 12.2028 13.1092L13.81 14.101C13.8246 14.1098 13.8396 14.1179 13.8551 14.1254C13.8705 14.1329 13.8863 14.1396 13.9025 14.1456C13.9187 14.1517 13.9352 14.157 13.9519 14.1615C13.9686 14.1661 13.9855 14.1698 14.0027 14.1729C14.0198 14.1759 14.037 14.1781 14.0545 14.1796C14.0718 14.1811 14.0892 14.1817 14.1066 14.1816C14.1241 14.1815 14.1415 14.1806 14.1587 14.1789C14.1761 14.1772 14.1934 14.1748 14.2104 14.1715C14.2275 14.1683 14.2444 14.1643 14.261 14.1595C14.2777 14.1547 14.2941 14.1492 14.3102 14.143C14.3262 14.1367 14.342 14.1298 14.3573 14.1221C14.3727 14.1144 14.3875 14.1061 14.402 14.0971C14.4165 14.0881 14.4304 14.0784 14.4438 14.0681C14.4573 14.0579 14.4702 14.047 14.4825 14.0356C14.4948 14.0242 14.5065 14.0122 14.5175 13.9997C14.5285 13.9872 14.5389 13.9742 14.5486 13.9608C14.5583 13.9473 14.5672 13.9335 14.5754 13.9193C14.5836 13.9051 14.5911 13.8905 14.5977 13.8756C14.6044 13.8607 14.6103 13.8455 14.6154 13.83C14.6205 13.8146 14.6247 13.799 14.6281 13.7831C14.6316 13.7673 14.6341 13.7514 14.6359 13.7353C14.6376 13.7193 14.6385 13.7031 14.6385 13.687C14.6386 13.6709 14.6378 13.6547 14.6362 13.6387C14.6345 13.6226 14.632 13.6067 14.6287 13.5908C14.6253 13.5749 14.6212 13.5593 14.6162 13.5438C14.6112 13.5284 14.6054 13.5132 14.5988 13.4983C14.5922 13.4833 14.5848 13.4687 14.5767 13.4544C14.5686 13.4401 14.5597 13.4262 14.5501 13.4128C14.5405 13.3993 14.5302 13.3863 14.5192 13.3738C14.5083 13.3612 14.4967 13.3492 14.4845 13.3377C14.4722 13.3262 14.4594 13.3152 14.446 13.3049C14.4326 13.2946 14.4187 13.2849 14.4043 13.2758Z" fill="#0BAA67" class="group-hover:fill-white"/>
                                            </g>
                                            <defs>
                                                <filter id="filter0_d_2052_9" x="0" y="0" width="28" height="27" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                                    <feOffset dx="1" dy="1"/>
                                                    <feGaussianBlur stdDeviation="1"/>
                                                    <feComposite in2="hardAlpha" operator="out"/>
                                                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2052_9"/>
                                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2052_9" result="shape"/>
                                                </filter>
                                                <clipPath id="clip0_2052_9">
                                                    <rect width="15" height="15" fill="white" transform="translate(5 5)"/>
                                                </clipPath>
                                            </defs>
                                        </svg>

                                        <span class=" text-[12px]">My History</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>

                <nav class=" text-white w-full ">
                    <ul class="flex-col space-y-1">
                        <li ><!-- Get Help-->
                            <a href="#" class="flex items-center group text-white gap-x-2 rounded-md  py-1 hover:bg-white hover:text-primary">

                            <svg class="ml-1" width="28" height="27" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g filter="url(#filter0_d_2053_11)">
                                    <rect class="group-hover:fill-primary" x="1" y="1" width="24" height="23" rx="5" fill="white"/>
                                </g>
                                <g clip-path="url(#clip0_2053_11)">
                                    <path d="M13.0013 18.8337C16.223 18.8337 18.8346 16.222 18.8346 13.0003C18.8346 9.77866 16.223 7.16699 13.0013 7.16699C9.77964 7.16699 7.16797 9.77866 7.16797 13.0003C7.16797 16.222 9.77964 18.8337 13.0013 18.8337Z" stroke="#0BAA67" class="group-hover:stroke-white" stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13 10.667V13.0003" stroke="#0BAA67" class="group-hover:stroke-white" stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13 15.333H13.0053" stroke="#0BAA67" class="group-hover:stroke-white" stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"/>
                                </g>
                                <defs>
                                    <filter id="filter0_d_2053_11" x="0" y="0" width="28" height="27" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                        <feOffset dx="1" dy="1"/>
                                        <feGaussianBlur stdDeviation="1"/>
                                        <feComposite in2="hardAlpha" operator="out"/>
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2053_11"/>
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2053_11" result="shape"/>
                                    </filter>
                                    <clipPath id="clip0_2053_11">
                                        <rect width="14" height="14" fill="white" transform="translate(6 6)"/>
                                    </clipPath>
                                </defs>
                            </svg>

                            <span class=" text-[12px]">Get Help</span>
                            </a>
                        </li>

                        <li><!-- Settings -->
                            <a href="#" class="flex items-center group text-white gap-x-2 rounded-md py-1 hover:bg-white hover:text-primary">

                            <svg class="ml-1" width="28" height="27" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g filter="url(#filter0_d_2053_13)">
                                    <rect class="group-hover:fill-primary" x="1" y="1" width="24" height="23" rx="5" fill="white"/>
                                </g>
                                <g clip-path="url(#clip0_2053_13)">
                                    <path d="M13 14.5C13.8284 14.5 14.5 13.8284 14.5 13C14.5 12.1716 13.8284 11.5 13 11.5C12.1716 11.5 11.5 12.1716 11.5 13C11.5 13.8284 12.1716 14.5 13 14.5Z" stroke="#0BAA67" class="group-hover:stroke-white"  stroke-width="1.41667" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.7 14.5C16.6334 14.6508 16.6136 14.8181 16.643 14.9803C16.6724 15.1425 16.7497 15.2922 16.865 15.41L16.895 15.44C16.988 15.5329 17.0617 15.6432 17.1121 15.7646C17.1624 15.886 17.1883 16.0161 17.1883 16.1475C17.1883 16.2789 17.1624 16.409 17.1121 16.5304C17.0617 16.6518 16.988 16.7621 16.895 16.855C16.8021 16.948 16.6918 17.0217 16.5704 17.0721C16.449 17.1224 16.3189 17.1483 16.1875 17.1483C16.0561 17.1483 15.926 17.1224 15.8046 17.0721C15.6832 17.0217 15.5729 16.948 15.48 16.855L15.45 16.825C15.3322 16.7097 15.1825 16.6324 15.0203 16.603C14.8581 16.5736 14.6908 16.5934 14.54 16.66C14.3921 16.7234 14.266 16.8286 14.1772 16.9628C14.0883 17.0969 14.0406 17.2541 14.04 17.415V17.5C14.04 17.7652 13.9346 18.0196 13.7471 18.2071C13.5596 18.3946 13.3052 18.5 13.04 18.5C12.7748 18.5 12.5204 18.3946 12.3329 18.2071C12.1454 18.0196 12.04 17.7652 12.04 17.5V17.455C12.0361 17.2895 11.9826 17.129 11.8863 16.9944C11.79 16.8597 11.6554 16.7571 11.5 16.7C11.3492 16.6334 11.1819 16.6136 11.0197 16.643C10.8575 16.6724 10.7078 16.7497 10.59 16.865L10.56 16.895C10.4671 16.988 10.3568 17.0617 10.2354 17.1121C10.114 17.1624 9.98392 17.1883 9.8525 17.1883C9.72108 17.1883 9.59096 17.1624 9.46956 17.1121C9.34816 17.0617 9.23787 16.988 9.145 16.895C9.05202 16.8021 8.97826 16.6918 8.92794 16.5704C8.87762 16.449 8.85171 16.3189 8.85171 16.1875C8.85171 16.0561 8.87762 15.926 8.92794 15.8046C8.97826 15.6832 9.05202 15.5729 9.145 15.48L9.175 15.45C9.29027 15.3322 9.36759 15.1825 9.397 15.0203C9.42641 14.8581 9.40656 14.6908 9.34 14.54C9.27662 14.3921 9.17138 14.266 9.03723 14.1772C8.90309 14.0883 8.74589 14.0406 8.585 14.04H8.5C8.23478 14.04 7.98043 13.9346 7.79289 13.7471C7.60536 13.5596 7.5 13.3052 7.5 13.04C7.5 12.7748 7.60536 12.5204 7.79289 12.3329C7.98043 12.1454 8.23478 12.04 8.5 12.04H8.545C8.7105 12.0361 8.871 11.9826 9.00565 11.8863C9.1403 11.79 9.24286 11.6554 9.3 11.5C9.36656 11.3492 9.38641 11.1819 9.357 11.0197C9.32759 10.8575 9.25027 10.7078 9.135 10.59L9.105 10.56C9.01202 10.4671 8.93826 10.3568 8.88794 10.2354C8.83762 10.114 8.81171 9.98392 8.81171 9.8525C8.81171 9.72108 8.83762 9.59096 8.88794 9.46956C8.93826 9.34816 9.01202 9.23787 9.105 9.145C9.19787 9.05202 9.30816 8.97826 9.42956 8.92794C9.55096 8.87762 9.68108 8.85171 9.8125 8.85171C9.94392 8.85171 10.074 8.87762 10.1954 8.92794C10.3168 8.97826 10.4271 9.05202 10.52 9.145L10.55 9.175C10.6678 9.29027 10.8175 9.36759 10.9797 9.397C11.1419 9.42641 11.3092 9.40656 11.46 9.34H11.5C11.6479 9.27662 11.774 9.17138 11.8628 9.03723C11.9517 8.90309 11.9994 8.74589 12 8.585V8.5C12 8.23478 12.1054 7.98043 12.2929 7.79289C12.4804 7.60536 12.7348 7.5 13 7.5C13.2652 7.5 13.5196 7.60536 13.7071 7.79289C13.8946 7.98043 14 8.23478 14 8.5V8.545C14.0006 8.70589 14.0483 8.86309 14.1372 8.99723C14.226 9.13138 14.3521 9.23662 14.5 9.3C14.6508 9.36656 14.8181 9.38641 14.9803 9.357C15.1425 9.32759 15.2922 9.25027 15.41 9.135L15.44 9.105C15.5329 9.01202 15.6432 8.93826 15.7646 8.88794C15.886 8.83762 16.0161 8.81171 16.1475 8.81171C16.2789 8.81171 16.409 8.83762 16.5304 8.88794C16.6518 8.93826 16.7621 9.01202 16.855 9.105C16.948 9.19787 17.0217 9.30816 17.0721 9.42956C17.1224 9.55096 17.1483 9.68108 17.1483 9.8125C17.1483 9.94392 17.1224 10.074 17.0721 10.1954C17.0217 10.3168 16.948 10.4271 16.855 10.52L16.825 10.55C16.7097 10.6678 16.6324 10.8175 16.603 10.9797C16.5736 11.1419 16.5934 11.3092 16.66 11.46V11.5C16.7234 11.6479 16.8286 11.774 16.9628 11.8628C17.0969 11.9517 17.2541 11.9994 17.415 12H17.5C17.7652 12 18.0196 12.1054 18.2071 12.2929C18.3946 12.4804 18.5 12.7348 18.5 13C18.5 13.2652 18.3946 13.5196 18.2071 13.7071C18.0196 13.8946 17.7652 14 17.5 14H17.455C17.2941 14.0006 17.1369 14.0483 17.0028 14.1372C16.8686 14.226 16.7634 14.3521 16.7 14.5Z" stroke="#0BAA67" class="group-hover:stroke-white"  stroke-width="1.41667" stroke-linecap="round" stroke-linejoin="round"/>
                                </g>
                                <defs>
                                    <filter id="filter0_d_2053_13" x="0" y="0" width="28" height="27" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                        <feOffset dx="1" dy="1"/>
                                        <feGaussianBlur stdDeviation="1"/>
                                        <feComposite in2="hardAlpha" operator="out"/>
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2053_13"/>
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2053_13" result="shape"/>
                                    </filter>
                                    <clipPath id="clip0_2053_13">
                                        <rect width="12" height="12" fill="white" transform="translate(7 7)"/>
                                    </clipPath>
                                </defs>
                            </svg>

                            <span class=" text-[12px]">Settings</span>
                            </a>
                        </li>
                        <form action="{{route('admin.logout')}}" method="POST">
                            @csrf

                        <li><!-- Sign out -->
                            <button type="SUBMIT" class="flex w-full items-center group text-white gap-x-2 rounded-md py-1  hover:bg-white hover:text-primary">
                            <svg class="ml-1" width="28" height="27" viewBox="0 0 28 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g filter="url(#filter0_d_2053_14)">
                                    <rect class="group-hover:fill-primary" x="1" y="1" width="24" height="23" rx="5" fill="white"/>
                                </g>
                                <g clip-path="url(#clip0_2053_14)">
                                    <rect width="12" height="12" transform="translate(7 7)" fill="white" class="group-hover:fill-primary" />
                                    <path d="M11.5 17.5H9.5C9.23478 17.5 8.98043 17.3946 8.79289 17.2071C8.60536 17.0196 8.5 16.7652 8.5 16.5V9.5C8.5 9.23478 8.60536 8.98043 8.79289 8.79289C8.98043 8.60536 9.23478 8.5 9.5 8.5H11.5" stroke="#0BAA67" class="group-hover:stroke-white"  stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15 15.5L17.5 13L15 10.5" stroke="#0BAA67" class="group-hover:stroke-white"  stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M17.5 13H11.5" stroke="#0BAA67" class="group-hover:stroke-white"  stroke-width="1.58333" stroke-linecap="round" stroke-linejoin="round"/>
                                </g>
                                <defs>
                                    <filter id="filter0_d_2053_14" x="0" y="0" width="28" height="27" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                        <feOffset dx="1" dy="1"/>
                                        <feGaussianBlur stdDeviation="1"/>
                                        <feComposite in2="hardAlpha" operator="out"/>
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2053_14"/>
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2053_14" result="shape"/>
                                    </filter>
                                    <clipPath id="clip0_2053_14">
                                        <rect width="12" height="12" fill="white" transform="translate(7 7)"/>
                                    </clipPath>
                                </defs>
                            </svg>


                            <span class=" text-[12px]">Sign Out</span>
                            </button>

                        </li>
                        </form>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="pl-60">
            <div class="sticky border top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200  bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">

                <div class="flex flex-1 gap-x-6">

                    <div class="w-[580px] flex items-center text-[18px] text-primary font-semibold">
                        <h1>{{ $page_title }}</h1>
                    </div>

                    <div class="mr-auto w-full justify-end flex ">
                        <div class="flex w-80 pl-10 pr-2 items-center ">
                            <form class="relative flex flex-1  h-8 rounded-[10px] " action="#" method="GET">
                                <label for="search-field" class="sr-only">Search</label>
                                <svg class="pointer-events-none  absolute inset-y-0 left-0 h-full w-5 text-gray-400 ml-2 z-10"    viewBox="0 0 20 20" fill="#0BAA67" aria-hidden="false">
                                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                                </svg>
                                <input id="search-field" class="focus:bg-gray-100 bg-white drop-shadow-sm rounded-md block h-full w-full border-0 py-0 pl-8 pr-0 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-[12px]" placeholder="Search Mirkado" type="search" name="search">
                            </form>
                        </div>

                        <div class="flex items-center gap-x-6" x-data="{ notification: false }" >
                            <button @click="notification = true" type="button" id="notificationDropdown" data-dropdown-toggle="notification" class="relative -m-2.5 p-2.5 text-gray-400 hover:text-gray-500">
                                <span class="sr-only">View notifications</span>
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke="#757575" stroke-width="1.5" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                </svg>
                                <div class=" absolute top-1 ml-2  h-[13px] w-[24px] p-0 rounded-full bg-primary justify-center items-center">
                                    <p class="text-white text-[8px] ">99+</p>
                                </div>
                            </button>

                            <!--Notification Dropdown-->
                            <div x-show="notification" id="notification" class="mr-[500px] right-0 top-0 z-50 hidden w-[350px] pt-3 px-3 bg-white rounded-lg drop-shadow-2xl inset-0  ">

                                <!--triangle-->
                                <div class="absolute -mt-5 right-40">
                                    <div class="w-0 h-0 border-l-[10px] border-l-transparent border-b-[10px] border-b-white border-r-[10px] border-r-transparent"></div>
                                </div>

                                <!-- header -->
                                <div class="px-1 py-2">
                                    <h1 class="float-left text-primary font-semibold text-[14px]">Notifications</h1>
                                    <div class="flex justify-between items-center float-right">
                                        <div class="cursor-pointer z-50">
                                            <button type="submit" name="seeAllBtn" id="seeAllBtn"
                                                    class="text-[12px] text-blue-700">
                                                See All
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <hr class="w-full border-[1px] border-[#F8F7F7]">

                                <div class="mt-2 pb-3">
                                    <div class="p-1">
                                        <div class="min-w-full inline-block max-h-[150px] overflow-y-auto overflow-x-hidden align-middle p-0 z-0">

                                            <div class="pb-1 text-left">
                                                <div class=" hover:bg-slate-100 flex justify-start gap-x-2 border-b-[2px] border-[#F8F7F7] p-2">
                                                    <div class="h-10 w-10 flex-shrink-0">
                                                        <img class="h-10 w-10 rounded-full"
                                                             src= "{{ asset('storage/mirkado/image/fritz.svg') }}"
                                                             alt="">
                                                    </div>
                                                    <div class="ml-2">
                                                        <div class="font-medium text-[11px] text-primary-800">
                                                            Michael Cruda Labastida
                                                            <p class="text-[10px] font-light">submit a product report.</p>
                                                        </div>
                                                        <div class="text-[8px] text-gray-500">
                                                            2 days ago
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pb-1 text-left">
                                                <div class=" hover:bg-slate-100 flex justify-start gap-x-2 border-b-[2px] border-[#F8F7F7] p-2">
                                                    <div class="h-10 w-10 flex-shrink-0">
                                                        <img class="h-10 w-10 rounded-full"
                                                             src= "{{ asset('storage/mirkado/image/fritz.svg') }}"
                                                             alt="">
                                                    </div>
                                                    <div class="ml-2">
                                                        <div class="font-medium text-[11px] text-primary-800">
                                                            Michael Cruda Labastida
                                                            <p class="text-[10px] font-light">submit a product report.</p>
                                                        </div>
                                                        <div class="text-[8px] text-gray-500">
                                                            2 days ago
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pb-1 text-left">
                                                <div class=" hover:bg-slate-100 flex justify-start gap-x-2 border-b-[2px] border-[#F8F7F7] p-2">
                                                    <div class="h-10 w-10 flex-shrink-0">
                                                        <img class="h-10 w-10 rounded-full"
                                                             src= "{{ asset('storage/mirkado/image/fritz.svg') }}"
                                                             alt="">
                                                    </div>
                                                    <div class="ml-2">
                                                        <div class="font-medium text-[11px] text-primary-800">
                                                            Michael Cruda Labastida
                                                            <p class="text-[10px] font-light">submit a product report.</p>
                                                        </div>
                                                        <div class="text-[8px] text-gray-500">
                                                            2 days ago
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pb-1 text-left">
                                                <div class=" hover:bg-slate-100 flex justify-start gap-x-2 border-b-[2px] border-[#F8F7F7] p-2">
                                                    <div class="h-10 w-10 flex-shrink-0">
                                                        <img class="h-10 w-10 rounded-full"
                                                             src= "{{ asset('storage/mirkado/image/fritz.svg') }}"
                                                             alt="">
                                                    </div>
                                                    <div class="ml-2">
                                                        <div class="font-medium text-[11px] text-primary-800">
                                                            Michael Cruda Labastida
                                                            <p class="text-[10px] font-light">submit a product report.</p>
                                                        </div>
                                                        <div class="text-[8px] text-gray-500">
                                                            2 days ago
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pb-1 text-left">
                                                <div class=" hover:bg-slate-100 flex justify-start gap-x-2 border-b-[2px] border-[#F8F7F7] p-2">
                                                    <div class="h-10 w-10 flex-shrink-0">
                                                        <img class="h-10 w-10 rounded-full"
                                                             src= "{{ asset('storage/mirkado/image/fritz.svg') }}"
                                                             alt="">
                                                    </div>
                                                    <div class="ml-2">
                                                        <div class="font-medium text-[11px] text-primary-800">
                                                            Michael Cruda Labastida
                                                            <p class="text-[10px] font-light">submit a product report.</p>
                                                        </div>
                                                        <div class="text-[8px] text-gray-500">
                                                            2 days ago
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pb-1 text-left">
                                                <div class=" hover:bg-slate-100 flex justify-start gap-x-2 border-b-[2px] border-[#F8F7F7] p-2">
                                                    <div class="h-10 w-10 flex-shrink-0">
                                                        <img class="h-10 w-10 rounded-full"
                                                             src= "{{ asset('storage/mirkado/image/fritz.svg') }}"
                                                             alt="">
                                                    </div>
                                                    <div class="ml-2">
                                                        <div class="font-medium text-[11px] text-primary-800">
                                                            Michael Cruda Labastida
                                                            <p class="text-[10px] font-light">submit a product report.</p>
                                                        </div>
                                                        <div class="text-[8px] text-gray-500">
                                                            2 days ago
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pb-1 text-left">
                                                <div class=" hover:bg-slate-100 flex justify-start gap-x-2 border-b-[2px] border-[#F8F7F7] p-2">
                                                    <div class="h-10 w-10 flex-shrink-0">
                                                        <img class="h-10 w-10 rounded-full"
                                                             src= "{{ asset('storage/mirkado/image/fritz.svg') }}"
                                                             alt="">
                                                    </div>
                                                    <div class="ml-2">
                                                        <div class="font-medium text-[11px] text-primary-800">
                                                            Michael Cruda Labastida
                                                            <p class="text-[10px] font-light">submit a product report.</p>
                                                        </div>
                                                        <div class="text-[8px] text-gray-500">
                                                            2 days ago
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pb-1 text-left">
                                                <div class=" hover:bg-slate-100 flex justify-start gap-x-2 border-b-[2px] border-[#F8F7F7] p-2">
                                                    <div class="h-10 w-10 flex-shrink-0">
                                                        <img class="h-10 w-10 rounded-full"
                                                             src= "{{ asset('storage/mirkado/image/fritz.svg') }}"
                                                             alt="">
                                                    </div>
                                                    <div class="ml-2">
                                                        <div class="font-medium text-[11px] text-primary-800">
                                                            Michael Cruda Labastida
                                                            <p class="text-[10px] font-light">submit a product report.</p>
                                                        </div>
                                                        <div class="text-[8px] text-gray-500">
                                                            2 days ago
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- More notification lists... -->
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <button type="button" class="relative -m-2.5 p-2.5 text-gray-400 hover:text-gray-500">
                                <span class="sr-only">View messages</span>
                                <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.83464 3.83301H19.168C20.2221 3.83301 21.0846 4.69551 21.0846 5.74967V17.2497C21.0846 18.3038 20.2221 19.1663 19.168 19.1663H3.83464C2.78047 19.1663 1.91797 18.3038 1.91797 17.2497V5.74967C1.91797 4.69551 2.78047 3.83301 3.83464 3.83301Z" stroke="#757575" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M21.0846 5.75L11.5013 12.4583L1.91797 5.75" stroke="#757575" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                <div class=" absolute top-1 ml-2  h-[13px] w-[24px] p-0 rounded-full bg-primary justify-center items-center">
                                    <p class="text-white text-[8px] ">99+</p>

                                </div>

                            </button>

                            <!-- Separator -->
                            <div class=" h-8 w-[1.5px] bg-gray-900/10" aria-hidden="true"></div>

                            <!-- Profile dropdown -->
                            <div class="relative">
                                <a href="{{route('admin.profile')}}"  class="-m-1.5 flex items-center p-1.5" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="h-8 w-8 rounded-full bg-gray-50 mr-2" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                    <span class="flex flex-col items-center justify-left">
                                        <span class="text-sm font-semibold leading-4 text-gray-900" aria-hidden="true">{{Auth::user()->superAdmin->first_name}} {{Auth::user()->superAdmin->last_name}}</span>
                                        <span class="text-xs leading-4 text-gray-500" aria-hidden="true">Super Admin</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <main class="border {{ ' '.$main_class }}">
                <div class="p-0">
                    <!-- Your content -->
                    {{ $slot }}
                </div>
            </main>
        </div>


    </div>




</x-app-layout>
