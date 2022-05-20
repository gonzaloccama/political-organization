<?php

namespace App\Http\Livewire\Admin;

use App\Models\Gender;
use Livewire\Component;
use Livewire\WithPagination;

class GenderComponent extends BaseComponent
{
    public $tabInner;

    public $gender;

    public $headers = [
        'id' => 'ID',
        'gender' => 'Sexo',

        'created_at' => 'Creado',
        'not' => '',
    ];

    protected $attributes = [
        'gender' => '<b><ins>genero</ins></b>',
    ];

    protected $rules = [
        'gender' => 'required|min:3',
    ];

    public function mount()
    {
        $this->limit = 10;
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
        $table = 'genders';

        foreach ($rFormat as $item) {
            $findIn[] = $table . '.' . $item;
        }

        $data['results'] = Gender::orderBy($this->fieldSort, $this->sort)
            ->where(function ($query) use ($findIn) {
                foreach ($findIn as $in) {
                    $query->orWhere($in, 'LIKE', '%' . $this->keyWord . '%');
                }
            })
            ->paginate($this->limit);

        $data['_title'] = 'Genero';

        $this->emit('refreshContent');

        return view('livewire.admin.gender-component', $data)->layout('layouts.base');
    }

    public function updated($property)
    {
        $this->validateOnly($property, $this->rules, [], $this->attributes);
    }

    public function edit($id = 0)
    {
        $this->itemId = $id;
        $gender = Gender::where('id', $this->itemId)->first();

        $this->gender = $gender->gender;

        $this->frame = 'edit';
    }

    public function updateData()
    {
        if ($this->itemId) {

            $this->validate($this->rules, [], $this->attributes);

            $gender = Gender::find($this->itemId);

            $gender->gender = $this->gender;


            if ($gender->save()) {
                $this->emit('notification', ['Se actualizó el genero exitosamente']);
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

        $gender = new Gender();

        $gender->gender = $this->gender;

        if ($gender->save()) {
            $this->emit('notification', ['Nuevo genero creado exitosamente']);
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
        $this->gender = null;

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function delete()
    {
        $data = Gender::find($this->deleteId);
        if ($data->delete()) {
            $this->closeFrame();
        }
    }

}
