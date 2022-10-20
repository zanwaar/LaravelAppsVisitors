<?php

namespace App\Http\Livewire\Tamu;

use App\Events\TamuCheckIn;
use Illuminate\Support\Facades\Validator;
use App\Models\Tamu;
use Livewire\Component;

class ListTamu extends Component
{
    public $searchTerm = null;
    public function getTamuProperty()
    {
        return Tamu::latest()
            ->where('nama', 'like', '%' . $this->searchTerm . '%')
            ->orwhere('instansi', 'like', '%' . $this->searchTerm . '%')
            ->orwhere('jenisid', 'like', '%' . $this->searchTerm . '%')
            ->orwhere('ni', 'like', '%' . $this->searchTerm . '%')
            ->orwhere('alamat', 'like', '%' . $this->searchTerm . '%')
            ->orwhere('jk', 'like', '%' . $this->searchTerm . '%')
            ->paginate(10);
    }
    public function render()
    {
        $listtamu = $this->tamu;
        return view('livewire.tamu.list-tamu', ['tamu' => $listtamu]);
    }
}
