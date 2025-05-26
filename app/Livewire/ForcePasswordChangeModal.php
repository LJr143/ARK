<?php
namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ForcePasswordChangeModal extends Component
{
    public $newPassword;
    public $newPassword_confirmation;

    public function updatePassword(): void
    {
        $this->validate([
            'newPassword' => 'required|string|min:8|confirmed',
        ], [
            'newPassword.confirmed' => 'Password confirmation does not match.'
        ]);

        $user = Auth::user();
        $user->password = Hash::make($this->newPassword);
        $user->force_password_change = false;
        $user->save();

        session()->flash('message', 'Password updated successfully!');
    }

    public function render()
    {
        return view('livewire.force-password-change-modal');
    }
}
