<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
    <div class="flex justify-between items-center align-middle">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard</h1>

        <!-- Date Filter -->
        <div class="mb-8 flex flex-col sm:flex-row gap-4 items-start sm:items-end">
            <div class="w-full sm:w-48">
                <x-label for="start-date" value="From Date" />
                <x-input
                    id="start-date"
                    type="date"
                    class="w-full mt-1"
                    wire:model="startDate"
                />
            </div>
            <div class="w-full sm:w-48">
                <x-label for="end-date" value="To Date" />
                <x-input
                    id="end-date"
                    type="date"
                    class="w-full mt-1"
                    wire:model="endDate"
                />
            </div>
            <x-button class="!bg-blue-600" wire:click="filterByDate">
                Apply Filter
            </x-button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Paid Dues -->
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <h3 class="text-lg font-medium text-gray-600 mb-2">Total Paid Dues</h3>
            <p class="text-3xl font-bold text-gray-800">₱ {{ number_format($paidDues, 2) }}</p>
            <p class="text-gray-500 mt-2">{{ $paidMembers }} Members</p>
        </div>

        <!-- Total Unpaid Dues -->
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <h3 class="text-lg font-medium text-gray-600 mb-2">Total Unpaid Dues</h3>
            <p class="text-3xl font-bold text-gray-800">₱ {{ number_format($unpaidDues, 2) }}</p>
            <p class="text-gray-500 mt-2">{{ $unpaidMembers }} Members</p>
        </div>

        <!-- Total Dues -->
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <h3 class="text-lg font-medium text-gray-600 mb-2">Total Dues</h3>
            <p class="text-3xl font-bold text-gray-800">₱ {{ number_format($totalDues, 2) }}</p>
            <p class="text-gray-500 mt-2">{{ $totalMembers }} Members</p>
        </div>
    </div>

    <!-- Overview Chart -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Overview</h2>
        <p class="text-gray-600 mb-4">Graphical representation of members' payment from {{ \Carbon\Carbon::parse($startDate)->format('M d, Y') }} to {{ \Carbon\Carbon::parse($endDate)->format('M d, Y') }}</p>
        <div class="h-64 bg-gray-50 rounded flex items-center justify-center">
            <p class="text-gray-400">Nothing to show yet</p>
        </div>
    </div>

    <!-- Payment Status Chart -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Member Dues Payment Status</h2>
        <p class="text-gray-600 mb-4">Distribution of active and inactive dues payments from {{ \Carbon\Carbon::parse($startDate)->format('M d, Y') }} to {{ \Carbon\Carbon::parse($endDate)->format('M d, Y') }}</p>
        <div class="h-64 bg-gray-50 rounded flex items-center justify-center">
            <p class="text-gray-400">Nothing to show yet</p>
        </div>
    </div>
</div>
