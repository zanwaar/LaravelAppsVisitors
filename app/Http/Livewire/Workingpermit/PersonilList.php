<?php

namespace App\Http\Livewire\Workingpermit;

use App\Models\Personil;
use Livewire\Component;

class PersonilList extends Component
{
    public function getPersonilProperty()
    {
        return Personil::latest()->paginate(5);
    }
    public function render()
    {
        $personil = $this->personil;
        return view('livewire.workingpermit.personil-list', ['personil' => $personil]);
    }
}
