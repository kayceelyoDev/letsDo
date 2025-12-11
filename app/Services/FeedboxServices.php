<?php

namespace App\Services;

use App\Models\Box;
use App\Models\BoxMember;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class FeedboxServices
{
    /**
     * Get approved members for a specific box.
     */
    public function getMembers(string $boxId): Collection
    {
        return BoxMember::with('user')
            ->where('box_id', $boxId)
            ->where('status', 'approved')
            ->latest()
            ->get();
    }

    /**
     * Get pending join requests for a specific box.
     */
    public function getPendingRequests(string $boxId): Collection
    {
        return BoxMember::with('user')
            ->where('box_id', $boxId)
            ->where('status', 'pending')
            ->latest()
            ->get();
    }

    /**
     * Handle a user joining a box.
     */
    public function joinBox(Box $box, int $userId): string
    {
        // Public boxes = Instant Approval. Private = Pending.
        $status = ($box->privacy === 'Public') ? 'approved' : 'pending';

        BoxMember::firstOrCreate(
            ['box_id' => $box->id, 'user_id' => $userId],
            ['status' => $status, 'role' => 'member']
        );

        return $status;
    }

    /**
     * Approve or Reject a specific request by Member ID (primary key).
     */
    public function updateRequestStatus(string $boxId, int $memberId, string $status): bool
    {
        $member = BoxMember::find($memberId);

        // Security check: Ensure member belongs to this box
        if (!$member || $member->box_id !== $boxId) {
            return false;
        }

        $member->update(['status' => $status]);
        return true;
    }

    /**
     * Ban a user specifically by User ID.
     */
    public function banUser(string $boxId, int $userId): bool
    {
        $member = BoxMember::where('box_id', $boxId)
            ->where('user_id', $userId)
            ->first();

        if ($member) {
            $member->update(['status' => 'banned']);
            return true;
        }
        return false;
    }

    /**
     * User leaves a box.
     */
    public function leaveBox(string $boxId, int $userId): void
    {
        BoxMember::where('box_id', $boxId)
            ->where('user_id', $userId)
            ->delete();
    }

    /**
     * Update Box Details.
     */
    public function updateBox(Box $box, array $data): void
    {
        $box->update($data);
    }

    /**
     * Delete a Box and all related data (Messages, Members).
     */
    public function deleteBox(Box $box): void
    {
        DB::transaction(function () use ($box) {
            // Manual cleanup if constraints don't cascade automatically
            Message::where('box_id', $box->id)->delete();
            BoxMember::where('box_id', $box->id)->delete();
            $box->delete();
        });
    }

    /**
     * Get the membership status of a specific user.
     */
    public function getUserStatus(string $boxId, int $userId): ?string
    {
        $member = BoxMember::where('box_id', $boxId)
            ->where('user_id', $userId)
            ->first();

        return $member ? $member->status : null;
    }
}