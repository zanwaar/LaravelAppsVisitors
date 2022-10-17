<?php

namespace App\Http\Livewire\Tamu;

use Livewire\Component;
use App\Events\TamuCheckIn;
use App\Http\Livewire\Tamu\LogTamu as TamuLogTamu;
use App\Models\Bagian;
use App\Models\Logtamu;
use Illuminate\Support\Facades\Validator;
use App\Models\Tamu;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

class CreateTamu extends Component
{
    public $state = [];
    public $show = false;
    public $mtamu;
    public function create()
    {

        Validator::make($this->state, [
            'nama' => 'required',
            'instansi' => 'required',
            'jenisid' => 'required',
            'ni' => 'required',
            'alamat' => 'required',
            'foto' => 'required',
            'jk' => 'required',
            'tenant' => 'required',
            'keperluan' => 'required',
        ])->validate();
        DB::beginTransaction();
        try {
            $tamu = Tamu::create([
                'nama' => $this->state['nama'],
                'instansi' => $this->state['instansi'],
                'jenisid' => $this->state['jenisid'],
                'ni' => $this->state['ni'],
                'jk' => $this->state['jk'],
                'alamat' => $this->state['alamat'],
                'foto' => $this->state['foto'],
            ]);
            Logtamu::create(
                [
                    'tamu_id' => $tamu->id,
                    'keperluan' => $this->state['keperluan'],
                    'bagian_id' => $this->state['tenant'],
                    'checkin' => now(),
                    'checkout' => null,
                ]
            );
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        $this->dispatchBrowserEvent('alert', ['message' => 'created successfully!']);
        $this->state = [];
        // return redirect()->route('daftartamu');
    }
    public function update()
    {

        Validator::make($this->state, [
            'nama' => 'required',
            'instansi' => 'required',
            'jenisid' => 'required',
            'ni' => 'required',
            'alamat' => 'required',
            'foto' => 'required',
            'jk' => 'required',
            'tenant' => 'required',
            'keperluan' => 'required',
        ])->validate();
        $xheck =  Logtamu::where('tamu_id', $this->mtamu->id)->where('checkout', null)->first();
        if ($xheck) {
            return $this->dispatchBrowserEvent('alert', ['message' => 'Maaf Tamu Belum Check OUT!']);
        }
        DB::beginTransaction();
        try {
            Logtamu::create([
                'tamu_id' => $this->mtamu->id,
                'keperluan' => $this->state['keperluan'],
                'bagian_id' => $this->state['tenant'],
                'checkin' => now(),
                'checkout' => null,
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        $this->dispatchBrowserEvent('alert', ['message' => 'created successfully!']);
        $this->state = [];
        $this->show = false;
        // return redirect()->route('daftartamu');
    }
    public function edit(Tamu $tamu)
    {
        // dd($tamu);
        $this->reset();
        $this->show = true;
        $this->mtamu = $tamu;
        $this->state = $tamu->toArray();
        // $this->dispatchBrowserEvent('show-form');
    }
    public function render()
    {
        $bagian = Bagian::all();
        return view('livewire.tamu.create-tamu', ['bagian' => $bagian]);
    }
}
