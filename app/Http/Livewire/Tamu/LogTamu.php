<?php

namespace App\Http\Livewire\Tamu;

use App\Models\Logtamu as ModelsLogtamu;
use Livewire\Component;

class LogTamu extends Component
{
    public function render()
    {
        $logtamu = ModelsLogtamu::latest()->with(['tamu', 'bagian'])
            ->paginate(10);
        return view('livewire.tamu.log-tamu', ['logtamu' => $logtamu]);
    }
}
