<?php

namespace App\Services;

use App\Models\Box;
use App\Models\Message; // Note: Standard Laravel models are usually Capitalized
use App\Models\Votes;
use Illuminate\Support\Facades\DB;
use Exception;

class MessagesServices
{
    /**
     * Fetch messages for a specific box with optimized loading.
     */
    public function getMessagesForBox(Box $box, string $sortType = 'latest')
    {
        $query = Message::query()
            ->with(['user', 'userVotes']) // Eager load user AND the current user's vote
            ->where('box_id', $box->id); // CRITICAL: Only get messages for this box

        if ($sortType === 'top') {
            // Sort by calculated score (upvotes - downvotes) is complex in SQL, 
            // usually sorting by raw upvotes is 'good enough' for simple apps.
            // Or strictly by the 'upvotes' column.
            $query->orderBy('upvotes', 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        return $query->get();
    }

    /**
     * Handle both Creation and Updating of messages.
     */
    public function createOrUpdate(int $userId, string $boxId, string $content, ?int $messageId = null): void
    {
        if ($messageId) {
            // === UPDATE LOGIC ===
            $message = Message::find($messageId);

            if (!$message) {
                throw new Exception("Message not found.");
            }

            // Security: Authorize
            if ($message->user_id !== $userId) {
                throw new Exception("Unauthorized action.");
            }

            $message->update(['content' => $content]);
        } else {
            // === CREATE LOGIC ===
            Message::create([
                'user_id' => $userId,
                'box_id'  => $boxId,
                'content' => $content,
            ]);
        }
    }

    /**
     * Securely delete a message.
     */
    public function deleteMessage(int $userId, int $messageId): void
    {
        $message = Message::find($messageId);

        if (!$message) return;

        // Security: Authorize
        if ($message->user_id !== $userId) {
            throw new Exception("You are not authorized to delete this message.");
        }

        $message->delete();
    }

    /**
     * Handle the complex Upvote/Downvote logic atomically.
     */
    public function toggleVote(int $userId, int $messageId, string $type): void
    {
        $message = Message::find($messageId);
        if (!$message) return;

        DB::transaction(function () use ($message, $userId, $type) {
            // Check if user has already voted
            $existingVote = Votes::where('user_id', $userId)
                ->where('message_id', $message->id)
                ->lockForUpdate() // Lock row to prevent race conditions
                ->first();

            if ($existingVote) {
                if ($existingVote->type === $type) {
                    // 1. Remove Vote (User toggled same button)
                    $existingVote->delete();
                    
                    $type === 'up' 
                        ? $message->decrement('upvotes') 
                        : $message->decrement('downvotes');
                } else {
                    // 2. Switch Vote (Up -> Down OR Down -> Up)
                    $existingVote->update(['type' => $type]);

                    if ($type === 'up') {
                        $message->decrement('downvotes');
                        $message->increment('upvotes');
                    } else {
                        $message->decrement('upvotes');
                        $message->increment('downvotes');
                    }
                }
            } else {
                // 3. New Vote
                Votes::create([
                    'user_id'    => $userId,
                    'message_id' => $message->id,
                    'type'       => $type
                ]);

                $type === 'up' 
                    ? $message->increment('upVotes') 
                    : $message->increment('downVotes');
            }
        });
    }
}