<?php

namespace App\Http\Livewire\Tamu;

use App\Events\TamuCheckIn;
use Illuminate\Support\Facades\Validator;
use App\Models\Tamu;
use Livewire\Component;

class ListTamu extends Component
{

    public function render()
    {
        $tamu = Tamu::latest()
            ->paginate(10);
        return view('livewire.tamu.list-tamu', ['tamu' => $tamu]);
    }
}
