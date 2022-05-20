<?php

namespace App\Exports;

use App\Users;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    protected $user_group;

    public function __construct($user_group = false)
    {
        $this->user_group = $user_group;
    }

    public function view(): View
    {

        if ($this->user_group) {
            $users = User::orderBy('id', 'asc')->where('user_group', $this->user_group)->get();
        } else {
            $users = User::orderBy('id', 'asc')->get();
        }


        return view('exports.users', [
            'users' => $users
        ]);
    }

//    public function query()
//    {
//        $result = User::query()
//            ->orderBy('id', 'asc');
//
//        if ($this->user_group){
//            $result->where('user_group', $this->user_group);
//        }
//
//        return $result;
//    }
}
