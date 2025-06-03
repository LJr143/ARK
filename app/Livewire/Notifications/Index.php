<?php

namespace App\Livewire\Notifications;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class Index extends Component
{
    public $filter = 'all'; // all, unread, read
    public $perPage = 20;
    public $loaded = false;

    protected $listeners = ['notificationRead' => '$refresh', 'notificationDeleted' => '$refresh'];

    public function mount()
    {
        $this->loaded = true;
    }

    public function getNotificationsProperty()
    {
        if (!$this->loaded) return collect();

        $query = Auth::user()->notifications()->latest();

        if ($this->filter === 'unread') {
            $query->whereNull('read_at');
        } elseif ($this->filter === 'read') {
            $query->whereNotNull('read_at');
        }

        return $query->paginate($this->perPage);
    }

    public function getUnreadCountProperty()
    {
        return Auth::user()->unreadNotifications()->count();
    }

    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->where('id', $id)->first();

        if ($notification && !$notification->read_at) {
            $notification->markAsRead();
            $this->emitSelf('notificationRead');
        }
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        $this->emitSelf('notificationRead');
    }

    public function deleteNotification($id)
    {
        Auth::user()->notifications()->where('id', $id)->delete();
        $this->emitSelf('notificationDeleted');
    }

    public function clearAll()
    {
        Auth::user()->notifications()->delete();
        $this->emitSelf('notificationDeleted');
    }

    public function loadMore()
    {
        $this->perPage += 20;
    }

    public function render()
    {
        return view('livewire.notifications.index', [
            'notifications' => $this->notifications,
        ]);
    }
}
