<?php

namespace App\Livewire;

use App\Models\Box;
use App\Models\Message;
use App\Services\MessagesServices;
use Flux\Flux;
use Livewire\Component;

class Feedbox extends Component
{
    // Properties
    public Box $box;
    public $activeTab = 'latest';
    public $showModal = false;
    public $content = '';
    public $errorMessages;
    public $editingMessageId = null;
    
    // We don't store $userMessages as a public property anymore 
    // to prevent large payloads. We pass it directly in render().

    // Dependency Injection
    protected MessagesServices $messageService;

    // Boot method injects the service automatically
    public function boot(MessagesServices $messageService)
    {
        $this->messageService = $messageService;
    }

    public function mount(Box $box)
    {
        $this->box = $box;
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
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
        // Simple UI check (Service handles the real security check on save)
        if ($message->user_id !== auth()->id()) return;

        $this->editingMessageId = $message->id;
        $this->content = $message->content;
        $this->showModal = true;
    }

    public function deleteMessage($messageId)
    {
        try {
            $this->messageService->deleteMessage(auth()->id(), $messageId);
        } catch (\Exception $e) {
            $this->errorMessages = $e->getMessage();
        }
    }

    public function toggleVote($messageId, $type)
    {
        $this->messageService->toggleVote(auth()->id(), $messageId, $type);
    }

    public function resetModal()
    {
        $this->reset('content', 'errorMessages', 'editingMessageId', 'showModal');
    }

    public function render()
    {
        // Clean and performant fetching via Service
        $messages = $this->messageService->getMessagesForBox($this->box, $this->activeTab);

        return view('livewire.feedbox', [
            'userMessages' => $messages
        ]);
    }
}