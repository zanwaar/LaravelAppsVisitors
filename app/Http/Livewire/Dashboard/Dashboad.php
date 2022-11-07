<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Logtamu;
use Livewire\Component;

class Dashboad extends Component
{

    public $totaltamu;
    public $cekout;

    public function mount()
    {
        $this->totaltamu = Logtamu::whereBetween('checkin', [now()->today(), now()])->count();
        $this->cekout = Logtamu::whereBetween('checkout', [now()->today(), now()])->count();
    }
    public function render()
    {
        return view('livewire.dashboard.dashboad');
    }
}
