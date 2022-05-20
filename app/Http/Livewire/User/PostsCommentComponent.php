<?php

namespace App\Http\Livewire\User;

use App\Models\Emojis;
use App\Models\PostsComment;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class PostsCommentComponent extends Component
{
    public $node_id;
    public $node_type;
    public $user_id;
    public $user_type;
    public $text;
    public $image;

    public function mount($user, $post, $post_type)
    {
        $this->user_id = $user;
        $this->node_id = $post;
        $this->node_type = "$post_type";
        $this->user_type = 'user';
        $this->text = '';
    }

    public function render()
    {
        $data['emojis'] = Emojis::all();

        return view('livewire.user.posts-comment-component', $data);
    }

    public function storePostsComment()
    {
        try {
            if ($this->text != null) {
                $postsComment = new PostsComment();

                $postsComment->node_id = $this->node_id;
                $postsComment->node_type = $this->node_type;
                $postsComment->user_id = $this->user_id;
                $postsComment->user_type = $this->user_type;
                $postsComment->text = $this->text;
//        $postsComment->image = $this->image;
                if ($postsComment->save()) {
                    $this->emitTo('user.posts-component', 'refreshComponent');
                    $this->cleanItems();
                }
            }
        }catch (Exception $e){
            $this->emit('errorException', '¡Algo salió mal! no se publicó su comentario.');
        }
    }

    public function updateText($text)
    {
        if ($text && $text != '') {
            $this->text .= ' ' . $text;
        }
    }

    public function cleanItems()
    {
        $this->user_type = 'user';
        $this->text = null;
    }
}
