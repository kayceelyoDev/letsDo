<?php

namespace App\Livewire;

use App\Models\Box;
use App\Models\Message;
use App\Services\FeedboxService;   // <--- New Service
use App\Services\FeedboxServices;
use App\Services\MessagesServices; // <--- Existing Service
use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\Computed;

class Feedbox extends Component
{
    // === PROPERTIES ===
    public Box $box;

    // UI State
    public $activeTab = 'latest';
    public $showModal = false;
    public $showCommunityModal = false;
    public $showEditBoxModal = false;
    public $communityTab = 'members';

    // Forms
    public $content = '';
    public $edit_box_name = '';
    public $edit_box_description = '';
    public $edit_privacy = '';
    public $errorMessages;
    public $editingMessageId = null;


    protected $listeners = [
        'memberUpdated' => '$refresh',
        'trigger-toast' => 'handleToast' // <--- Ensure this is here
    ];
    public $showDeleteConfirmModal = false;
    public $showLeaveConfirmModal = false;
    // Services
    protected MessagesServices $messageService;
    protected FeedboxServices $FeedboxServices;

    public function handleToast($message)
    {
        // This triggers the Flux UI toast
        Flux::toast($message);
    }

    // UPDATE: Delete Box (Remove direct delete logic, just open modal)
    public function confirmDeleteBox()
    {
        $this->showDeleteConfirmModal = true;
    }

    // UPDATE: Leave Box (Just open modal)
    public function confirmLeaveBox()
    {
        $this->showLeaveConfirmModal = true;
    }

    public function boot(MessagesServices $messageService, FeedboxServices $feedboxService)
    {
        $this->messageService = $messageService;
        $this->feedboxService = $feedboxService;
    }

    public function mount(Box $box)
    {
        $this->box = $box;
    }



    #[Computed]
    public function membersList()
    {
        return $this->feedboxService->getMembers($this->box->id);
    }

    #[Computed]
    public function pendingList()
    {
        return $this->feedboxService->getPendingRequests($this->box->id);
    }



    public function editBox()
    {
        if ($this->box->users_id !== auth()->id())
            return;

        // Pre-fill form
        $this->edit_box_name = $this->box->box_name;
        $this->edit_box_description = $this->box->box_description;
        $this->edit_privacy = $this->box->privacy;
        $this->showEditBoxModal = true;
    }

    public function updateBox()
    {
        if ($this->box->users_id !== auth()->id())
            return;

        $this->validate([
            'edit_box_name' => 'required|string|max:255',
            'edit_box_description' => 'nullable|string|max:1000',
            'edit_privacy' => 'required|in:Public,Private',
        ]);

        try {
            $this->feedboxService->updateBox($this->box, [
                'box_name' => $this->edit_box_name,
                'box_description' => $this->edit_box_description,
                'privacy' => $this->edit_privacy,
            ]);

            $this->showEditBoxModal = false;
            Flux::toast('Feedbox updated successfully!');
        } catch (\Exception $e) {
            $this->errorMessages = $e->getMessage();
        }
    }

    public function deleteBox()
    {
        if ($this->box->users_id !== auth()->id()) {
            Flux::toast('Unauthorized.', variant: 'danger');
            return;
        }

        $this->feedboxService->deleteBox($this->box);
        return redirect()->route('dashboard');
    }



    public function joinBox()
    {
  
        $status = $this->feedboxService->joinBox($this->box, auth()->id());

        if ($status === 'approved') {
            $this->dispatch('$refresh');
        } else {
            Flux::toast('Request sent to owner!');
        }
    }

    public function leaveBox()
    {
        $this->feedboxService->leaveBox($this->box->id, auth()->id());
        Flux::toast('You have left the box.');
        return redirect()->route('dashboard');
    }

    public function acceptRequest($memberId)
    {
        if ($this->feedboxService->updateRequestStatus($this->box->id, $memberId, 'approved')) {
            Flux::toast('Member approved!');
            $this->dispatch('memberUpdated');
        }
    }

    public function denyRequest($memberId)
    {
        if ($this->feedboxService->updateRequestStatus($this->box->id, $memberId, 'rejected')) {
            Flux::toast('Request denied.');
            $this->dispatch('memberUpdated');
        }
    }

    public function banMember($userId)
    {
        if ($this->feedboxService->banUser($this->box->id, $userId)) {
            Flux::toast('User banned.');
            $this->dispatch('memberUpdated');
        }
    }



    public function saveMessage()
    {
        $this->validate(['content' => 'string|required|max:1000']);

        try {
            $this->messageService->createOrUpdate(
                userId: auth()->id(),
                boxId: $this->box->id,
                content: $this->content,
                messageId: $this->editingMessageId
            );
            $this->resetModal();
            Flux::modals()->close();
        } catch (\Exception $e) {
            $this->errorMessages = $e->getMessage();
        }
    }

    public function editMessage(Message $message)
    {
        if ($message->user_id !== auth()->id())
            return;
        $this->editingMessageId = $message->id;
        $this->content = $message->content;
        $this->showModal = true;
    }

    public function deleteMessage($messageId)
    {
        $this->messageService->deleteMessage(auth()->id(), $messageId);
    }

    public function toggleVote($messageId, $type)
    {
        $this->messageService->toggleVote(auth()->id(), $messageId, $type);
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function resetModal()
    {
        $this->reset('content', 'errorMessages', 'editingMessageId', 'showModal');
    }



    public function render()
    {
        $userId = auth()->id();

        // 1. Get Status via Service
        $status = $this->feedboxService->getUserStatus($this->box->id, $userId);

        $isOwner = $this->box->users_id === $userId;
        $isMember = $status === 'approved';

        // 2. Authorized View (Feed)
        if ($isOwner || $isMember) {
            $messages = $this->messageService->getMessagesForBox($this->box, $this->activeTab);
            return view('livewire.feedbox', ['userMessages' => $messages]);
        }

        // 3. Unauthorized View (Request/Join)
        return view('livewire.request-feedbox', [
            'box' => $this->box,
            'membershipStatus' => $status
        ]);
    }
}