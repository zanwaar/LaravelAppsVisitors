<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Barang;
use App\Models\Logtamu as ModelsLogtamu;
use App\Models\Tamu;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Cart extends Component
{
    public $state = [];

    public $totalbarang;
    public $totallogtamu;
    public $totaltamu;

    public function mount()
    {
        $this->totalbarang = Barang::where('status', 0)->count();
        $this->totallogtamu = ModelsLogtamu::count();
        $this->totaltamu = Tamu::count();
    }
    public function render()
    {
        $users = ModelsLogtamu::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count', 'month_name');
           
        $January = 0;
        if (isset($users['January'])) {
            $January = $users['January'];
        }
        $February = 0;
        if (isset($users['February'])) {
            $February = $users['February'];
        }
        $March = 0;
        if (isset($users['March'])) {
            $March = $users['March'];
        }
        $April = 0;
        if (isset($users['April'])) {
            $April = $users['April'];
        }
        $May = 0;
        if (isset($users['May'])) {
            $May = $users['May'];
        }

        $June = 0;
        if (isset($users['June'])) {
            $June = $users['June'];
        }

        $July = 0;
        if (isset($users['July'])) {
            $July = $users['July'];
        }

        $August = 0;
        if (isset($users['August'])) {
            $August = $users['August'];
        }

        $September = 0;
        if (isset($users['September'])) {
            $September = $users['September'];
        }

        $October = 0;
        if (isset($users['October'])) {
            $October = $users['October'];
        }

        $November = 0;
        if (isset($users['November'])) {
            $November = $users['November'];
        }

        $December = 0;
        if (isset($users['December'])) {
            $December = $users['December'];
        }
        
        $value = [$January, $February, $March, $April, $May, $June, $July, $August, $September, $October, $November, $December];
        $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        // $labels = $users->keys();
        // $value = $users->values();
        return view('livewire.dashboard.cart', compact('labels', 'value'));
    }
}
