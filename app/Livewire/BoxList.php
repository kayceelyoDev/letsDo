<?php

namespace App\Livewire;


use App\Models\BoxMember;
use Auth;
use Livewire\Component;

class BoxList extends Component
{

    public function render()
    {
       $boxes = BoxMember::with('box')->where('user_id', auth()->id())->get();

        return view('livewire.box-list',[
            'boxes'=>$boxes
        ]);
    }
}
