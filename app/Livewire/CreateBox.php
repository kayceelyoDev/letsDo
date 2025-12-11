<?php

namespace App\Livewire;

use App\Http\Requests\boxRequest;
use App\Models\box;
use App\Models\boxMember;
use Auth;
use Livewire\Component;
use function Livewire\Volt\rules;
use Flux\Flux;
class CreateBox extends Component
{
    public $box_name = '';
    public $box_description = '';
    public $privacy = '';


   public function createbox()
    {
        $rules = (new boxRequest)->rules();
        $validated = $this->validate($rules);
        $validated['users_id'] = Auth::id();

        try {
           
            $newBox = box::create($validated);

         
            boxMember::create([
                'box_id' => $newBox->id,
                'user_id' => Auth::id(),
                'status' => 'approved',
               
            ]);
            
            $this->reset();
            Flux::modals()->close();
            Flux::toast('Box created successfully!');
            
       

        } catch (\Exception $e) {
            // Log the error for debugging if needed: \Log::error($e);
            $this->errorMessage = $e->getMessage();
        }
    }
    public function render()
    {
        return view('livewire.create-box');
    }
}
