<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class AppComponent extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $searchTerm = null;
    public $trow = 5;

    protected $queryString = ['searchTerm' => ['except' => '']];

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }
   
    function row($value)
    {
        $this->searchTerm = null;
        $this->resetPage();
        $this->trow = $value;
    }
}
