<?php

namespace App\Livewire\ProfileSetting;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ManageProfileSettings extends Component
{
    use WithPagination;
    public $users;
    public $searchQuery = '';
    public $searchedUsers = [];
    public $selectedUserId = null;
    public $selectedUserName = '';
    public $selectedUser = null;
    public $newMember = [
        'role' => ''
    ];
    public $editingMember = false;
    public $editingMemberId = null;
    public $selectedRole = null;
    public $selectedPermissions = [];

    protected $rules = [
        'selectedUserId' => 'required|exists:users,id',
        'newMember.role' => 'required|in:superadmin,admin',
    ];

    protected $listeners = ['selectUser'];

    public function mount()
    {
        $this->users = User::with('roles')
            ->whereHas('roles', function ($query) {
                $query->whereIn('name', ['superadmin', 'admin']);
            })->get();
    }

    public function updatedSearchQuery(): void
    {
        if (strlen($this->searchQuery) >= 2) {
            $this->searchedUsers = User::where(function ($query) {
                $query->where(DB::raw("CONCAT(first_name, ' ', family_name)"), 'like', '%' . $this->searchQuery . '%')
                    ->orWhere('email', 'like', '%' . $this->searchQuery . '%')
                    ->orWhere('first_name', 'like', '%' . $this->searchQuery . '%')
                    ->orWhere('middle_name', 'like', '%' . $this->searchQuery . '%')
                    ->orWhere('family_name', 'like', '%' . $this->searchQuery . '%');
            })->take(10)->get();
            Log::info('Search results: ', $this->searchedUsers->toArray());
        } else {
            $this->searchedUsers = [];
        }
    }

    public function selectUser($userId)
    {
        $user = User::findOrFail($userId);
        $this->selectedUserId = $user->id;
        $this->selectedUser = $user;
        $this->selectedUserName = $user->first_name . ' ' . ($user->middle_name ? $user->middle_name . ' ' : '') . $user->family_name;
        $this->newMember['role'] = $user->getRoleNames()->first() ?? '';
        $this->searchQuery = '';
        $this->searchedUsers = [];
    }

    public function saveMember(): void
    {
        Log::info('Saving member with data: ', [
            'selectedUserId' => $this->selectedUserId,
            'newMember' => $this->newMember
        ]);
        $this->validate();

        $user = User::findOrFail($this->selectedUserId);
        $user->syncRoles([$this->newMember['role']]);

        $this->resetForm();
        $this->users = User::with('roles')
            ->whereHas('roles', function ($query) {
                $query->whereIn('name', ['superadmin', 'admin']);
            })->get();
        $this->dispatch('close-modal');
        session()->flash('message', $this->editingMember ? 'Role updated successfully.' : 'Role assigned successfully.');
        $this->editingMember = false;
        $this->editingMemberId = null;
    }

    public function editMember($userId)
    {
        if (auth()->id() === $userId) {
            session()->flash('error', 'You cannot edit your own role.');
            return;
        }
        Log::info("editMember called with user ID: {$userId}");
        $user = User::findOrFail($userId);
        Log::info("Editing user: ", $user->toArray());
        $this->editingMember = true;
        $this->editingMemberId = $userId;
        $this->selectedUserId = $user->id;
        $this->selectedUser = $user;
        $this->selectedUserName = $user->first_name . ' ' . ($user->middle_name ? $user->middle_name . ' ' : '') . $user->family_name;
        $this->newMember['role'] = $user->getRoleNames()->first() ?? '';
        Log::info("Dispatching show-add-member-modal event");
        $this->dispatch('shows-add-member-modal');
    }

    public function removeMember($userId): void
    {
        if (auth()->id() === $userId) {
            session()->flash('error', 'You cannot remove yourself.');
            return;
        }

        $user = User::findOrFail($userId);
        $user->syncRoles(['member']);
        $this->users = User::with('roles')->get();
        session()->flash('message', 'User roles updated to member successfully.');
    }

    public function configureRole($roleName): void
    {
        $this->selectedRole = $roleName;
        $role = Role::where('name', $roleName)->first();
        $this->selectedPermissions = $role->permissions->pluck('id')->toArray();
        $this->dispatch('show-role-modal');
    }

    public function saveRolePermissions(): void
    {
        $role = Role::where('name', $this->selectedRole)->first();
        $permissions = Permission::whereIn('id', $this->selectedPermissions)->pluck('name')->toArray();
        $role->syncPermissions($permissions);

        $this->selectedRole = null;
        $this->selectedPermissions = [];
        $this->dispatch('close-modal');
        session()->flash('message', 'Role permissions updated successfully.');
    }

    public function resetForm(): void
    {
        $this->searchQuery = '';
        $this->searchedUsers = [];
        $this->selectedUserId = null;
        $this->selectedUserName = '';
        $this->selectedUser = null;
        $this->newMember = ['role' => ''];
        $this->editingMember = false;
        $this->editingMemberId = null;
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.profile-setting.manage-profile-settings');
    }
}
