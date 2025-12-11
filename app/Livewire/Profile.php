<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\User;
use App\Models\BoxMember;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Flux\Flux;

class Profile extends Component
{
    // Edit Modal State
    public $showEditModal = false;
    public $editingMessageId = null;
    public $content = '';

    #[Computed]
    public function user()
    {
        return Auth::user();
    }

    #[Computed]
    public function stats()
    {
        $userId = $this->user->id;

        return [
            // Count boxes created + boxes joined
            'joined_boxes' => BoxMember::where('user_id', $userId)
                ->where('status', 'approved')
                ->count(),
            
            'total_messages' => Message::where('user_id', $userId)->count(),
            
            // Sum of upvotes on user's messages
            'total_upvotes' => Message::where('user_id', $userId)->sum('upvotes'),
        ];
    }

    #[Computed]
    public function messageHistory()
    {
        return Message::query()
            ->with('box') // Eager load the Feedbox info
            ->where('user_id', $this->user->id)
            ->latest()
            ->get();
    }

    // === ACTIONS ===

    public function deleteMessage($messageId)
    {
        $message = Message::find($messageId);

        // Security: Only delete own messages
        if ($message && $message->user_id === Auth::id()) {
            $message->delete();
            Flux::toast('Message deleted successfully.');
        } else {
            Flux::toast('Unauthorized action.', variant: 'danger');
        }
    }

    public function editMessage($messageId)
    {
        $message = Message::find($messageId);

        if ($message && $message->user_id === Auth::id()) {
            $this->editingMessageId = $message->id;
            $this->content = $message->content;
            $this->showEditModal = true;
        }
    }

    public function updateMessage()
    {
        $this->validate(['content' => 'required|string|max:1000']);

        $message = Message::find($this->editingMessageId);

        if ($message && $message->user_id === Auth::id()) {
            $message->update(['content' => $this->content]);
            
            $this->showEditModal = false;
            Flux::toast('Message updated successfully.');
        }
    }

    public function render()
    {
        return view('livewire.profile');
    }
}