<div class="flex items-center justify-between px-4 py-3 bg-white rounded-lg">
    <!-- Results Info -->
    <div class="text-sm text-gray-600">
        Showing <span class="font-medium">{{ $paginator->firstItem() }}-{{ $paginator->lastItem() }}</span> of <span class="font-medium">{{ $paginator->total() }}</span> members
    </div>

    <!-- Pagination Controls -->
    <div class="flex items-center space-x-2">
        <!-- Previous Button -->
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 text-sm text-gray-400 cursor-not-allowed">
                &lt; Previous
            </span>
        @else
            <button wire:click="previousPage" class="px-3 py-1 text-sm text-gray-600 hover:text-gray-800">
                &lt; Previous
            </button>
        @endif

        <!-- Page Numbers -->
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-1 text-sm text-gray-600">...</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1 text-sm font-medium text-white bg-blue-600 rounded">
                            {{ $page }}
                        </span>
                    @else
                        <button wire:click="gotoPage({{ $page }})" class="px-3 py-1 text-sm text-gray-600 hover:text-gray-800">
                            {{ $page }}
                        </button>
                    @endif
                @endforeach
            @endif
        @endforeach

        <!-- Next Button -->
        @if ($paginator->hasMorePages())
            <button wire:click="nextPage" class="px-3 py-1 text-sm text-gray-600 hover:text-gray-800">
                Next &gt;
            </button>
        @else
            <span class="px-3 py-1 text-sm text-gray-400 cursor-not-allowed">
                Next &gt;
            </span>
        @endif
    </div>
</div>
