<?php

namespace App\Http\Livewire\Workingpermit;

use App\Models\Workingpermit;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class EditWorkingPermit extends Component
{
    public $state = [];
    public $workingpermit;
    public function mount(Workingpermit $workingpermit)
    {
        $this->state = $workingpermit->toArray();
    }
    public function updatemitra()
    {

        Validator::make($this->state, [
            'mitra' => 'required',
            'nama' => 'required',
            'nowp' => 'required',
            'tlpn' => 'required',
            'judulpekerjaan' => 'required',
            'titikkor' => 'required',
            'lokasi' => 'required',
            'tglawal' => 'required',
            'tglakhir' => 'required',
        ])->validate();
        $mitra = Workingpermit::findOrFail($this->state['id']);
        $mitra->update(
            [
                'mitra' => $this->state['mitra'],
                'judulpekerjaan' => $this->state['judulpekerjaan'],
                'nama' => $this->state['nama'],
                'nowp' => $this->state['nowp'],
                'tlpn' => $this->state['tlpn'],
                'titikkor' => $this->state['titikkor'],
                'lokasi' => $this->state['lokasi'],
                'tglawal' => $this->state['tglawal'],
                'tglakhir' => $this->state['tglakhir'],
            ]
        );

        $this->dispatchBrowserEvent('hide-form', ['message' => 'updated successfully!']);
        return redirect()->route('detailworking.detail', $mitra->id);
    }
    public function render()
    {
        return view('livewire.workingpermit.edit-working-permit');
    }
}
