<?php

namespace App\Http\Livewire\Admin;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class PostsComponent extends BaseComponent
{
    public $deleteId;

    public $headers = [
        'id' => 'ID',
        'fullname' => 'Autor',
        'privacy' => 'Prvacidad',
//        'event_date' => 'Dia',

        'created_at' => 'Creado',
        'not' => '',
    ];

    public function mount()
    {
        $this->limit = 8;
        $this->keyWord = '';

        $this->iconSort = 'fa-sort-alpha-down';
        $this->fieldSort = 'created_at';
        $this->sort = 'desc';

        $this->frame = 'index';
    }

    public function render()
    {
        $rFormat = array_diff(array_keys($this->headers), ['not', 'fullname']);
        $findIn = [];
        $table = 'posts';

        foreach ($rFormat as $item) {
            $findIn[] = $table . '.' . $item;
        }

        $data['results'] = Post::orderBy($this->fieldSort, $this->sort)
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
            ->leftJoin('users', 'users.id', $table . '.user_id')
            ->paginate($this->limit);

        $data['_title'] = 'Publicaciones';

        $this->emit('refreshContent');

        return view('livewire.admin.posts-component', $data)->layout('layouts.base');
    }


    public function delete()
    {
        $data = Post::find($this->deleteId);
        if ($data->delete()) {
//            $this->closeFrame();
        }
    }

}
