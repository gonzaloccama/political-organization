<?php

namespace App\Http\Livewire\Admin;

use App\Models\SystemSetting;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class SystemSettingComponent extends BaseComponent
{
    use WithFileUploads;

    public $name;
    public $description;
    public $executive;
    public $phones;
    public $emails;
    public $addresses;
    public $campus;
    public $media_social;
    public $facebook_page;
    public $mission;
    public $vision;
    public $objectives;
    public $history;
    public $values;

    public $updated_at;

    public $logo;
    public $logo_white;
    public $favicon;
    public $edit_logo;
    public $edit_logo_white;
    public $edit_favicon;

    public $draw;

    protected $attributes = [
        'name' => '<b><ins>Nombre</ins></b>',
        'description' => '<b><ins>Descripción</ins></b>',
        'executive' => '<b><ins>Ejecutivo</ins></b>',
        'phones.0' => '<b><ins>Telefono</ins></b>',
        'phones.*' => '<b><ins>Telefono</ins></b>',
        'emails.0' => '<b><ins>Email</ins></b>',
        'emails.*' => '<b><ins>Email</ins></b>',
        'addresses.0' => '<b><ins>Dirección</ins></b>',
        'addresses.*' => '<b><ins>Dirección</ins></b>',
        'media_social.facebook' => '<b><ins>Facebook</ins></b>',
        'media_social.youtube' => '<b><ins>YouTube</ins></b>',
        'media_social.instagram' => '<b><ins>Instagram</ins></b>',
        'media_social.twitter' => '<b><ins>Twitter</ins></b>',
        'media_social.whatsapp' => '<b><ins>WhatsApp</ins></b>',
        'facebook_page' => '<b><ins>Página Facebook</ins></b>',
        'logo' => '<b><ins>Logo</ins></b>',
        'logo_white' => '<b><ins>Logo blanco</ins></b>',
        'favicon' => '<b><ins>Favicon</ins></b>',
        'mission' => '<b><ins>Misión</ins></b>',
        'vision' => '<b><ins>Visión</ins></b>',
        'objectives' => '<b><ins>Objetivos</ins></b>',
        'campus' => '<b><ins>Campus</ins></b>',
        'history' => '<b><ins>Historia</ins></b>',
        'values' => '<b><ins>Valores</ins></b>',

    ];

    protected $rules = [
        'name' => 'required|min:3',
        'description' => 'required',
        'executive' => 'required',

        'phones.0' => 'required|numeric|digits:9',
        'phones.*' => 'nullable|numeric|digits:9',

        'emails.0' => 'required|email',
        'emails.*' => 'nullable|email',

        'addresses.0' => 'required',
        'addresses.*' => 'nullable',

        'media_social.facebook' => 'nullable|url',
        'media_social.youtube' => 'nullable|url',
        'media_social.instagram' => 'nullable|url',
        'media_social.twitter' => 'nullable|url',
        'media_social.whatsapp' => 'nullable|url',


        'facebook_page' => 'nullable|url',

        'logo' => 'nullable|mimes:png,jpg,jpeg,svg|max:1024',
        'logo_white' => 'nullable|mimes:png,jpg,jpeg,svg|max:1024',
        'favicon' => 'nullable|mimes:png,jpg,jpeg,svg|max:1024',

        'mission' => 'nullable',
        'vision' => 'nullable',
        'objectives' => 'nullable',
        'campus' => 'nullable',
        'history' => 'nullable',
        'values' => 'nullable',
    ];

    public function mount()
    {
        $this->frame = 'index';
        $this->image_path = 'logos';

        $this->content();
    }

    public function render()
    {
        $data['_title'] = 'Sistema';

        $this->emit('refreshContent');

        return view('livewire.admin.system-setting-component', $data)->layout('layouts.base');
    }

    public function updated($property)
    {
        $this->validateOnly($property, $this->rules, [], $this->attributes);
    }

    public function content($draw = 'general')
    {
        $this->initData();
        $this->draw = $draw;
    }

    public function saveData()
    {
        $data = SystemSetting::find(1);

        if (!$data) {
            unset($data);
            $data = new SystemSetting();
        }


        if ($this->draw == 'general') {
            $this->validate($this->rules, [], $this->attributes);

            $data->name = $this->name;
            $data->description = $this->description;
            $data->executive = $this->executive;
            $data->phones = json_encode($this->phones);
            $data->emails = json_encode($this->emails);
            $data->addresses = json_encode($this->addresses);
            $data->campus = $this->campus;
        } elseif ($this->draw == 'media') {
            $data->media_social = json_encode($this->media_social);
            $data->facebook_page = $this->facebook_page;
        } elseif ($this->draw == 'logo') {

            if ($this->logo) {
                $logoName = 'logo' . '.' . $this->logo->extension();
                $this->logo->storeAs('logos', $logoName);
                $data->logo = $logoName;
            }

            if ($this->logo_white) {
                $logoWhiteName = 'logo_white' . '.' . $this->logo_white->extension();
                $this->logo_white->storeAs('logos', $logoWhiteName);
                $data->logo_white = $logoWhiteName;
            }

            if ($this->favicon) {
                $faviconName = 'favicon' . '.' . $this->favicon->extension();
                $this->favicon->storeAs('logos', $faviconName);
                $data->favicon = $faviconName;
            }
        } elseif ($this->draw == 'mission-vision') {
            $data->mission = $this->mission;
            $data->vision = $this->vision;
            $data->objectives = $this->objectives;
        } else {
            $data->campus = $this->campus;
            $data->history = $this->history;
            $data->values = $this->values;
        }

        if ($data->save()) {
            $this->emit('notification', ['Se guardó exitosamente']);
//            $this->closeFrame();
        }
    }

    public function initData()
    {
        $data = SystemSetting::find(1);

        if ($data) {
            $this->name = $data->name;
            $this->description = $data->description;
            $this->executive = $data->executive;
            $this->phones = json_decode($data->phones);
            $this->emails = json_decode($data->emails);
            $this->addresses = json_decode($data->addresses);
            $this->campus = $data->campus;
            $this->media_social = json_decode($data->media_social);
            $this->facebook_page = $data->facebook_page;
            $this->edit_logo = $data->logo;
            $this->edit_logo_white = $data->logo_white;
            $this->edit_favicon = $data->favicon;
            $this->mission = $data->mission;
            $this->vision = $data->vision;
            $this->objectives = $data->objectives;
            $this->history = $data->history;
            $this->values = $data->values;

            $this->updated_at = $data->updated_at;

            $this->logo = null;
            $this->logo_white = null;
            $this->favicon = null;


        }
    }

    public function closeFrame()
    {
        $this->frame = 'index';
        $this->content();
        $this->cleanItems();
    }

    public function cleanItems()
    {
        $this->itemId = null;
        $this->image_path = 'logos';

        $this->initData();

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function delete()
    {
        $data = SystemSetting::find($this->deleteId);

        if ($data->delete()) {
            $this->closeFrame();
        }
    }

    public function deleteConfirm($id)
    {
        $this->deleteId = $id;
        $this->emit('deleteAlert');
    }
}
