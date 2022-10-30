<?php

namespace App\Http\Livewire\Tamu;


use App\Http\Livewire\AppComponent;
use App\Models\Logtamu as ModelsLogtamu;

class LogTamu extends AppComponent
{
    public $selectedRows = [];
    public $selectPageRows = false;
    public $option = 'TODAY';
    public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];
    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function camcel()
    {
        $this->logtamu;
    }
    public function updatedSelectPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->logtamu->pluck('id')->map(function ($id) {
                return (string) $id;
            });
        } else {
            $this->reset(['selectedRows', 'selectPageRows']);
        }
    }

    public function getLogtamuProperty()
    {
        return ModelsLogtamu::latest()->with(['tamu', 'bagian'])
            ->whereRelation('tamu', 'nama', 'like', '%' . $this->searchTerm . '%')
            ->orwhereRelation('tamu', 'instansi', 'like', '%' . $this->searchTerm . '%')
            ->orwhereRelation('bagian', 'namaTenant', 'like', '%' . $this->searchTerm . '%')
            ->orwhere('keperluan', 'like', '%' . $this->searchTerm . '%')
            ->whereBetween('checkin', $this->maropsi($this->option))
            ->paginate(10);
    }

    public function maropsi($option)
    {
        if ($option == 'TODAY') {
            $this->option = $option;

            return [now()->today(), now()];
        }

        if ($option == 'MTD') {
            $this->option = $option;

            return [now()->firstOfMonth(), now()];
        }

        if ($option == 'YTD') {
            $this->option = $option;
            return [now()->firstOfYear(), now()];
        }
        return [now()->subDays($option), now()];
    }
    public function markAllAsCheckout()
    {
        $a = ModelsLogtamu::whereIn('id', $this->selectedRows);
        $a->update(['checkout' => now()]);
        $this->dispatchBrowserEvent('alert', ['message' => 'Berhasil Melakukan CheckOut']);
        $this->reset(['selectPageRows', 'selectedRows']);
    }
    public function markAllAsCheckin()
    {
        ModelsLogtamu::whereIn('id', $this->selectedRows)->update(['checkout' => null]);
        $this->dispatchBrowserEvent('alert', ['message' => 'Berhasil Membataktan CheckOut']);
        $this->reset(['selectPageRows', 'selectedRows']);
    }

    public function render()
    {
        $data = $this->logtamu;
        return view('livewire.tamu.log-tamu', ['logtamu' => $data]);
    }
}
