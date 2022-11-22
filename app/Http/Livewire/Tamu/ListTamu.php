<?php

namespace App\Http\Livewire\Tamu;

use App\Http\Livewire\AppComponent;
use App\Models\Tamu;

class ListTamu extends AppComponent
{
    public $searchTerm = null;

    public function getTamuProperty()
    {
        return Tamu::latest()
            ->where(function ($query) {
                $query->where('nama', 'like', '%' . $this->searchTerm . '%');
                $query->orwhere('instansi', 'like', '%' . $this->searchTerm . '%');
                $query->orwhere('jenisid', 'like', '%' . $this->searchTerm . '%');
                $query->orwhere('ni', 'like', '%' . $this->searchTerm . '%');
                $query->orwhere('alamat', 'like', '%' . $this->searchTerm . '%');
                $query->orwhere('jk', 'like', '%' . $this->searchTerm . '%');
            })
            ->paginate($this->trow);
    }
    public function render()
    {
        $listtamu = $this->tamu;
        return view('livewire.tamu.list-tamu', ['tamu' => $listtamu]);
    }
}
