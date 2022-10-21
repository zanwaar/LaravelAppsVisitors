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
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Return_;

class CreateTamu extends Component
{
    public $state = [];
    public $show = false;
    public $mtamu;
    public $photo;
    public $twebcam;
    public $nsearch = null;

    public function cancel()
    {
        $this->reset();
    }
    public function fwebcam()
    {
        $this->dispatchBrowserEvent('webcam');
    }
    public function createphoto()
    {
        $img = $this->state['foto'];
        $folderPath = "public/upload/";
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';
        $file = $folderPath . $fileName;
        Storage::put($file, $image_base64);
        $this->photo = $fileName;
    }

    public function create()
    {
        $this->twebcam = $this->state['foto'];
        Validator::make($this->state, [
            'nama' => 'required',
            'instansi' => 'required',
            'jenisid' => 'required',
            'ni' => 'required|unique:tamus',
            'alamat' => 'required',
            'jk' => 'required',
            'foto' => 'required',
            'tenant' => 'required',
            'keperluan' => 'required',
        ])->validate();

        DB::beginTransaction();
        try {
            $this->createphoto();
            $tamu = Tamu::create([
                'nama' => $this->state['nama'],
                'instansi' => $this->state['instansi'],
                'jenisid' => $this->state['jenisid'],
                'ni' => $this->state['ni'],
                'jk' => $this->state['jk'],
                'foto' => $this->photo,
                'alamat' => $this->state['alamat'],
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
        $this->reset();



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
            'jk' => 'required',
            'tenant' => 'required',
            'keperluan' => 'required',
        ])->validate();
        $xheck =  Logtamu::where('tamu_id', $this->mtamu->id)->where('checkout', null)->first();
        if ($xheck) {
            return $this->dispatchBrowserEvent('alert-danger', ['message' => 'Maaf Tamu Belum Check OUT!']);
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
        $this->reset();
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
    public function fsearch()
    {
        $s = Tamu::Where('ni', $this->nsearch)->first();
        if (!$s) {
            $this->reset();
            return $this->dispatchBrowserEvent('alert-danger', ['message' => 'Maaf data tidak di temukan']);
        }
        $this->reset();
        $this->show = true;
        $this->mtamu = $s;
        $this->state = $s->toArray();
        // $this->dispatchBrowserEvent('show-form');
    }
    public function render()
    {
        $bagian = Bagian::all();
        return view('livewire.tamu.create-tamu', ['bagian' => $bagian]);
    }
}
