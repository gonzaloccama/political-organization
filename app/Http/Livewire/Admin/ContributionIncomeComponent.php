<?php

namespace App\Http\Livewire\Admin;

use App\Models\CashContribution;
use Livewire\Component;

class ContributionIncomeComponent extends Component
{
    public $headers = [
        'id' => 'ID',
        'fullname' => 'Nombres',
        'amount' => 'Monto',

        'created_at' => 'Creado',
        'not' => '',
    ];

//    protected $attributes = [
//        'reference' => '<b><ins>Referencia</ins></b>',
//    ];
//
//    protected $rules = [
//        'reference' => 'required|min:3',
//    ];

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
        $rFormat = array_diff(array_keys($this->headers), ['not', 'fullname']);
        $findIn = [];
        $table = 'cash_contributions';

        foreach ($rFormat as $item) {
            $findIn[] = $table . '.' . $item;
        }

        $data['results'] = CashContribution::orderBy($this->fieldSort, $this->sort)
            ->select($table . '.*')
            ->search($findIn, $this->keyWord, 'users', ['user_firstname', 'user_lastname'])
            ->join('contributors', 'contributors.id', '=', $table . '.contributor_id')
            ->concatJoinId('users', ['user_firstname', 'user_lastname'], 'fullname', 'user_id', 'contributors')
            ->paginate($this->limit);

        $data['_title'] = 'Ingresos por aporte';

        $this->emit('refreshContent');

        return view('livewire.admin.contribution-income-component', $data)->layout('layouts.base');
    }

    public function navigateTo($id)
    {
        $this->redirect(route('admin.contributors') . '?id=' . $id);
    }
}
