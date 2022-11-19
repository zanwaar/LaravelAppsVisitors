<?php

namespace App\Http\Livewire\Magang;

use App\Http\Livewire\AppComponent;
use App\Models\Bagian;
use App\Models\Magang;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class ListMagang extends AppComponent
{
    use WithFileUploads;
    public $state = [];
    public $mMagang;
    public $showEditModal = false;
    public $idBeingRemoved = null;
    public $photo;
    public $trow = 5;
    public function row($value)
    {
        $this->resetPage();
        $this->trow = $value;
    }
    public function addNew()
    {
        $this->reset();

        $this->showEditModal = false;

        $this->dispatchBrowserEvent('show-form');
    }

    public function create()
    {
        $validatedData = Validator::make(
            $this->state,
            [
                'nama' => 'required',
                'bagian_id' => 'required',
                'sekolah' => 'required',
                'tglmulai' => 'required',
                'tglselesai' => 'required',
                'status' => 'required',
                'pembimbing' => 'required',
            ],
            [
                'bagian_id.required' => 'Lokasi Mangang field is required',
                'tglmuali.required' => 'Tanggal Mulai field is required',
                'tglselesai.required' => 'Tanggal Selesai field is required',
            ]
        )->validate();

        if ($this->photo) {
            $validatedData['foto'] = $this->photo->store('/', 'avatars');
        }
        Magang::create($validatedData);
        $this->dispatchBrowserEvent('hide-form', ['message' => 'created successfully!']);
    }

    public function edit(Magang $magang)
    {
        $this->reset();
        $this->showEditModal = true;
        $this->mMagang = $magang;
        $this->state = $magang->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function update()
    {
        $validatedData = Validator::make(
            $this->state,
            [
                'nama' => 'required',
                'bagian_id' => 'required',
                'sekolah' => 'required',
                'tglmulai' => 'required',
                'tglselesai' => 'required',
                'status' => 'required',
                'pembimbing' => 'required',
            ],
            [
                'bagian_id.required' => 'Lokasi Mangang field is required',
                'tglmuali.required' => 'Tanggal Mulai field is required',
                'tglselesai.required' => 'Tanggal Selesai field is required',
            ]
        )->validate();

        $this->mMagang->update($validatedData);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'updated successfully!']);
    }

    public function confirmRemoval($id)
    {
        $this->idBeingRemoved = $id['id'];
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function delete()
    {
        $magang = Magang::findOrFail($this->idBeingRemoved);

        $magang->delete();

        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'deleted successfully!']);
    }
    public function getMagangProperty()
    {
        return Magang::latest()->with(['bagian'])
            ->where(function ($query) {
                $query->whereRelation('bagian', 'namaTenant', 'like', '%' . $this->searchTerm . '%');;
                $query->orwhere('nama', 'like', '%' . $this->searchTerm . '%');
                $query->orwhere('sekolah', 'like', '%' . $this->searchTerm . '%');
                $query->orwhere('status', 'like', '%' . $this->searchTerm . '%');
                $query->orwhere('pembimbing', 'like', '%' . $this->searchTerm . '%');
                $query->orwhere('tglmulai', 'like', '%' . $this->searchTerm . '%');
                $query->orwhere('tglselesai', 'like', '%' . $this->searchTerm . '%');
            })
            ->paginate($this->trow);
    }
    public function render()
    {
        $data = $this->magang;
        $bagian = Bagian::all();
        return view('livewire.magang.list-magang', ['magang' => $data, 'bagian' => $bagian]);
    }
}
