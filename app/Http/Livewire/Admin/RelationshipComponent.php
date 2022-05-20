<?php

namespace App\Http\Livewire\Admin;

use App\Models\Relationship;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Livewire\WithPagination;

class RelationshipComponent extends BaseComponent
{
    public $tabInner;

    public $marital_status;

    public $headers = [
        'id' => 'ID',
        'marital_status' => 'Estado civil',

        'created_at' => 'Creado',
        'not' => '',
    ];

    protected $attributes = [
        'marital_status' => '<b><ins>estado civil</ins></b>',
    ];

    protected $rules = [
        'marital_status' => 'required|min:3',
    ];

    public function mount()
    {
        $this->limit = 8;
        $this->keyWord = '';

        $this->iconSort = 'fa-sort-alpha-down';
        $this->fieldSort = 'id';
        $this->sort = 'asc';

        $this->frame = 'index';
    }

    public function render()
    {
        $rFormat = array_diff(array_keys($this->headers), ['not']);
        $findIn = [];
        $table = 'relationships';

        foreach ($rFormat as $item) {
            $findIn[] = $table . '.' . $item;
        }

        $data['results'] = Relationship::orderBy($this->fieldSort, $this->sort)
            ->where(function ($query) use ($findIn) {
                foreach ($findIn as $in) {
                    $query->orWhere($in, 'LIKE', '%' . $this->keyWord . '%');
                }
            })
            ->paginate($this->limit);

        $data['_title'] = 'Estado civil';

        $this->emit('refreshContent');

        return view('livewire.admin.relationship-component', $data)->layout('layouts.base');
    }

    public function updated($property)
    {
        $this->validateOnly($property, $this->rules, [], $this->attributes);
    }

    public function edit($id = 0)
    {
        $this->itemId = $id;
        $relationship = Relationship::where('id', $this->itemId)->first();

        $this->marital_status = $relationship->marital_status;

        $this->frame = 'edit';
    }

    public function updateData()
    {
        if ($this->itemId) {

            $this->validate($this->rules, [], $this->attributes);

            $relationship = Relationship::find($this->itemId);

            $relationship->marital_status = $this->marital_status;


            if ($relationship->save()) {
                $this->emit('notification', ['Se actualizó el estado civil exitosamente']);
                $this->closeFrame();
            }
        }
    }

    public function openFrame()
    {
        $this->frame = 'add';
    }

    public function saveData()
    {

        $this->validate($this->rules, [], $this->attributes);

        $relationship = new Relationship();

        $relationship->marital_status = $this->marital_status;


        if ($relationship->save()) {
            $this->emit('notification', ['Estado civil creado exitosamente']);
            $this->closeFrame();
        }

    }

    public function closeFrame()
    {
        $this->frame = 'index';
        $this->cleanItems();
    }

    public function cleanItems()
    {
        $this->marital_status = null;

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function delete()
    {
        $data = Relationship::find($this->deleteId);

        if ($data->delete()) {
            $this->closeFrame();
        }
    }

}
