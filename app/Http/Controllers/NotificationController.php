<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    /**
     * Get all notifications for the authenticated user
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();

            $notifications = $user->notifications()
                ->orderBy('created_at', 'desc')
                ->limit(50) // Limit to prevent performance issues
                ->get()
                ->map(function ($notification) {
                    return [
                        'id' => $notification->id,
                        'type' => $notification->type,
                        'title' => $notification->data['title'] ?? 'Notification',
                        'message' => $notification->data['message'] ?? '',
                        'data' => $notification->data,
                        'read_at' => $notification->read_at,
                        'created_at' => $notification->created_at,
                        'updated_at' => $notification->updated_at,
                    ];
                });

            return response()->json($notifications);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch notifications',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mark a specific notification as read
     */
    public function markAsRead(Request $request, string $id): JsonResponse
    {
        try {
            $user = Auth::user();

            $notification = $user->notifications()->find($id);

            if (!$notification) {
                return response()->json([
                    'error' => 'Notification not found'
                ], 404);
            }

            $notification->markAsRead();

            return response()->json([
                'success' => true,
                'message' => 'Notification marked as read'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to mark notification as read',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mark all notifications as read for the authenticated user
     */
    public function markAllAsRead(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();

            $user->unreadNotifications->markAsRead();

            return response()->json([
                'success' => true,
                'message' => 'All notifications marked as read'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to mark all notifications as read',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Clear all notifications for the authenticated user
     */
    public function clearAll(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();

            $user->notifications()->delete();

            return response()->json([
                'success' => true,
                'message' => 'All notifications cleared'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to clear notifications',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete a specific notification
     */
    public function destroy(Request $request, string $id): JsonResponse
    {
        try {
            $user = Auth::user();

            $notification = $user->notifications()->find($id);

            if (!$notification) {
                return response()->json([
                    'error' => 'Notification not found'
                ], 404);
            }

            $notification->delete();

            return response()->json([
                'success' => true,
                'message' => 'Notification deleted'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to delete notification',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get unread notification count
     */
    public function unreadCount(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();
            $count = $user->unreadNotifications()->count();

            return response()->json([
                'count' => $count
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to get unread count',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
