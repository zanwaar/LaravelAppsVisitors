<?php

namespace App\Http\Livewire\Tamu;


use App\Http\Livewire\AppComponent;
use App\Models\Logtamu as ModelsLogtamu;
use Illuminate\Database\Eloquent\Builder;

class LogTamu extends AppComponent
{
    public $selectedRows = [];
    public $selectPageRows = false;
    public $option = 'TODAY';
    public $searchTerm = null;
    public $trow = 5;

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
            ->where(function ($query) {
                $query->whereRelation('tamu', 'nama', 'like', '%' . $this->searchTerm . '%');
                $query->orwhereRelation('tamu', 'instansi', 'like', '%' . $this->searchTerm . '%');
                $query->orwhereRelation('bagian', 'namaTenant', 'like', '%' . $this->searchTerm . '%');
                $query->orwhere('keperluan', 'like', '%' . $this->searchTerm . '%');
            })
            ->whereBetween('checkin', $this->maropsi($this->option))
            ->paginate($this->trow);
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
        if ($option == 'ALL') {
            $this->option = $option;
            return ['01-01-1000', now()];
        }

        return [now()->subDays($option), now()];
    }
    public function row($value)
    {
        $this->resetPage();
        $this->trow = $value;
    }
    public function markAllAsCheckout()
    {
        $a = ModelsLogtamu::whereIn('id', $this->selectedRows)->where(['checkout' => null]);
        $a->update(['checkout' => now()]);
        $this->dispatchBrowserEvent('alert', ['message' => 'Berhasil Melakukan CheckOut']);
        $this->reset(['selectPageRows', 'selectedRows']);


        # code...
    }
    public function markAllAsCheckin()
    {
        ModelsLogtamu::whereIn('id', $this->selectedRows)->update(['checkout' => null]);
        $this->dispatchBrowserEvent('alert', ['message' => 'Berhasil Membataktan CheckOut']);
        $this->reset(['selectPageRows', 'selectedRows']);
    }

    public function btndetail($id)
    {
        dd($id);
    }

    public function render()
    {
        $data = $this->logtamu;
        return view('livewire.tamu.log-tamu', ['logtamu' => $data]);
    }
}
