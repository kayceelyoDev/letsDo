<?php

namespace App\Livewire;

use App\Models\box;
use Livewire\Component;

class Feedbox extends Component
{
    public $activeTab = 'latest';
    public $showModal = false;
    public Box $box;
    // Form Inputs (Removed $newTag)
    public $newContent = '';
    
    // Store user messages
    public $userMessages = []; 

    public function getMessagesProperty()
    {
        $dummyMessages = [
            [
                'id' => 1,
                'username' => 'alex_dev',
                'avatar_initial' => 'A',
                'time_ago' => '2 hours ago',
                'content' => 'Just realized that PHP is basically the elder scroll of the web.',
                'upvotes' => 120,
                'downvotes' => 5,
                'tag' => 'Hot Take',
                'tag_color' => 'red', 
            ],
            [
                'id' => 2,
                'username' => 'sarah_codes',
                'avatar_initial' => 'S',
                'time_ago' => '5 mins ago',
                'content' => 'Does anyone else feel like their code works on the first try only when they are about to give up?',
                'upvotes' => 12,
                'downvotes' => 0,
                'tag' => 'Question',
                'tag_color' => 'blue',
            ],
        ];

        $allMessages = array_merge($this->userMessages, $dummyMessages);

        return collect($allMessages)->sortByDesc(function ($item) {
            return $this->activeTab === 'top' 
                ? ($item['upvotes'] - $item['downvotes']) 
                : $item['id'];
        });
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function createMessage()
    {
      
    }
    public function mount(box $box){
        $this->box = $box;
    }

    public function render()
    {
    
        return view('livewire.feedbox');
    }
}