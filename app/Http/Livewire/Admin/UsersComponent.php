<?php namespace App\Http\Livewire\Admin;

use App\Exports\UsersExport;
use App\Models\Departamento;
use App\Models\Gender;
use App\Models\Relationship;
use App\Models\Role;
use App\Models\User;
use PDF;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class UsersComponent extends BaseUserComponent
{
    public $headers = [
        'id' => 'ID',
        'user_dni' => 'DNI',
        'fullname' => 'Nombres',
        'phone' => 'Celular',
        'email' => 'Correo',

        'user_activated' => 'Estado',
        'created_at' => 'Unido',
        'not' => '',
    ];

    public function mount()
    {
        $this->limit = 8;
        $this->keyWord = '';

        $this->iconSort = 'fa-sort-alpha-down';
        $this->fieldSort = 'id';
        $this->sort = 'asc';

        $this->frame = 'index';

        $this->provincias = [];
        $this->user_group = 6;
        $this->user_activated = 1;
    }

    public function render()
    {
        $rFormat = array_diff(array_keys($this->headers), ['not', 'fullname']);
        $findIn = [];
        $table = 'users';

        foreach ($rFormat as $item) {
            $findIn[] = $table . '.' . $item;
        }

        $data['results'] = User::orderBy($this->fieldSort, $this->sort)
            ->where('user_group', 'LIKE', $this->filter)
            ->where(function ($query) use ($findIn) {
                foreach ($findIn as $in) {
                    $query->orWhere($in, 'LIKE', '%' . $this->keyWord . '%');
                }
                $query->orWhere(DB::raw("CONCAT(user_firstname, ' ', user_lastname)"), 'LIKE', '%' . $this->keyWord . '%');
            })
            ->select('users.*')
            ->selectRaw('CONCAT(users.user_firstname," ",users.user_lastname) as fullname')
            ->paginate($this->limit);

        $data['_title'] = 'Usuarios';

        $data['genders'] = Gender::all();
        $data['relationships'] = Relationship::all();
        $data['roles'] = Role::where('id', '!=', 1)->get();
        $data['regions'] = Departamento::all();
        $data['title'] = 'Usuarios';

        $this->emit('refreshContent');

        return view('livewire.admin.users-component', $data)->layout('layouts.base');
    }

    public function exportExcel()
    {
        return Excel::download(new UsersExport(false), "usuarios.xlsx");
    }

    public function exportPDF()
    {
        $findIn = ['id', 'user_dni', 'user_dni', 'username', 'phone'];
        $data = [
            'title' => 'Usuarios',

            'users' => User::paginate(100),
        ];

        $pdf = PDF::loadView('exports.pdf.users', $data);
        $pdf->setPaper('L', 'landscape');
//        $pdf->getDomPDF()->set_option("enable_php", true);


        return $pdf->stream('users.pdf');
    }

}
