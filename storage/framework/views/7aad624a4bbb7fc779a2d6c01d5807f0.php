<div x-data="{ open: false }" x-cloak @election-created.window="open = false" @open-modal.window="open = true">
    <!-- Trigger Button -->
    <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['@click' => 'open = true','class' => 'bg-blue-600 hover:bg-blue-700 focus:bg-blue-700']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['@click' => 'open = true','class' => 'bg-blue-600 hover:bg-blue-700 focus:bg-blue-700']); ?>
        + New Reminder
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>

    <!-- Modal -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
    >
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90"
            class="bg-white p-6 rounded shadow-md w-full mx-4 sm:mx-6 md:mx-8 lg:mx-10 xl:mx-12 overflow-y-auto max-h-[90vh]"
            :class="{ 'sm:w-[38%]': $wire.currentStep === 1 || $wire.currentStep === 2 }"
        >


            <div class="flex justify-between items-center mb-4 border-b border-gray-300 pb-2">
                <div>
                    <div class="flex space-x-2 items-center">
                        <h2 class="text-sm font-bold text-left w-full sm:w-auto">New reminder</h2>
                        <h2 class="text-[11px] text-gray-500 text-left w-full sm:w-auto">Page 1 of 2</h2>
                    </div>
                    <p class="text-[10px] text-gray-500 italic">To add a new reminder please fill out the required
                        information.</p>

                </div>

                <!-- Close Button (X) -->
                <button @click="open = false; $wire.call('resetForm')" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>

            </div>

            <!--[if BLOCK]><![endif]--><?php if($currentStep === 1): ?>
                <form wire:submit.prevent="proceedToStep2" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input
                            id="title"
                            type="text"
                            class="text-[14px] border-0 rounded-lg px-0 py-2 w-full bg-gray-50 focus:bg-white focus:outline-none focus:ring-0 transition-colors"
                            wire:model="title"
                            placeholder="Reminder Title"
                            autofocus
                        >
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-red-500 text-[10px] italic"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                    <div class="mb-3 flex space-x-2">
                        <div class="w-1/3">
                            <p class="border-gray-300 bg-[#F1F5F9] text-xs text-gray-500 rounded-lg px-4 py-2 w-full focus:ring-black focus:border-black">
                                Reminder ID: <?php echo e($reminder_id); ?> </p>
                        </div>
                        <div class="w-2/3">
                            <select name="category" id="category" wire:model.live="category"
                                    class="border-gray-300 text-xs rounded-lg px-4 py-2 w-full focus:ring-black focus:border-black">
                                <!--[if BLOCK]><![endif]--><?php if($categories && count($categories) > 0): ?>
                                    <option value="" selected>Select Category</option>
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                <?php else: ?>
                                    <option value="">No categories available</option>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </select>
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-500 text-[10px] italic"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="text-xs font-semibold block mb-1">
                            Location (eg. Mandaluyong City Complex)
                        </label>
                        <input id="location" type="text"
                               class="border border-gray-300 text-xs rounded-lg px-4 py-2 w-full focus:ring-black focus:border-black"
                               wire:model="location">

                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-red-500 text-[10px] italic"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                    <div class="mb-3" x-data="{ hasPeriodCovered: false }">
                        <!-- Toggle checkbox -->
                        <label class="flex items-center space-x-2 cursor-pointer mb-2">
                            <input
                                type="checkbox"
                                class="rounded"
                                x-model="hasPeriodCovered"
                            >
                            <span class="font-semibold">Has period covered</span>
                        </label>

                        <!-- Conditional date range inputs -->
                        <div x-show="hasPeriodCovered" x-transition x-cloak class="space-y-2">
                            <div>
                                <label for="period_from" class="text-xs font-semibold block mb-1">
                                    From
                                </label>
                                <input
                                    id="period_from"
                                    type="date"
                                    class="border border-gray-300 text-xs rounded-lg px-4 py-2 w-full focus:ring-black focus:border-black"
                                    wire:model="period_from"
                                    x-bind:disabled="!hasPeriodCovered"
                                >
                            </div>

                            <div>
                                <label for="period_to" class="text-xs font-semibold block mb-1">
                                    To
                                </label>
                                <input
                                    id="period_to"
                                    type="date"
                                    class="border border-gray-300 text-xs rounded-lg px-4 py-2 w-full focus:ring-black focus:border-black"
                                    wire:model="period_to"
                                    x-bind:disabled="!hasPeriodCovered"
                                    x-bind:min="$el.previousElementSibling.value"
                                >
                            </div>
                        </div>
                    </div>
                    <p class="text-[12px] font-medium">Reminder Period</p>
                    <div class="flex flex-col md:flex-row md:space-x-4 mb-4 border border-gray-300 rounded-md p-4">
                        <div class="flex-1 mb-3 md:mb-0 min-w-0">
                            <label for="reminder_start" class="text-[10px] block mb-1">From</label>
                            <input id="reminder_start" type="datetime-local"
                                   class="border border-gray-300 text-xs rounded-md px-4 py-2 w-full focus:ring-black focus:border-black"
                                   wire:model="reminder_start">
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['reminder_start'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-500 text-[10px] italic"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                        <div class="flex-1 min-w-0">
                            <label for="reminder_end" class="text-[10px] block mb-1">To</label>
                            <input id="reminder_end" type="datetime-local"
                                   class="border border-gray-300 text-xs rounded-md px-4 py-2 w-full focus:ring-black focus:border-black"
                                   wire:model="reminder_end">
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['reminder_end'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-red-500 text-[10px] italic"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>
                    <div class="flex-1 mb-3">
                        <label for="description" class="text-xs font-semibold block mb-1">Description</label>
                        <textarea name="description" id="description"
                                  class="border-gray-300 text-xs rounded-lg px-4 py-2 w-full min-h-[100px]"
                                  style="resize: none"
                                  wire:model="description"></textarea>
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-red-500 text-[10px] italic"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                    <div
                        x-data="{
        dragOver: false,
        files: <?php if ((object) ('attachments') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('attachments'->value()); ?>')<?php echo e('attachments'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('attachments'); ?>')<?php endif; ?>,
        getFileIcon(fileName) {
            const ext = fileName.split('.').pop().toLowerCase();
            const icons = {
                'pdf': 'fas fa-file-pdf text-red-500',
                'doc': 'fas fa-file-word text-blue-600',
                'docx': 'fas fa-file-word text-blue-600',
                'xls': 'fas fa-file-excel text-green-600',
                'xlsx': 'fas fa-file-excel text-green-600',
                'ppt': 'fas fa-file-powerpoint text-orange-500',
                'pptx': 'fas fa-file-powerpoint text-orange-500',
                'txt': 'fas fa-file-alt text-gray-500',
                'zip': 'fas fa-file-archive text-yellow-600',
                'rar': 'fas fa-file-archive text-yellow-600',
                'jpg': 'fas fa-file-image text-purple-500',
                'jpeg': 'fas fa-file-image text-purple-500',
                'png': 'fas fa-file-image text-purple-500',
                'gif': 'fas fa-file-image text-purple-500',
                'mp4': 'fas fa-file-video text-red-600',
                'avi': 'fas fa-file-video text-red-600',
                'mp3': 'fas fa-file-audio text-green-500',
                'wav': 'fas fa-file-audio text-green-500'
            };
            return icons[ext] || 'fas fa-file text-gray-400';
        },
        formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        },
        handleDrop(e) {
            this.dragOver = false;
            const droppedFiles = Array.from(e.dataTransfer.files);

            // Simply set the files directly to the input
            this.$refs.fileInput.files = e.dataTransfer.files;

            // Let Livewire handle the upload automatically
            // Remove the manual event dispatch that was causing double uploads
        }
    }"
                        class="space-y-4"
                    >
                        <label class="block">
                            <span class="text-sm font-medium text-gray-700 mb-2 block">Attachments</span>

                            <!-- Drag & Drop Zone -->
                            <div
                                @dragover.prevent="dragOver = true"
                                @dragleave.prevent="dragOver = false"
                                @drop.prevent="handleDrop($event)"
                                :class="dragOver ? 'border-blue-500 bg-blue-50 scale-[1.02]' : 'border-gray-300 bg-gray-50'"
                                class="relative border-2 border-dashed rounded-lg p-8 text-center cursor-pointer transition-all duration-300 hover:border-blue-400 hover:bg-blue-50 hover:shadow-md"
                            >
                                <!-- Upload Icon and Text -->
                                <div class="space-y-3">
                                    <div class="mx-auto w-12 h-12 text-gray-400" :class="dragOver && 'animate-bounce'">
                                        <i class="fas fa-cloud-upload-alt text-4xl" :class="dragOver ? 'text-blue-500' : 'text-gray-400'"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-700">
                                            <span class="text-blue-600">Click to upload</span> or drag and drop
                                        </p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            PNG, JPG, PDF, DOC, DOCX, XLS, XLSX up to 10MB each
                                        </p>
                                    </div>
                                </div>

                                <!-- Hidden File Input -->
                                <input
                                    x-ref="fileInput"
                                    type="file"
                                    multiple
                                    wire:model="attachments"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                    accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.zip,.rar"
                                />
                            </div>
                        </label>

                        <!-- File Previews -->
                        <div x-show="$wire.attachments && $wire.attachments.length > 0" x-transition class="space-y-3">
                            <h4 class="text-sm font-medium text-gray-700 flex items-center">
                                <i class="fas fa-paperclip mr-2"></i>
                                Attached Files (<span x-text="$wire.attachments ? $wire.attachments.length : 0"></span>)
                            </h4>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="relative group bg-white border border-gray-200 rounded-lg p-3 hover:shadow-md transition-all duration-200">
                                        <div class="flex items-start space-x-3">
                                            <!-- File Icon or Image Preview -->
                                            <div class="flex-shrink-0">
                                                <!--[if BLOCK]><![endif]--><?php if(Str::startsWith($attachment->getMimeType(), 'image/')): ?>
                                                    <div class="w-12 h-12 rounded-lg overflow-hidden border border-gray-200">
                                                        <img
                                                            src="<?php echo e($attachment->temporaryUrl()); ?>"
                                                            alt="Preview"
                                                            class="w-full h-full object-cover"
                                                        />
                                                    </div>
                                                <?php else: ?>
                                                    <div class="w-12 h-12 flex items-center justify-center bg-gray-50 rounded-lg">
                                                        <i x-bind:class="getFileIcon('<?php echo e($attachment->getClientOriginalName()); ?>')" class="text-xl"></i>
                                                    </div>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            </div>

                                            <!-- File Info -->
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate" title="<?php echo e($attachment->getClientOriginalName()); ?>">
                                                    <?php echo e($attachment->getClientOriginalName()); ?>

                                                </p>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    <span x-text="formatFileSize(<?php echo e($attachment->getSize()); ?>)"></span>
                                                    <span class="mx-1">•</span>
                                                    <span class="uppercase"><?php echo e(pathinfo($attachment->getClientOriginalName(), PATHINFO_EXTENSION)); ?></span>
                                                </p>

                                                <!-- Progress Bar (if needed) -->
                                                <div class="mt-2">
                                                    <div class="w-full bg-gray-200 rounded-full h-1">
                                                        <div class="bg-green-500 h-1 rounded-full w-full"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Remove Button -->
                                            <button
                                                type="button"
                                                wire:click="removeAttachment(<?php echo e($index); ?>)"
                                                class="flex-shrink-0 p-1 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-full transition-colors duration-200 opacity-0 group-hover:opacity-100"
                                                title="Remove file"
                                            >
                                                <i class="fas fa-times text-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>


                        <!-- Error Messages -->
                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['attachments.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="mt-2 p-3 bg-red-50 border border-red-200 rounded-lg">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-exclamation-triangle text-red-500"></i>
                                <p class="text-sm text-red-700"><?php echo e($message); ?></p>
                            </div>
                        </div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

                        <!-- File Upload Tips -->
                        <div class="mt-3 p-3 bg-gray-50 rounded-lg">
                            <h5 class="text-xs font-medium text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-lightbulb mr-1 text-yellow-500"></i>
                                Upload Tips
                            </h5>
                            <ul class="text-xs text-gray-600 space-y-1">
                                <li>• Maximum file size: 10MB per file</li>
                                <li>• Supported formats: Images, PDFs, Office documents, Archives</li>
                                <li>• You can upload multiple files at once</li>
                                <li>• Drag and drop files directly onto the upload area</li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-2 pt-1 flex justify-end space-x-2 ">
                        <button type="button"
                                @click="open = false; $wire.call('resetForm')"
                                class="bg-white text-black text-[12px] border border-gray-300 h-7 px-4 py-1 rounded shadow-md hover:bg-gray-200 justify-center text-center hover:drop-shadow hover:scale-105 hover:ease-in-out hover:duration-300 transition-all duration-300 [transition-timing-function:cubic-bezier(0.175,0.885,0.32,1.275)] active:-translate-y-1 active:scale-x-90 active:scale-y-110">
                            Cancel
                        </button>
                        <button type="submit"
                                class="bg-blue-500 text-white px-6 py-1 h-7 rounded shadow-md hover:bg-gray-700 text-[12px] justify-center text-center hover:drop-shadow hover:scale-105 hover:ease-in-out hover:duration-300 transition-all duration-300 [transition-timing-function:cubic-bezier(0.175,0.885,0.32,1.275)] active:-translate-y-1 active:scale-x-90 active:scale-y-110">
                            Next ->
                        </button>
                    </div>
                </form>

            <?php elseif($currentStep === 2): ?>
                <form wire:submit.prevent="saveReminder">
                    <div class="space-y-4">
                        <!-- Recipient Selection -->
                        <div class="mb-4">
                            <h3 class="text-sm font-semibold mb-2">Select Recipient</h3>
                            <p class="text-xs text-gray-500 mb-3">Choose who should receive this reminder.</p>

                            <div class="space-y-3">
                                <div class="flex items-center space-x-2">
                                    <input type="radio" id="public_recipients"
                                           class="form-radio h-4 w-4 text-blue-600"
                                           wire:model="recipient_type" value="public">
                                    <label for="public_recipients" class="text-sm">Public (Visible to anyone)</label>
                                </div>

                                <div class="flex items-center space-x-2">
                                    <input type="radio" id="private_recipients"
                                           class="form-radio h-4 w-4 text-blue-600"
                                           wire:model="recipient_type" value="private">
                                    <label for="private_recipients" class="text-sm">Private (Only you)</label>
                                </div>

                                <div class="flex items-center space-x-2">
                                    <input type="radio" id="custom_recipients"
                                           class="form-radio h-4 w-4 text-blue-600"
                                           wire:model="recipient_type" value="custom">
                                    <label for="custom_recipients" class="text-sm">Custom Recipients</label>
                                </div>

                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['recipient_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-red-500 text-xs"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>

                            <!-- Custom Recipient Selection -->
                            <div x-show="$wire.recipient_type === 'custom'" x-transition class="mt-4 space-y-2">
                                <div x-data="{ isOpen: false }" class="relative">
                                    <input type="text"
                                           class="w-full border border-gray-300 rounded px-3 py-2 text-sm"
                                           placeholder="Search for recipients..."
                                           wire:model.live="recipientSearch"
                                           x-on:focus="isOpen = true"
                                           x-on:blur="setTimeout(() => isOpen = false, 200)">

                                    <div x-show="isOpen && $wire.recipientSearchResults.length"
                                         class="absolute z-10 mt-1 w-full bg-white shadow-lg rounded-md border border-gray-300 max-h-60 overflow-auto">
                                        <ul class="py-1">
                                            <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $recipientSearchResults; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <li class="px-3 py-2 hover:bg-gray-100 cursor-pointer flex items-center"
                                                    wire:click="toggleRecipient(<?php echo e($user->id); ?>)"
                                                    x-on:click="isOpen = false">
                                                    <span class="flex-1"><?php echo e($user->name); ?> (<?php echo e($user->email); ?>)</span>
                                                    <!--[if BLOCK]><![endif]--><?php if(in_array($user->id, $selected_recipients)): ?>
                                                        <svg class="h-5 w-5 text-green-500" fill="none"
                                                             viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2" d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <li class="px-3 py-2 text-gray-500">No results found</li>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </ul>
                                    </div>
                                </div>

                                <!-- Selected Recipients -->
                                <div class="flex flex-wrap gap-2 mt-2">
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $selected_recipients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $user = \App\Models\User::find($userId); ?>
                                        <!--[if BLOCK]><![endif]--><?php if($user): ?>
                                            <span
                                                class="inline-flex items-center bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                                    <?php echo e($user->name); ?>

                                    <button type="button"
                                            wire:click="toggleRecipient(<?php echo e($userId); ?>)"
                                            class="ml-1 text-blue-600 hover:text-blue-800">
                                        &times;
                                    </button>
                                </span>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>

                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['selected_recipients'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-red-500 text-xs"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>

                        <!-- Notification Methods -->
                        <div class="mb-4">
                            <h3 class="text-sm font-semibold mb-2">Notification Method</h3>
                            <p class="text-xs text-gray-500 mb-3">How should recipients be notified.</p>

                            <div class="space-y-2">
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="checkbox"
                                           class="form-checkbox h-4 w-4 text-blue-600"
                                           wire:model="notification_methods.email">
                                    <span class="text-sm">Email</span>
                                </label>

                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="checkbox"
                                           class="form-checkbox h-4 w-4 text-blue-600"
                                           wire:model="notification_methods.sms">
                                    <span class="text-sm">SMS</span>
                                </label>

                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="checkbox"
                                           class="form-checkbox h-4 w-4 text-blue-600"
                                           wire:model="notification_methods.app">
                                    <span class="text-sm">App Notification</span>
                                </label>

                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['notification_methods'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-red-500 text-xs"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="flex justify-between pt-4 border-t border-gray-200">
                            <button type="button"
                                    wire:click="backToStep1"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                ← Back
                            </button>

                            <button type="submit"
                                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Create Reminder
                            </button>
                        </div>
                    </div>
                </form>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        </div>
    </div>

</div>
<?php /**PATH C:\laragon\www\ARK\resources\views/livewire/reminder/create-reminder.blade.php ENDPATH**/ ?>