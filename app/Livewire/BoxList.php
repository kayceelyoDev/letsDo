<?php

namespace App\Livewire;

use App\Models\box;
use Auth;
use Livewire\Component;

class BoxList extends Component
{

    public function render()
    {
       $boxes = box::with('user')->where('users_id',Auth::id())->get();

        return view('livewire.box-list',[
            'boxes'=>$boxes
        ]);
    }
}
