<?php

namespace App\Http\Livewire\Admin;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class EventsComponent extends BaseComponent
{
    public $event_privacy;
    public $event_admin;
    public $event_category;
    public $event_title;
    public $event_location;
    public $event_description;
    public $event_start_date;
    public $event_end_date;
    public $created_at;
    public $admin;

    public $tabInner;

    public $headers = [
        'id' => 'ID',
        'fullname' => 'Admin',
        'event_title' => 'Titulo',
        'event_start_date' => 'Inicio',
        'event_end_date' => 'Fin',
//        'event_date' => 'Dia',

        'created_at' => 'Creado',
        'not' => '',
    ];

    protected $attributes = [
        'event_privacy' => '<b><ins>privacidad</ins></b>',
        'event_admin' => '<b><ins>adminitrador</ins></b>',
        'event_category' => '<b><ins>categoria</ins></b>',
        'event_title' => '<b><ins>nombre del evento</ins></b>',
        'event_location' => '<b><ins>Localización</ins></b>',
        'event_description' => '<b><ins>descripción</ins></b>',
        'event_start_date' => '<b><ins>fecha de incio</ins></b>',
        'event_end_date' => '<b><ins>fecha final</ins></b>',
    ];

    protected $rules = [
        'event_privacy' => 'required',
        'event_admin' => 'required',
        'event_category' => 'required',
        'event_title' => 'required|min:6',
        'event_location' => 'required',
        'event_description' => 'required|min:12|max:400',
        'event_start_date' => 'required|date_format:Y-m-d H:i',
        'event_end_date' => 'required|date_format:Y-m-d H:i',
    ];

    public function mount()
    {
        $this->limit = 8;
        $this->keyWord = '';

        $this->iconSort = 'fa-sort-alpha-down';
        $this->fieldSort = 'event_start_date';
        $this->sort = 'desc';

        $this->frame = 'index';
    }

    public function render()
    {
        $rFormat = array_diff(array_keys($this->headers), ['not', 'fullname']);
        $findIn = [];
        $table = 'events';

        foreach ($rFormat as $item) {
            $findIn[] = $table . '.' . $item;
        }

        $data['results'] = Event::orderBy($this->fieldSort, $this->sort)
//            ->where('user_group', 'LIKE', $this->filter)
            ->where(function ($query) use ($findIn) {
                foreach ($findIn as $in) {
                    $query->orWhere($in, 'LIKE', '%' . $this->keyWord . '%');
                }
                $query->orWhere(DB::raw("CONCAT(user_firstname, ' ', user_lastname)"), 'LIKE', '%' . $this->keyWord . '%');
            })
            ->select($table . '.*')
//            ->selectRaw('users.user_firstname')
            ->selectRaw('CONCAT(users.user_firstname," ",users.user_lastname) as fullname')
            ->leftJoin('users', 'users.id', $table . '.event_admin')
            ->paginate($this->limit);

        $data['_title'] = 'Eventos';

        $this->emit('refreshContent');

        return view('livewire.admin.events-component', $data)->layout('layouts.base');
    }

    public function updated($property)
    {
        $this->validateOnly($property, $this->rules, [], $this->attributes);
    }


    // BEGIN DYNAMIC METHODS

    public function edit($id = 0)
    {
        $this->itemId = $id;
        $event = Event::where('id', $this->itemId)->first();

        $date = Carbon::parse($event->event_start_date, 'America/Lima');
//        echo $date->isoFormat('MMMM Do YYYY, h:mm:ss a'); // June 15th 2018, 5:34:15 pm

        $this->event_privacy = $event->event_privacy;
        $this->event_admin = $event->event_admin;
        $this->event_category = $event->event_category;
        $this->event_title = $event->event_title;
        $this->event_location = $event->event_location;
        $this->event_description = $event->event_description;
        $this->event_start_date = Carbon::parse($event->event_start_date)->format('Y-m-d H:i');
        $this->event_end_date = Carbon::parse($event->event_end_date)->format('Y-m-d H:i');
        $this->created_at = $event->created_at;

        $this->admin = $event->event_admin;

        $this->frame = 'edit';
        $this->settingSection();
    }

    public function updateData()
    {
        if ($this->itemId) {

            $this->validate($this->rules, [], $this->attributes);

            $event = Event::find($this->itemId);

            $event->event_privacy = $this->event_privacy;
            $event->event_admin = $this->event_admin;
            $event->event_category = $this->event_category;
            $event->event_title = $this->event_title;
            $event->event_location = $this->event_location;
            $event->event_description = $this->event_description;
            $event->event_start_date = $this->event_start_date;
            $event->event_end_date = $this->event_end_date;

            if ($event->save()) {
                $this->emit('notification', ['El evento se actualizó exitosamente']);
                $this->closeFrame();
            }
        }
    }


    public function closeFrame()
    {
        $this->frame = 'index';
        $this->cleanItems();
    }

    public function settingSection()
    {
        $this->tabInner = 'setting';
        $this->emit('refreshPicker');
    }

    public function cleanItems()
    {
        $this->itemId = null;
        $this->event_privacy = null;
        $this->event_admin = null;
        $this->event_category = null;
        $this->event_title = null;
        $this->event_location = null;
        $this->event_description = null;
        $this->event_start_date = null;
        $this->event_end_date = null;
        $this->created_at = null;
        $this->admin = null;

        $this->resetErrorBag();
        $this->resetValidation();
    }

    // END DYNAMIC METHODS

    public function delete()
    {
        $data = Event::find($this->deleteId);

        if ($data->delete()) {
            $this->closeFrame();
        }
    }
}
