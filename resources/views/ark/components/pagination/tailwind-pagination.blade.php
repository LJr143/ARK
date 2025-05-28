<div class="flex flex-col sm:flex-row items-center justify-between gap-3 px-3 sm:px-4 py-3 bg-white rounded-lg">
    <!-- Results Info -->
    <div class="text-xs sm:text-sm text-gray-600 whitespace-nowrap">
        Showing <span class="font-medium">{{ $paginator->firstItem() }}-{{ $paginator->lastItem() }}</span>
        of <span class="font-medium">{{ $paginator->total() }}</span> members
    </div>

    <!-- Pagination Controls -->
    <div class="flex items-center space-x-1 sm:space-x-2">
        <!-- Previous Button -->
        @if ($paginator->onFirstPage())
            <span class="px-2 sm:px-3 py-1 text-xs sm:text-sm text-gray-400 cursor-not-allowed">
                <span class="hidden sm:inline">&lt; Previous</span>
                <span class="sm:hidden">&lt;</span>
            </span>
        @else
            <button wire:click="previousPage"
                    class="px-2 sm:px-3 py-1 text-xs sm:text-sm text-gray-600 hover:text-gray-800">
                <span class="hidden sm:inline">&lt; Previous</span>
                <span class="sm:hidden">&lt;</span>
            </button>
        @endif

        <!-- Page Numbers - Hidden on small screens if too many -->
        <div class="hidden sm:flex items-center space-x-1 sm:space-x-2">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-1 text-xs sm:text-sm text-gray-600">...</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span
                                class="px-2 sm:px-3 py-1 text-xs sm:text-sm font-medium text-white bg-blue-600 rounded">
                                {{ $page }}
                            </span>
                        @else
                            <button wire:click="gotoPage({{ $page }})"
                                    class="px-2 sm:px-3 py-1 text-xs sm:text-sm text-gray-600 hover:text-gray-800">
                                {{ $page }}
                            </button>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        <!-- Mobile current page indicator -->
        <div class="sm:hidden px-2 py-1 text-xs font-medium text-white bg-blue-600 rounded">
            {{ $paginator->currentPage() }}
        </div>

        <!-- Next Button -->
        @if ($paginator->hasMorePages())
            <button wire:click="nextPage"
                    class="px-2 sm:px-3 py-1 text-xs sm:text-sm text-gray-600 hover:text-gray-800">
                <span class="hidden sm:inline">Next &gt;</span>
                <span class="sm:hidden">&gt;</span>
            </button>
        @else
            <span class="px-2 sm:px-3 py-1 text-xs sm:text-sm text-gray-400 cursor-not-allowed">
                <span class="hidden sm:inline">Next &gt;</span>
                <span class="sm:hidden">&gt;</span>
            </span>
        @endif
    </div>
</div>
