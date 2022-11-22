<?php

namespace App\Http\Livewire\Workingpermit;

use App\Imports\PersonilImport;
use App\Models\Workingpermit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class CreateWorkingPermit extends Component
{
    use WithFileUploads;
    public $state = [];
    public $fileimport;

    public function create()
    {

        Validator::make($this->state, [
            'mitra' => 'required',
            'nama' => 'required',
            'nowp' => 'required',
            'tlpn' => 'required',
            'titikkor' => 'required',
            'judulpekerjaan' => 'required',
            'lokasi' => 'required',
            'tglawal' => 'required',
            'tglakhir' => 'required',
        ])->validate();

        DB::beginTransaction();
        try {
            $mitra = Workingpermit::create([
                'mitra' => $this->state['mitra'],
                'nama' => $this->state['nama'],
                'nowp' => $this->state['nowp'],
                'tlpn' => $this->state['tlpn'],
                'titikkor' => $this->state['titikkor'],
                'judulpekerjaan' => $this->state['judulpekerjaan'],
                'lokasi' => $this->state['lokasi'],
                'tglawal' => $this->state['tglawal'],
                'tglakhir' => $this->state['tglakhir'],
            ]);
            Excel::import(new PersonilImport($mitra->id), $this->fileimport);
            DB::commit();
            $this->dispatchBrowserEvent('hide-form', ['message' => 'added successfully!']);
            return redirect()->route('detailworking.detail', $mitra->id);
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            $this->dispatchBrowserEvent('alert-danger', ['message' => 'Gagal Simpan ' . $th->getMessage()]);
        }
    }
    public function downloadfileimport()
    {
        return Storage::download('formatImportPersonil.xlsx');
    }
    public function render()
    {
        return view('livewire.workingpermit.create-working-permit');
    }
}
