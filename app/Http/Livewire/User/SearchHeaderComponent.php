<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class SearchHeaderComponent extends Component
{
    public $keySearch;

    public function mount()
    {
        $this->keySearch = '';
    }

    public function render()
    {
        return view('livewire.user.search-header-component');
    }

    public function updatedKeySearch()
    {
        $this->emitTo('user.home-component', 'updateKeySearch', ['keyWord' => $this->keySearch]);
    }

    public function updateKeySearch()
    {
       $this->emitTo('user.home-component', 'updateKeySearch', ['keyWord' => $this->keySearch]);
    }
}
