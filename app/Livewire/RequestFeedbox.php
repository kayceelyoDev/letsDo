<?php

namespace App\Livewire;

use App\Models\Box;
use App\Models\boxMember;
use Flux\Flux;
use Livewire\Component;

class RequestFeedbox extends Component
{

    public $box;

    public $status;

    public function mount(Box $box)
    {
        $this->box = $box;
    }

    public function joinBox()
    {
        $userId = auth()->id();
        $boxId = $this->box->id;

        $status = ($this->box->privacy === "Public") ? 'approved' : 'pending';

      
        BoxMember::firstOrCreate(
            [
                'box_id' => $boxId,
                'user_id' => $userId
            ],
            [
                'status' => $status,
            ]
        );

        if ($status === 'approved') {
          
            return redirect()->route('feedbox', $this->box->id);
        } else {
            Flux::toast('Request sent to owner!');
            $this->dispatch('$refresh');
        }
    }
    public function render()
    {
    
        return view('livewire.request-feedbox');
    }
}
