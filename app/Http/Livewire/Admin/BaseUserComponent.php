<?php namespace App\Http\Livewire\Admin;

use App\Exports\UsersExport;
use App\Models\Departamento;
use App\Models\User;
use GuzzleHttp\Client;
use Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class BaseUserComponent extends BaseComponent
{
    public $username;
    public $email;
    public $phone;
    public $password;
    public $user_firstname;
    public $user_lastname;
    public $user_dni;
    public $user_picture;
    public $user_group;
    public $user_activated;
    public $user_verified;
    public $user_email_verified;
    public $user_banned;
    public $user_gender;
    public $user_relationship;
    public $user_birthdate;
    public $user_biography;
    public $user_address;
    public $user_region;
    public $user_province;
    public $created_at;
    public $user_seen_at;

    public $provinces;

    public $profileInner;

    protected $attributes = [
        'username' => '<b><ins>nombre de usuario</ins></b>',
        'email' => '<b><ins>correo electrónico</ins></b>',
        'phone' => '<b><ins>celular</ins></b>',
        'user_dni' => '<b><ins>DNI</ins></b>',
        'user_group' => '<b><ins>rol del usuario</ins></b>',
        'user_firstname' => '<b><ins>nombres</ins></b>',
        'user_lastname' => '<b><ins>apellidos</ins></b>',
        'user_picture' => '<b><ins>foto de perfil</ins></b>',
    ];

    protected $rules = [
        'username' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'required|numeric|digits:9',
        'user_dni' => 'required|numeric|digits:8',
        'user_group' => 'required',
        'user_firstname' => 'required|min:3',
        'user_lastname' => 'required|min:3',
//        'user_picture' => 'mimes:jpeg,jpg,png|max:1024|nullable',
    ];

    public function openFrame()
    {
        $this->frame = 'add';
        $this->accountSection();
    }

    public function saveData()
    {
        $rules = [
            'username' => 'required|min:3|unique:users',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|digits:9',
            'user_dni' => 'required|numeric|digits:8|unique:users',
            'user_group' => 'required',
            'user_firstname' => 'required|min:3',
            'user_lastname' => 'required|min:3',
        ];
        $this->validate($rules, [], $this->attributes);

        $data = new User();

        $data->username = $this->username;
        $data->phone = $this->phone;
        $data->email = $this->email;
        $data->password = Hash::make($this->user_dni);
        $data->user_firstname = $this->user_firstname;
        $data->user_lastname = $this->user_lastname;
        $data->user_dni = $this->user_dni;
        $data->user_picture = $this->user_picture;
        $data->user_verified = $this->user_verified != null ? '1' : '0';
        $data->user_banned = $this->user_banned != null ? '1' : '0';
        $data->user_activated = $this->user_activated != null ? '1' : '0';
        $data->user_group = $this->user_group;
        $data->user_email_verified = $this->user_email_verified != null ? '1' : '0';
        $data->user_gender = $this->user_gender;
        $data->user_relationship = $this->user_relationship;
        $data->user_birthdate = $this->user_birthdate;
        $data->user_biography = $this->user_biography;
        $data->user_address = $this->user_address;
        $data->user_region = $this->user_region;
        $data->user_province = $this->user_province;
        $data->user_seen_at = $this->user_seen_at;


        if ($data->save()) {
            $this->emit('notification', ['Se creó nuevo usuario exitosamente']);
            $this->closeFrame();
        }
    }

    public function edit($id = 0)
    {
        $this->cleanItems();

        $this->itemId = $id;
        $user = User::where('id', $this->itemId)->first();

        $this->username = $user->username;
        $this->phone = $user->phone;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->user_firstname = $user->user_firstname;
        $this->user_lastname = $user->user_lastname;
        $this->user_dni = $user->user_dni;
        $this->user_picture = $user->user_picture;
        $this->user_verified = (integer)$user->user_verified;
        $this->user_banned = (integer)$user->user_banned;
        $this->user_activated = (integer)$user->user_activated;
        $this->user_group = (integer)$user->user_group;
        $this->user_email_verified = (integer)$user->user_email_verified;
        $this->user_gender = $user->user_gender;
        $this->user_relationship = $user->user_relationship != null ? $user->user_relationship : 0;
        $this->user_birthdate = $user->user_birthdate;
        $this->user_biography = $user->user_biography;
        $this->user_address = $user->user_address;
        $this->user_region = $user->user_region;
        $this->user_province = $user->user_province;
        $this->created_at = $user->created_at;
        $this->user_seen_at = $user->user_seen_at;

        $this->frame = 'edit';
        $this->accountSection();
    }

    public function updateData()
    {
        if ($this->itemId) {

            $this->validate($this->rules, [], $this->attributes);

            $data = User::find($this->itemId);

            $data->username = $this->username;
            $data->phone = $this->phone;
            $data->email = $this->email;
            $data->password = $this->password;
            $data->user_firstname = $this->user_firstname;
            $data->user_lastname = $this->user_lastname;
            $data->user_dni = $this->user_dni;
            $data->user_picture = $this->user_picture;
            $data->user_verified = $this->user_verified != null ? '1' : '0';
            $data->user_banned = $this->user_banned != null ? '1' : '0';
            $data->user_activated = $this->user_activated != null ? '1' : '0';
            $data->user_group = $this->user_group;
            $data->user_email_verified = $this->user_email_verified != null ? '1' : '0';
            $data->user_gender = $this->user_gender;
            $data->user_relationship = $this->user_relationship;
            $data->user_birthdate = $this->user_birthdate;
            $data->user_biography = $this->user_biography;
            $data->user_address = $this->user_address;
            $data->user_region = $this->user_region;
            $data->user_province = $this->user_province;
            $data->user_seen_at = $this->user_seen_at;
//
//            dd($user);

            if ($data->save()) {
                $this->emit('notification', ['Se actualizó el usuario exitosamente']);
                $this->closeFrame();
            }
        }
    }

    public function closeFrame()
    {
        $this->frame = 'index';
        $this->cleanItems();
    }

    public function updated($property)
    {
        $this->validateOnly($property, $this->rules, [], $this->attributes);
    }

    public function cleanItems()
    {
        $this->itemId = null;
        $this->username = null;
        $this->email = null;
        $this->phone = null;
        $this->password = null;
        $this->user_firstname = null;
        $this->user_lastname = null;
        $this->user_dni = null;
        $this->user_picture = null;
        $this->user_group = 6;
        $this->user_activated = 1;
        $this->user_verified = null;
        $this->user_email_verified = null;
        $this->user_banned = null;
        $this->user_gender = null;
        $this->user_relationship = null;
        $this->user_birthdate = null;
        $this->user_biography = null;
        $this->user_address = null;
        $this->user_region = null;
        $this->user_province = null;
        $this->created_at = null;
        $this->user_seen_at = null;

        $this->provinces = [];
        $this->profileInner = null;


        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function delete()
    {
        $data = User::find($this->deleteId);
        if ($data->delete()) {
            $this->closeFrame();
        }
    }

    /** **/
    /** END DYNAMIC METHODS **/

    //    BEGIN PROFILES EDIT

    public function accountSection()
    {
        $this->profileInner = 'account';
    }

    public function profileSection()
    {
        $this->profileInner = 'profile';
        $this->emit('refreshPicker');
    }

    public function privacySection()
    {
        $this->profileInner = 'privacy';
    }

    public function securitySection()
    {
        $this->profileInner = 'security';
    }
    //    END PROFILES EDIT

    /*** begin search data ***/
    public function searchData()
    {
        $this->validate(['user_dni' => 'required|numeric|digits:8',], [], $this->attributes);
        $data = [];
        if ($this->user_dni) {
            $data = $this->getDNI($this->user_dni);
            if ($data && $data->Nombre != '' && $data->Paterno != '') {
                $this->user_firstname = mb_convert_case($data->Nombre, MB_CASE_TITLE, "UTF-8");
                $this->user_lastname = mb_convert_case($data->Paterno . ' ' . $data->Materno, MB_CASE_TITLE, "UTF-8");
            }
        }
    }

    private function getDNI($id)
    {
        $client = new Client();
        $response = $client
            ->get('https://www.facturacionelectronica.us/' .
                'facturacion/controller/ws_consulta_rucdni_v2.php?documento=' .
                'DNI&usuario=10447915125&password=985511933&nro_documento=' . $id)
            ->getBody();
        return json_decode($response)->result;
    }
    /*** end search data ***/
}
