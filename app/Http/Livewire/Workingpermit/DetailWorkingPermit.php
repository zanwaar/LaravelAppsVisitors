<?php

namespace App\Http\Livewire\Workingpermit;

use App\Models\Personil;
use App\Models\Workingpermit;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class DetailWorkingPermit extends Component
{
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;
    protected $paginationTheme = 'simple-bootstrap';
    public $state = [];
    public $workingpermit;
    public $mpersonil;
    public $nama;
    public $updateMode = false;
    public $inputs = [];
    public $i = 1;
    public $showEditModal = false;
    public $showHapusModal = false;

    public function add($i)
    {
        $this->authorize('admin');
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs, $i);
    }
    public function remove($i)
    {
        $this->authorize('admin');
        unset($this->inputs[$i]);
    }
    private function resetInputFields()
    {
        $this->authorize('admin');
        $this->nama = '';
        $this->inputs = [];
    }
    public function store()
    {
        $this->authorize('admin');
        $this->validate(
            [
                'nama.0' => 'required',
                'nama.*' => 'required',
            ],
            [
                'nama.0.required' => 'nama field is required',
                'nama.*.required' => 'nama field is required',
            ]
        );

        foreach ($this->nama as $key => $value) {
            Personil::create(['nama' => $this->nama[$key], 'workingpermit_id' => $this->state['id']]);
        }
        $this->resetPage();
        $this->resetInputFields();
        $this->dispatchBrowserEvent('alert', ['message' => 'admind successfully!']);
    }

    public function mount(Workingpermit $workingpermit)
    {
        $this->state = $workingpermit->toArray();

        $this->workingpermit = $workingpermit;
    }
    public function confirmRemoval($id)
    {
        $this->showHapusModal = false;
        $this->idBeingRemoved = $id['id'];

        $this->dispatchBrowserEvent('show-delete-modal');
    }
    public function hapusmitra()
    {
        $this->authorize('admin');
        $this->showHapusModal = true;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function edit(Personil $data)
    {
        $this->authorize('admin');
        $this->resetInputFields();
        $this->idBeingRemoved = $data['id'];
        $this->showEditModal = true;
        $this->nama = [$data['nama']];
        $this->mpersonil = $data;
    }
    public function editmitra()
    {
        $this->dispatchBrowserEvent('show-form');
    }
    public function updatemitra()
    {
        $this->authorize('admin');
        Validator::make($this->state, [
            'mitra' => 'required',
            'nama' => 'required',
            'nowp' => 'required',
            'tlpn' => 'required',
            'judulpekerjaan' => 'required',
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
                'lokasi' => $this->state['lokasi'],
                'tglawal' => $this->state['tglawal'],
                'tglakhir' => $this->state['tglakhir'],
            ]
        );

        $this->dispatchBrowserEvent('hide-form', ['message' => 'updated successfully!']);
    }
    public function editproses()
    {
        $this->authorize('admin');
        $this->validate(
            [
                'nama.0' => 'required',
            ],
            [
                'nama.0.required' => 'nama field is required',
            ]
        );

        $this->mpersonil->update(
            [
                'nama' => $this->nama[0],
            ]
        );
        $this->resetInputFields();
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('alert', ['message' => 'admind successfully!']);
    }

    public function delete()
    {
        $this->authorize('admin');
        $personil = Personil::findOrFail($this->idBeingRemoved);

        $personil->delete();
        $this->resetPage();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'deleted successfully!']);
    }
    public function deletemitra()
    {
        $this->authorize('admin');
        $mitra = Workingpermit::findOrFail($this->state['id']);

        $mitra->delete();

        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'deleted successfully!']);
        return redirect()->route('listworking');
    }
    public function getPersonilProperty()
    {
        return Personil::latest()->where('workingpermit_id', $this->state['id'])->paginate(5);
    }
    public function render()
    {
        $personil = $this->personil;
        return view('livewire.workingpermit.detail-working-permit', ['personil' => $personil]);
    }
}
