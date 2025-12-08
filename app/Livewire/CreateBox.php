<?php

namespace App\Livewire;

use App\Http\Requests\boxRequest;
use App\Models\box;
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
            box::create($validated);
            $this->reset();

            Flux::modals()->close();
            Flux::toast('Box created successfully!');
        } catch (\Exception $e) {
            $this->errorMessage = $e->getMessage();
        }

    }
    public function render()
    {
        return view('livewire.create-box');
    }
}
