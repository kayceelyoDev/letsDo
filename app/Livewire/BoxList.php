<?php

namespace App\Livewire;

use App\Models\box;
use App\Models\boxMember;
use Auth;
use Livewire\Component;

class BoxList extends Component
{

    public function render()
    {
       $boxes = boxMember::with('box')->where('user_id', auth()->id())->get();

        return view('livewire.box-list',[
            'boxes'=>$boxes
        ]);
    }
}
