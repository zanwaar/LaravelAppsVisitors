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
    public $mitra;
    public $nama;
    public $nowp;
    public $tlpn;
    public $titikkor;
    public $judulpekerjaan;
    public $lokasi;
    public $tglawal;
    public $tglakhir;
    public $fileimport;

    protected $rules = [
        'mitra' => 'required',
        'nama' => 'required',
        'nowp' => 'required',
        'tlpn' => 'required',
        'titikkor' => 'required',
        'judulpekerjaan' => 'required',
        'lokasi' => 'required',
        'tglawal' => 'required',
        'tglakhir' => 'required',
        'fileimport' => 'required',
    ];
    public function create()
    {

        $this->validate();
        DB::beginTransaction();
        try {
            $mitra = Workingpermit::create([
                'mitra' => $this->mitra,
                'nama' => $this->nama,
                'nowp' => $this->nowp,
                'tlpn' => $this->tlpn,
                'titikkor' => $this->titikkor,
                'judulpekerjaan' => $this->judulpekerjaan,
                'lokasi' => $this->lokasi,
                'tglawal' => $this->tglawal,
                'tglakhir' => $this->tglakhir,
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
