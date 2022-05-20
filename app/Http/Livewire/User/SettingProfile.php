<?php

namespace App\Http\Livewire\User;

use App\Models\Gender;
use App\Models\Relationship;
use App\Models\User;
use Hash;
use Livewire\Component;

class SettingProfile extends Component
{
    public $username;
    public $email;
    public $phone;
    public $user_firstname;
    public $user_lastname;
    public $user_dni;
    public $user_gender;
    public $user_cover;
    public $user_address;
    public $user_country;
    public $user_region;
    public $user_province;
    public $user_birthdate;
    public $user_relationship;
    public $user_biography;
    public $user_current_city;
    public $user_social_facebook;
    public $user_social_whatsapp;
    public $user_privacy_gender;
    public $user_privacy_birthdate;
    public $user_privacy_relationship;
    public $user_privacy_basic;

    public $current_password;
    public $password;
    public $confirm_password;

    public $tab_pane = 'personal-information';

    protected $attributes = [
        'username' => '<b><ins>Nombre de usuario</ins></b>',
        'email' => '<b><ins>Email</ins></b>',
        'phone' => '<b><ins>Celular</ins></b>',

        'current_password' => '<b><ins>Contraseña Actual</ins></b>',
        'password' => '<b><ins>Nueva Contraseña</ins></b>',
        'confirm_password' => '<b><ins>Confirmar Contraseña</ins></b>',

        'user_firstname' => '<b><ins>Nombres</ins></b>',
        'user_lastname' => '<b><ins>Apellidos</ins></b>',
        'user_dni' => '<b><ins>DNI</ins></b>',
        'user_gender' => '<b><ins>Sexo</ins></b>',
        'user_address' => '<b><ins>Dirección</ins></b>',
        'user_region' => '<b><ins>Región</ins></b>',
        'user_province' => '<b><ins>Provincia</ins></b>',
        'user_birthdate' => '<b><ins>Cumpleaños</ins></b>',
        'user_relationship' => '<b><ins>Estado civil</ins></b>',
        'user_biography' => '<b><ins>Biografía</ins></b>',

        'user_social_facebook' => '<b><ins>Facebook</ins></b>',
        'user_social_whatsapp' => '<b><ins>WhatsApp</ins></b>',

    ];
    protected $rules = [
        'username' => 'required|min:3|unique:users',
        'email' => 'required|email|unique:users',
        'phone' => 'required|numeric|digits:9|unique:users',

        'current_password' => 'required',
        'password' => 'required|min:6',
        'confirm_password' => 'required|same:password',

        'user_firstname' => 'required|min:3',
        'user_lastname' => 'required|min:3',
        'user_dni' => 'required|numeric|digits:8|unique:users',
        'user_gender' => 'nullable',
        'user_address' => 'nullable',
        'user_region' => 'nullable',
        'user_province' => 'nullable',
        'user_birthdate' => 'nullable|date_format:Y-m-d',
        'user_relationship' => 'nullable',
        'user_biography' => 'nullable|min:40|max:560',

        'user_social_facebook' => 'nullable|url|regex:/^(https?:\/\/)?(www\.)?facebook.com\/[a-zA-Z0-9(\.\?)?]/',
        'user_social_whatsapp' => 'nullable|numeric|digits:9',

    ];

    protected $queryString = [
        'tab_pane' => ['except' => ''],
    ];

    public function mount()
    {
        $this->active_tab($this->tab_pane);
    }


    public function render()
    {
        $data['_title'] = 'Editar Perfil';
        $data['genders'] = Gender::all();
        $data['relationships'] = Relationship::all();

        $this->emit('refreshContent');

        return view('livewire.user.setting-profile', $data)->layout('layouts.user');
    }

    public function updated($property)
    {
        $this->validateOnly($property, $this->rules, [], $this->attributes);
    }

    public function active_tab($tab_pane)
    {
        if ($tab_pane) {
            $this->tab_pane = $tab_pane;

            $data = User::find(auth()->user()->id);

            if ($this->tab_pane == 'personal-information') {

                $this->user_cover = $data->user_cover;
                $this->user_firstname = $data->user_firstname;
                $this->user_lastname = $data->user_lastname;
                $this->username = $data->username;
                $this->email = $data->email;
                $this->user_dni = $data->user_dni;
                $this->phone = $data->phone;
                $this->user_birthdate = $data->user_birthdate;
                $this->user_relationship = $data->user_relationship;
                $this->user_gender = $data->user_gender;
                $this->user_biography = $data->user_biography;
                $this->user_address = $data->user_address;
                $this->user_region = $data->user_region;
                $this->user_province = $data->user_province;

            } elseif ($this->tab_pane == 'links-social') {

                $this->user_social_facebook = $data->user_social_facebook;
                $this->user_social_whatsapp = $data->user_social_whatsapp;

            } elseif ($this->tab_pane == 'privacy') {

                $this->user_privacy_gender = $data->user_privacy_gender;
                $this->user_privacy_birthdate = $data->user_privacy_birthdate;
                $this->user_privacy_relationship = $data->user_privacy_relationship;
                $this->user_privacy_basic = $data->user_privacy_basic;

            }
            $this->emit('refreshSection');
        }
    }

