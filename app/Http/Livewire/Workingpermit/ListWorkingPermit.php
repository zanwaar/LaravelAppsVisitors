<?php

namespace App\Http\Livewire\Workingpermit;

use App\Http\Livewire\AppComponent;
use App\Models\Workingpermit;

class ListWorkingPermit extends AppComponent
{
    public function getmitraProperty()
    {
        return Workingpermit::latest()->paginate($this->trow);
    }
    public function render()
    {
        $data = $this->mitra;
        return view('livewire.workingpermit.list-working-permit', ['mitra' => $data]);
    }
}
