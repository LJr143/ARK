<div>
    @if (auth()->user()?->force_password_change)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50">
            <div class="bg-white p-6 rounded shadow w-full max-w-md">
                <h2 class="text-xl font-semibold mb-4">Change Your Password</h2>

                <form wire:submit.prevent="updatePassword">
                    @csrf
                    <div class="mb-4">
                        <label class="block">New Password</label>
                        <input type="password" wire:model.defer="newPassword" class="w-full border p-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block">Confirm Password</label>
                        <input type="password" wire:model.defer="newPassword_confirmation" class="w-full border p-2 rounded" required>
                    </div>

                    @error('newPassword') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

                    <div class="text-right">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
