<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;

class BaseComponent extends Component
{
    use WithPagination;

    protected $listeners = [
        'activeConfirm' => 'delete',
        'refresh' => '$refresh',
        'customConfirm' => 'deleteCustom',
    ];

    public $limit;
    public $keyWord;
    public $iconSort;
    public $fieldSort;
    public $sort;
    public $orderBy;
    public $filter = null;

    public $frame = null;
    public $deleteId;
    public $itemId;


    public function updatePagination($size = 0)
    {
        $this->limit = $size;
    }

    public function updateFilter($size = 0)
    {
        $this->filter = $size;
    }

    public function changeSort($field)
    {
        if ($this->fieldSort == $field) {
            if ($this->sort == 'desc') {
                $this->iconSort = 'fa-sort-alpha-down';
                $this->sort = 'asc';
            } else {
                $this->iconSort = 'fa-sort-alpha-up-alt';
                $this->sort = 'desc';
            }
        } else {
            $this->iconSort = 'fa-sort-alpha-down';
            $this->sort = 'asc';
        }
        $this->fieldSort = $field;
    }

    public function updatingKeyWord()
    {
        $this->resetPage();
    }

    public function deleteConfirm($id)
    {
        $this->deleteId = $id;
        $this->emit('deleteAlert');
    }
}
