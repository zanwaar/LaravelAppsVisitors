<?php

namespace App\Http\Livewire\Magang;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Bagian;
use App\Models\Magang;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ListMagang extends AdminComponent
{
    public $state = [];
    public $showEditModal = false;
    public $idBeingRemoved = null;
    public $selectedRows = [];

    public $selectPageRows = false;

    public $searchTerm = null;

    public function addNew()
    {
        $this->reset();

        $this->showEditModal = false;

        $this->dispatchBrowserEvent('show-form');
    }
    public function create()
    {
        $validatedData = Validator::make($this->state, [
            'nama' => 'required',
            'bagian_id' => 'required',
            'sekolah' => 'required',
            'tglmulai' => 'required',
            'tglselesai' => 'required',
            'status' => 'required',
            'pembimbing' => 'required',
        ])->validate();
        Magang::create($validatedData);
        $this->dispatchBrowserEvent('hide-form', ['message' => 'added successfully!']);
    }
    public function updatedSelectPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->magang->pluck('id')->map(function ($id) {
                return (string) $id;
            });
        } else {
            $this->reset(['selectedRows', 'selectPageRows']);
        }
    }

    public function getMagangProperty()
    {
        return Magang::latest()->with(['bagian'])->paginate(10);
    }
    public function render()
    {
        $data = $this->magang;
        $bagian = Bagian::all();
        return view('livewire.magang.list-magang', ['magang' => $data, 'bagian' => $bagian]);
    }
}
