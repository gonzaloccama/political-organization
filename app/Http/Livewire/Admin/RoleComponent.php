<?php

namespace App\Http\Livewire\Admin;

use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;

class RoleComponent extends BaseComponent
{
    public $tabInner;

    public $name;
    public $description;

    public $headers = [
        'id' => 'ID',
        'name' => 'Nombre del rol',
        'description' => 'Descripción',

        'created_at' => 'Creado',
        'not' => '',
    ];

    protected $attributes = [
        'name' => '<b><ins>nombre del rol</ins></b>',
        'description' => '<b><ins>descripción</ins></b>',
    ];

    protected $rules = [
        'name' => 'required|min:3',
        'description' => 'nullable|min:10|max:360',
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
        $table = 'roles';

        foreach ($rFormat as $item) {
            $findIn[] = $table . '.' . $item;
        }

        $data['results'] = Role::orderBy($this->fieldSort, $this->sort)
            ->where('id', '!=', 1)
            ->where(function ($query) use ($findIn) {
                foreach ($findIn as $in) {
                    $query->orWhere($in, 'LIKE', '%' . $this->keyWord . '%');
                }
            })
            ->paginate($this->limit);

        $data['_title'] = 'Roles de usuario';

        $this->emit('refreshContent');

        return view('livewire.admin.role-component', $data)->layout('layouts.base');
    }

    public function updated($property)
    {
        $this->validateOnly($property, $this->rules, [], $this->attributes);
    }

    public function edit($id = 0)
    {
        $this->itemId = $id;
        $data = Role::where('id', $this->itemId)->first();

        $this->name = $data->name;
        $this->description = $data->description;

        $this->frame = 'edit';
    }

    public function updateData()
    {
        if ($this->itemId) {

            $this->validate($this->rules, [], $this->attributes);

            $data = Role::find($this->itemId);

            $data->name = $this->name;
            $data->description = $this->description;


            if ($data->save()) {
                $this->emit('notification', ['El rol de usuario se actualizó exitosamente']);
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

        $data = new Role();

        $data->name = $this->name;
        $data->description = $this->description;


        if ($data->save()) {
            $this->emit('notification', ['Nuevo rol creado exitosamente']);
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
        $this->name = null;
        $this->description = null;
        $this->itemId = null;

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function delete()
    {
        $data = Role::find($this->deleteId);
        if ($data->delete()){
            $this->closeFrame();
        }
    }

    public function deleteConfirm($id)
    {
        $this->deleteId = $id;
        $this->emit('deleteAlert');
    }
}
