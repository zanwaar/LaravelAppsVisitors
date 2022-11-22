<?php

namespace App\Http\Livewire\Bagian;

use App\Exports\BagianExport;
use App\Models\Bagian;
use App\Http\Livewire\AppComponent;
use App\Imports\BagianImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class ListBagian extends AppComponent
{
    use WithFileUploads;
    public $state = [];
    public $showEditModal = false;
    public $idBeingRemoved = null;
    public $mbagian;
    public $fileimport;

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
            'tlpn' => 'required|numeric',
            'email' => 'required|email',
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

    public function swohimport()
    {
        $this->reset();
        $this->dispatchBrowserEvent('importModal');
    }
    public function import()
    {
        $this->validate([
            'fileimport' => 'required|mimes:Xls,xlsx',
        ]);
        DB::beginTransaction();
        try {
            $import = new BagianImport();
            $import->import($this->fileimport);
            $this->dispatchBrowserEvent('hide-importModal', ['message' => 'successfully!']);
            $this->reset();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            //throw $th;
            $this->dispatchBrowserEvent('alert-danger', ['message' => 'Gagal Simpan Format Tidak Sesuai ']);
        }
    }
    public function export()
    {
        return Excel::download(new BagianExport, 'bagians.xlsx');
    }

    public function getBagianProperty()
    {
        return Bagian::latest()
            ->where(function ($query) {
                $query->where('namaTenant', 'like', '%' . $this->searchTerm . '%');
                $query->orwhere('penanggungJawab', 'like', '%' . $this->searchTerm . '%');
                $query->orwhere('tlpn', 'like', '%' . $this->searchTerm . '%');
                $query->orwhere('email', 'like', '%' . $this->searchTerm . '%');
                $query->orwhere('lantaiTenant', 'like', '%' . $this->searchTerm . '%');
            })
            ->paginate($this->trow);
    }
    public function downloadfileimport()
    {
        return Storage::download('formatImport.xlsx');
    }
    public function render()
    {
        $data = $this->bagian;
        return view('livewire.bagian.list-bagian', [
            'bagian' => $data,
        ]);
    }
}