    public function storeProfile($profile)
    {
        if ($profile) {

            $data = User::find(auth()->user()->id);

            if ($profile == 'personal-information') {

                $rules = $this->rules;
                unset(
                    $rules['username'],
                    $rules['email'],
                    $rules['phone'],
                    $rules['user_dni'],
                    $rules['current_password'],
                    $rules['password'],
                    $rules['confirm_password'],
                );

                $rules = array_merge($rules, [
                    'username' => 'required|min:3',
                    'email' => 'required|email',
                    'phone' => 'required|numeric|digits:9',
                    'user_dni' => 'required|numeric|digits:8',
                ]);

                $this->validate($rules, [], $this->attributes);

//                $data->user_firstname = $this->user_firstname;
//                $data->user_lastname = $this->user_lastname;
                $data->username = $this->username;
//                $data->email = $this->email;
//                $data->user_dni = $this->user_dni;
                $data->phone = $this->phone;
                $data->user_birthdate = $this->user_birthdate;
                $data->user_relationship = $this->user_relationship;
                $data->user_gender = $this->user_gender;
                $data->user_biography = $this->user_biography;
                $data->user_dni = $this->user_dni;

                $data->user_address = $this->user_address;
                $data->user_region = $this->user_region;
                $data->user_province = $this->user_province;

            } elseif ($profile == 'chang-pwd') {

                $rules = $this->rules;
                unset(
                    $rules['username'],
                    $rules['email'],
                    $rules['phone'],
                    $rules['user_firstname'],
                    $rules['user_lastname'],
                    $rules['user_dni'],
                );

                $this->validate($rules, [], $this->attributes);

                $user_password = $data->password;

                if (!Hash::check($this->current_password, $user_password)) {
                    $this->addError(
                        'current_password',
                        'La <b><ins>Contraseña que ingresó</ins></b> no coincide con la <b><ins>Contraseña actual.</ins></b>'
                    );
                    return;
                }

                $data->password = Hash::make($this->password);

            } elseif ($profile == 'links-social') {

                $rules = $this->rules;
                unset(
                    $rules['username'],
                    $rules['email'],
                    $rules['phone'],
                    $rules['user_firstname'],
                    $rules['user_lastname'],
                    $rules['user_dni'],
                    $rules['current_password'],
                    $rules['password'],
                    $rules['confirm_password'],
                );

                $this->validate($rules, [], $this->attributes);

                $data->user_social_facebook = $this->user_social_facebook;
                $data->user_social_whatsapp = $this->user_social_whatsapp;

            } elseif ($profile == 'privacy') {

                $rules = $this->rules;
                unset(
                    $rules['username'],
                    $rules['email'],
                    $rules['phone'],
                    $rules['user_firstname'],
                    $rules['user_lastname'],
                    $rules['user_dni'],
                    $rules['current_password'],
                    $rules['password'],
                    $rules['confirm_password'],
                    $rules['user_biography'],
                );

                $this->validate($rules, [], $this->attributes);

                $data->user_privacy_gender = $this->user_privacy_gender ? 1: 0;
                $data->user_privacy_birthdate = $this->user_privacy_birthdate ? 1: 0;
                $data->user_privacy_relationship = $this->user_privacy_relationship ? 1: 0;
                $data->user_privacy_basic = $this->user_privacy_basic ? 1: 0;

            }

            if ($data->save()) {
                $this->closeFrame();
                $this->emit('alertSaved');
            }
        }
    }

    public function clearItems()
    {
        $this->username = null;
        $this->email = null;
        $this->phone = null;
        $this->user_firstname = null;
        $this->user_lastname = null;
        $this->user_dni = null;
        $this->user_gender = null;
        $this->user_cover = null;
        $this->user_address = null;
        $this->user_country = null;
        $this->user_region = null;
        $this->user_province = null;
        $this->user_birthdate = null;
        $this->user_relationship = null;
        $this->user_biography = null;
        $this->user_current_city = null;
        $this->user_social_facebook = null;
        $this->user_social_whatsapp = null;
        $this->user_privacy_gender = null;
        $this->user_privacy_birthdate = null;
        $this->user_privacy_relationship = null;
        $this->user_privacy_basic = null;

        $this->current_password = null;
        $this->password = null;
        $this->confirm_password = null;

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function closeFrame()
    {
        $this->clearItems();
        $this->active_tab('personal-information');
    }
}
