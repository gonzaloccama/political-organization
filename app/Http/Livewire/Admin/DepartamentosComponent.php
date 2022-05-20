<?php

namespace App\Http\Livewire\Admin;

use App\Models\Departamento;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Livewire\WithPagination;

class DepartamentosComponent extends BaseComponent
{
    public $tabInner;

    public $region;
    public $province;

    public $inputs;
    public $iterator;

    public $headers = [
        'id' => 'ID',
        'region' => 'Región',
        'ubigeo' => 'Ubigeo',
//        'province' => 'Provincias',

        'created_at' => 'Creado',
        'not' => '',
    ];

    protected $attributes = [
        'region' => '<b><ins>Región</ins></b>',
        'province.0' => '<b><ins>Provincia</ins></b>',
        'province.*' => '<b><ins>Provincia</ins></b>',
    ];

    protected $rules = [
        'region' => 'required|min:3',
        'province.0' => 'required|min:3|max:360',
        'province.*' => 'nullable|min:3|max:360',
    ];

    public function mount()
    {
        $this->limit = 8;
        $this->keyWord = '';

        $this->iconSort = 'fa-sort-alpha-down';
        $this->fieldSort = 'id';
        $this->sort = 'asc';

        $this->frame = 'index';

        $this->inputs = [];
        $this->iterator = 0;
        $this->i = 1;
    }

    public function render()
    {
        $rFormat = array_diff(array_keys($this->headers), ['not']);
        $findIn = [];
        $table = 'region';

        foreach ($rFormat as $item) {
            $findIn[] = $table . '.' . $item;
        }

        $data['results'] = Departamento::orderBy($this->fieldSort, $this->sort)
//            ->where('id', '!=', 1)
            ->where(function ($query) use ($findIn) {
                foreach ($findIn as $in) {
                    $query->orWhere($in, 'LIKE', '%' . $this->keyWord . '%');
                }
            })
            ->paginate($this->limit);

        $data['_title'] = 'Regiones';

        $this->emit('refreshContent');

        return view('livewire.admin.departamentos-component', $data)->layout('layouts.base');
    }

    public function updated($property)
    {
        $this->validateOnly($property, $this->rules, [], $this->attributes);
    }

    public function openFrame()
    {
        $this->frame = 'add';
    }

    public function saveData()
    {
        $this->validate($this->rules, [], $this->attributes);

        if ($this->province)
            foreach ($this->province as $key => $pr)
                $prov[] = $pr;

        $data = new Departamento();
        $data->region = $this->region;
        $data->province = json_encode($prov);

        if ($data->save()) {
            $this->emit('notification', ['Nueva región se creó exitosamente']);
            $this->closeFrame();
        }

    }

    public function edit($id = 0)
    {
        $this->cleanItems();

        $this->itemId = $id;
        $data = Departamento::where('id', $this->itemId)->first();

        $this->region = $data->region;
        $this->province = json_decode($data->province);

        foreach ($this->province as $key => $province)
            if ($key)
                $this->inputs[] = $key;

        $this->iterator = count($this->inputs);

        $this->frame = 'edit';
    }

    public function updateData()
    {
        if ($this->itemId) {

            $this->validate($this->rules, [], $this->attributes);

            $prov = [];
            if ($this->province)
                foreach ($this->province as $province)
                    $prov[] = $province;

            $data = Departamento::find($this->itemId);

            $data->region = $this->region;
            $data->province = json_encode($prov);

            if ($data->save()) {
                $this->emit('notification', ['Región actualizada exitosamente']);
                $this->closeFrame();
            }
        }
    }

    public function closeFrame()
    {
        $this->frame = 'index';
        $this->cleanItems();
    }

    public function cleanItems()
    {
        $this->region = null;
        $this->province = [];
        $this->itemId = null;
        $this->inputs = [];

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function delete()
    {
        $data = Departamento::find($this->deleteId);
        if ($data->delete()) {
            $this->closeFrame();
        }
    }

    /***  begin dynamic input  ***/

    public function addInput($iterator)
    {
        $iterator = $iterator + 1;
        $this->iterator = $iterator;
        $this->inputs[] = $iterator;
    }

    public function removeInput($iterator, $item)
    {
        unset($this->inputs[$iterator]);
        if ($this->province)
            unset($this->province[$item]);
    }

    /***  end dynamic input  ***/
}
