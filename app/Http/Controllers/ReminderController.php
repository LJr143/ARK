<?php
// app/Http/Controllers/ReminderController.php
namespace App\Http\Controllers;

use App\Models\Reminder;
use App\Models\ReminderAttachment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class ReminderController extends Controller
{
    public function index()
    {
        $upcomingReminders = Reminder::where('status', 'upcoming')
            ->orderBy('start_datetime')
            ->get();

        $endedReminders = Reminder::where('status', 'ended')
            ->orderBy('start_datetime', 'desc')
            ->get();

        $archivedReminders = Reminder::where('status', 'archived')
            ->orderBy('start_datetime', 'desc')
            ->get();

        return view('ark.admin.reminders.index', compact('upcomingReminders', 'endedReminders', 'archivedReminders'));
    }

    public function create()
    {
        return view('ark.admin.reminders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start_datetime' => 'required|date',
            'end_datetime' => 'nullable|date|after:start_datetime',
            'location' => 'nullable|string|max:255',
            'recipient_type' => 'required|in:public,custom',
            'description' => 'nullable|string',
        ]);

        $reminder = Reminder::create([
            'title' => $validated['title'],
            'start_datetime' => $validated['start_datetime'],
            'end_datetime' => $validated['end_datetime'],
            'location' => $validated['location'],
            'recipient_type' => $validated['recipient_type'],
            'description' => $validated['description'],
            'status' => 'upcoming',
        ]);

        // Handle custom recipients if needed
        if ($validated['recipient_type'] === 'custom' && $request->has('recipients')) {
            $reminder->recipients()->sync($request->recipients);
        }

        return redirect()->route('reminders.index')->with('success', 'Reminder created successfully!');
    }

    public function edit(Reminder $reminder)
    {
        return view('ark.admin.reminders.edit', compact('reminder'));
    }

    public function update(Request $request, Reminder $reminder)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start_datetime' => 'required|date',
            'end_datetime' => 'nullable|date|after:start_datetime',
            'location' => 'nullable|string|max:255',
            'recipient_type' => 'required|in:public,custom',
            'description' => 'nullable|string',
            'status' => 'required|in:upcoming,ended,archived',
        ]);

        $reminder->update($validated);

        // Handle custom recipients if needed
        if ($validated['recipient_type'] === 'custom' && $request->has('recipients')) {
            $reminder->recipients()->sync($request->recipients);
        } else {
            $reminder->recipients()->detach();
        }

        return redirect()->route('reminders.index')->with('success', 'Reminder updated successfully!');
    }

    public function destroy(Reminder $reminder)
    {
        $reminder->delete();
        return redirect()->route('reminders.index')->with('success', 'Reminder deleted successfully!');
    }

    public function downloadAttachment(ReminderAttachment $attachment)
    {
        // Add any authorization checks here
        if (!Storage::exists($attachment->file_path)) {
            abort(404);
        }

        return Storage::download($attachment->file_path, $attachment->file_name);
    }
}
