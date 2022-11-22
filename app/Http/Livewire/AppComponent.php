<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class AppComponent extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $searchTerm = null;

    protected $queryString = ['searchTerm' => ['except' => '']];

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }
    public $trow = 5;

    function row($value)
    {
        $this->searchTerm = null;
        $this->resetPage();
        $this->trow = $value;
    }
}
