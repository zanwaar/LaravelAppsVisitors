<?php

namespace App\Http\Livewire\Barang;

use App\Http\Livewire\AppComponent;
use App\Models\Bagian;
use App\Models\Barang;
use Illuminate\Support\Facades\Validator;

class ListBarang extends AppComponent
{
    public $state = [];
    public $lokasi;
    public $status = true;
    public $mbarang;
    public $showEditModal = false;
    public $idBeingRemoved = null;
    public $show = false;
    public $showdetail = false;

    public function addNew()
    {
        $this->reset();
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function create()
    {
        Validator::make(
            $this->state,
            [
                'nama' => 'required',
                'jenis' => 'required',
                'pengirim' => 'required',
                'penerima' => 'required',
                'bagian_id' => 'required',
                'keterangan' => 'required',
            ],
            [
                'bagian_id.required' => 'Ruangan Yang dItuju field is required',
            ]
        )->validate();
        Barang::create([
            'jenis' => $this->state['jenis'],
            'nama' => $this->state['nama'],
            'pengirim' => $this->state['pengirim'],
            'penerima' => $this->state['penerima'],
            'bagian_id' => $this->state['bagian_id'],
            'keterangan' => $this->state['keterangan'],
            'tglditerima' => now(),
            'tgldiambil' => null,
            'diambil' => '',
            'status' => false,
        ]);
        $this->dispatchBrowserEvent('hide-form', ['message' => 'added successfully!']);
    }
    public function edit(Barang $barang)
    {

        $this->reset();
        $this->showEditModal = true;

        $this->mbarang = $barang;


        $this->state = $barang->toArray();

        $this->dispatchBrowserEvent('show-form');
    }
    public function Diambil(Barang $barang)
    {

        $this->show = true;
        $this->showdetail = false;

        $this->mbarang = $barang;
        $this->lokasi = $barang->bagian->namaTenant;

        $this->state = $barang->toArray();

        $this->dispatchBrowserEvent('show-diambil');
    }
    public function detail(Barang $barang)
    {

        $this->show = true;
        $this->showdetail = true;

        $this->mbarang = $barang;
        $this->lokasi = $barang->bagian->namaTenant;

        $this->state = $barang->toArray();

        $this->dispatchBrowserEvent('show-diambil');
    }
    public function confirmDiambil()
    {
        Validator::make(
            $this->state,
            [
                'diambil' => 'required',
            ],
            [
                'diambil.required' => 'Nama Orang Yang Mengambil field is required',
            ]
        )->validate();

        $this->mbarang->update(
            [
                'tgldiambil' => now(),
                'diambil' => $this->state['diambil'],
                'status' => true,
            ]
        );

        $this->dispatchBrowserEvent('hide-diambil', ['message' => 'updated successfully!']);
    }
    public function update()
    {
        $validatedData = Validator::make(
            $this->state,
            [
                'nama' => 'required',
                'jenis' => 'required',
                'pengirim' => 'required',
                'penerima' => 'required',
                'bagian_id' => 'required',
                'keterangan' => 'required',
            ],
            [
                'bagian_id.required' => 'Ruangan Yang dItuju field is required',
            ]
        )->validate();

        $this->mbarang->update($validatedData);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'updated successfully!']);
    }
    public function confirmRemoval($id)
    {
        $this->idBeingRemoved = $id['id'];

        $this->dispatchBrowserEvent('show-delete-modal');
    }
    public function delete()
    {
        $barang = Barang::findOrFail($this->idBeingRemoved);

        $barang->delete();

        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'deleted successfully!']);
        $this->reset();
    }
    public function filterBarangsByStatus($status = 'active')
    {
        $this->resetPage();

        $this->searchTerm = $status;
    }
    public function getBarangProperty()
    {
        return Barang::latest()->with(['bagian'])
            ->where(function ($query) {
                $query->whereRelation('bagian', 'namaTenant', 'like', '%' . $this->searchTerm . '%');
                $query->orwhere('nama', 'like', '%' . $this->searchTerm . '%');
                $query->orwhere('jenis', 'like', '%' . $this->searchTerm . '%');
                $query->orwhere('pengirim', 'like', '%' . $this->searchTerm . '%');
                $query->orwhere('penerima', 'like', '%' . $this->searchTerm . '%');
                $query->orwhere('diambil', 'like', '%' . $this->searchTerm . '%');
                $query->orwhere('status', 'like', '%' . $this->searchTerm . '%');
            })

            ->paginate($this->trow);
    }
    public function render()
    {
        $data = $this->barang;
        $bagian = Bagian::all();
        return view('livewire.barang.list-barang', ['barang' => $data, 'bagian' => $bagian]);
    }
}
