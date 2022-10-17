<?php

namespace App\Http\Livewire\Bagian;

use App\Events\TamuCheckIn;
use App\Models\Bagian;
use App\Http\Livewire\Admin\AdminComponent as Component;
use Illuminate\Support\Facades\Validator;

class ListBagian extends Component
{
    public $state = [];
    public $showEditModal = false;
    public $idBeingRemoved = null;
    public $mbagian;

    public function addNew()
    {
        $this->reset();

        $this->showEditModal = false;

        $this->dispatchBrowserEvent('show-form');
    }
    public function create()
    {
        $validatedData = Validator::make($this->state, [
            'namaTenant' => 'required',
            'penanggungJawab' => 'required',
            'tlpn' => 'required',
            'email' => 'required',
            'lantaiTenant' => 'required',
        ])->validate();
        Bagian::create($validatedData);
        $this->dispatchBrowserEvent('hide-form', ['message' => 'added successfully!']);
    }
    public function edit(Bagian $bagian)
    {

        $this->reset();
        $this->showEditModal = true;
        $this->mbagian = $bagian;
        $this->state = $bagian->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function update()
    {

        $validatedData = Validator::make($this->state, [
            'namaTenant' => 'required',
            'penanggungJawab' => 'required',
            'tlpn' => 'required',
            'email' => 'required|email|unique:bagians,email,' . $this->mbagian->id,
            'lantaiTenant' => 'required',
        ])->validate();

        $this->mbagian->update($validatedData);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'updated successfully!']);
    }
    public function confirmRemoval($id)
    {
        $this->idBeingRemoved = $id['id'];

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function delete()
    {
        $bagian = Bagian::findOrFail($this->idBeingRemoved);

        $bagian->delete();

        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'deleted successfully!']);
    }
    public function render()
    {
        $bagian = Bagian::latest()
            ->paginate(2);
        return view('livewire.bagian.list-bagian', [
            'bagian' => $bagian,
        ]);
    }
}
