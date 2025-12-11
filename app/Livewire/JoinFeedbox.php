<?php

namespace App\Livewire;

use App\Models\Box;
use Livewire\Component;
use Livewire\Attributes\Computed;

class JoinFeedbox extends Component
{
    // Search state
    public $search = '';

    #[Computed]
    public function publicBoxes()
    {
        return Box::query()
            ->with('user') // Eager load creator
            // Count members
            ->where('privacy', 'Public') // Only show public boxes
           
            ->when($this->search, function ($query) {
                $query->where('box_name', 'like', '%' . $this->search . '%')
                      ->orWhere('box_description', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.join-feedbox');
    }
}