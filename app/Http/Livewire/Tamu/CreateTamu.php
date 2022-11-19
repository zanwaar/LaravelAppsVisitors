<?php

namespace App\Http\Livewire\Tamu;

use Livewire\Component;
use App\Models\Bagian;
use App\Models\Logtamu;
use Illuminate\Support\Facades\Validator;
use App\Models\Tamu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
        Validator::make(
            $this->state,
            [
                'nama' => 'required',
                'instansi' => 'required',
                'jenisid' => 'required',
                'ni' => 'required|unique:tamus',
                'alamat' => 'required',
                'jk' => 'required',
                'foto' => 'required',
                'tenant' => 'required',
                'keperluan' => 'required',
            ],
            [
                'jenisid.required' => 'Jenis ID field is required',
                'ni.required' => 'Nomor Identitas field is required',
                'jk.required' => 'Jenis Kelamin field is required',
                'tenant.required' => 'Tujuan Tenant field is required',
            ]
        )->validate();

        DB::beginTransaction();
        try {
            $this->createphoto();
            $tamu = Tamu::create([
                'nama' => $this->state['nama'],
                'instansi' => $this->state['instansi'],
                'jenisid' => $this->state['jenisid'],
                'ni' => $this->state['ni'],
                'jk' => $this->state['jk'],
                'alamat' => $this->state['alamat'],
            ]);
            Logtamu::create(
                [
                    'tamu_id' => $tamu->id,
                    'keperluan' => $this->state['keperluan'],
                    'bagian_id' => $this->state['tenant'],
                    'checkin' => now(),
                    'checkout' => null,
                    'foto' => $this->photo,
                ]
            );
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        $this->dispatchBrowserEvent('alert', ['message' => 'Berhasil Ditambahkan Cek lOG Tamu Hari Ini']);
        $this->reset();
    }
    public function update()
    {
        $this->twebcam = $this->state['foto'];
        Validator::make(
            $this->state,
            [
                'nama' => 'required',
                'instansi' => 'required',
                'jenisid' => 'required',
                'ni' => 'required',
                'alamat' => 'required',
                'jk' => 'required',
                'tenant' => 'required',
                'keperluan' => 'required',
            ],
            [
                'jenisid.required' => 'Jenis ID field is required',
                'ni.required' => 'Nomor Identitas field is required',
                'jk.required' => 'Jenis Kelamin field is required',
                'tenant.required' => 'Tujuan Tenant field is required',
            ]
        )->validate();
        $xheck =  Logtamu::where('tamu_id', $this->mtamu->id)->where('checkout', null)->first();
        if ($xheck) {
            return $this->dispatchBrowserEvent('alert-danger', ['message' => 'Maaf Tamu Belum Check OUT!']);
        }
        DB::beginTransaction();
        try {
            $this->createphoto();
            Logtamu::create([
                'tamu_id' => $this->mtamu->id,
                'keperluan' => $this->state['keperluan'],
                'bagian_id' => $this->state['tenant'],
                'checkin' => now(),
                'checkout' => null,
                'foto' => $this->photo,
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        $this->dispatchBrowserEvent('alert', ['message' => 'Berhasil Ditambahkan Cek lOG Tamu Hari Ini']);
        $this->reset();
        // return redirect()->route('daftartamu');
    }
    public function edit(Tamu $tamu)
    {
        $this->reset();
        $this->show = true;
        $this->mtamu = $tamu;
        $this->state = $tamu->toArray();
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
    }
    public function render()
    {
        $bagian = Bagian::all();
        return view('livewire.tamu.create-tamu', ['bagian' => $bagian]);
    }
}
