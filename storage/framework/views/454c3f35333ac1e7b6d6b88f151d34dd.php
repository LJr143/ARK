<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
    <div class="flex justify-between items-center align-middle">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Reminders</h1>
    </div>
    <div>
        <div class="border-gray-200">
            <nav class="flex space-x-8 overflow-x-auto" aria-label="Tabs">
                <div class="flex bg-[#F1F5F9] p-4 rounded-md space-x-8">
                    <button
                        wire:click="$set('filter', 'all_reminders')"
                        class="whitespace-nowrap px-1 text-[12px] font-medium <?php echo e($filter === 'all_reminders' ? 'bg-white py-2 px-4 rounded text-black' : 'text-gray-500 hover:text-black'); ?>"
                    >
                        All Reminders
                    </button>
                    <button
                        wire:click="$set('filter', 'upcoming_reminders')"
                        class="whitespace-nowrap px-1 text-[12px] font-medium <?php echo e($filter === 'upcoming_reminders' ? 'bg-white py-2 px-4 rounded text-black' : 'text-gray-500 hover:text-black'); ?>"
                    >
                        Upcoming
                    </button>
                    <button
                        wire:click="$set('filter', 'ended_reminders')"
                        class="whitespace-nowrap px-1 text-[12px] font-medium <?php echo e($filter === 'ended_reminders' ? 'bg-white py-2 px-4 rounded text-black' : 'text-gray-500 hover:text-black'); ?>"
                    >
                        Ended
                    </button>
                    <button
                        wire:click="$set('filter', 'archived_reminders')"
                        class="whitespace-nowrap px-1 text-[12px] font-medium <?php echo e($filter === 'archived_reminders' ? 'bg-white py-2 px-4 rounded text-black' : 'text-gray-500 hover:text-black'); ?>"
                    >
                        Archived
                    </button>
                </div>
            </nav>
        </div>
        <div class="mt-8 min-h-screen">
            <div class="border rounded min-h-screen">

            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\ARK\resources\views/livewire/reminder/reminder.blade.php ENDPATH**/ ?>