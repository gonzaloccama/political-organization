<?php

namespace App\Http\Livewire\Admin;

use App\Models\EventsCategory;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class EventsCategoryComponent extends BaseComponent
{
    public $category_name;
    public $category_description;
    public $category_parent_id;
    public $category_order;

    public $tabInner;

    public $headers = [
        'id' => 'ID',
        'category_name' => 'Nombre',
        'category_order' => 'Orden',
        'category_parent_id' => 'De',

        'created_at' => 'Creado',
        'not' => '',
    ];

    protected $attributes = [
        'category_name' => '<b><ins>nombre de categoria</ins></b>',
        'category_description' => '<b><ins>descripción</ins></b>',
        'category_parent_id' => '<b><ins>categoria padre</ins></b>',
        'category_order' => '<b><ins>orden</ins></b>',
    ];
    protected $rules = [
        'category_name' => 'required|min:3|max:56',
        'category_description' => 'required|min:12|max:360',
        'category_parent_id' => 'nullable',
        'category_order' => 'numeric',
    ];

    public function mount()
    {
        $this->limit = 8;
        $this->keyWord = '';

        $this->iconSort = 'fa-sort-alpha-down';
        $this->fieldSort = 'category_order';
        $this->sort = 'asc';

        $this->frame = 'index';
    }

    public function render()
    {
        $rFormat = array_diff(array_keys($this->headers), ['not']);
        $findIn = [];
        $table = 'events_categories';

        foreach ($rFormat as $item) {
            $findIn[] = $table . '.' . $item;
        }

        $data['results'] = EventsCategory::orderBy($this->fieldSort, $this->sort)
            ->where(function ($query) use ($findIn) {
                foreach ($findIn as $in) {
                    $query->orWhere($in, 'LIKE', '%' . $this->keyWord . '%');
                }
            })
            ->paginate($this->limit);

        $data['_title'] = 'Categoría de Evento';

        $this->emit('refreshContent');

        return view('livewire.admin.events-category-component', $data)->layout('layouts.base');
    }

    public function updated($property)
    {
        $this->validateOnly($property, $this->rules, [], $this->attributes);
    }

    // BEGIN DYNAMIC METHODS

    public function openFrame()
    {
        $this->frame = 'add';
    }

    public function saveData()
    {
        $this->validate($this->rules, [], $this->attributes);

        $data = new EventsCategory();

        $data->category_name = $this->category_name;
        $data->category_description = $this->category_description;
        $data->category_parent_id = $this->category_parent_id;
        $data->category_order = $this->category_order;

        if ($data->save()) {
            $this->emit('notification', ['Se creó nueva categoría exitosamente']);
            $this->closeFrame();
        }
    }

    public function edit($id = 0)
    {
        $this->itemId = $id;
        $category = EventsCategory::where('id', $this->itemId)->first();

        $this->category_name = $category->category_name;
        $this->category_description = $category->category_description;
        $this->category_parent_id = $category->category_parent_id;
        $this->category_order = $category->category_order;

        $this->frame = 'edit';
    }

    public function updateData()
    {
        if ($this->itemId) {

            $this->validate($this->rules, [], $this->attributes);

            $event = EventsCategory::find($this->itemId);

            $event->category_name = $this->category_name;
            $event->category_description = $this->category_description;
            $event->category_parent_id = $this->category_parent_id;
            $event->category_order = $this->category_order;


            if ($event->save()) {
                $this->emit('notification', ['Categoría actualizada exitosamente']);
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
        $this->itemId = null;
        $this->category_name = null;
        $this->category_description = null;
        $this->category_parent_id = null;
        $this->category_order = null;

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function delete()
    {
        $data = EventsCategory::find($this->deleteId);

        if ($data->delete()) {
            $this->closeFrame();
        }
    }

    // END DYNAMIC METHODS
}
