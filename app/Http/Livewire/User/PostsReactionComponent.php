<?php

namespace App\Http\Livewire\User;

use App\Models\PostsReaction;
use Livewire\Component;

class PostsReactionComponent extends Component
{
    public $post_id;
    public $album_id;
    public $source;

    public function mount($post)
    {
        $this->post_id = $post;
    }

    public function render()
    {
        return view('livewire.user.posts-reaction-component');
    }

    public function storePhoto()
    {

    }
}
