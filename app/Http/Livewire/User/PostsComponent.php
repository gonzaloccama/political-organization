<?php

namespace App\Http\Livewire\User;

use App\Models\Emojis;
use App\Models\Post;
use App\Models\PostsComment;
use App\Models\PostsCommentsReaction;
use App\Models\PostsFile;
use App\Models\PostsPhoto;
use App\Models\PostsReaction;
use App\Models\PostsSavedItem;
use App\Models\PostsVideo;
use Cache;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostsComponent extends BaseComponent
{
    use WithFileUploads;

    protected $listeners = [
        'refreshComponent' => '$refresh',
        'updateKeySearch' => 'updateKeyWord',
        'activeConfirm' => 'deletePost',
        'load-more' => 'loadMore',
        ];

    public $keyWord;
    public $load;

    public $user_id;
    public $user_type;
    public $in_group;
    public $group_id;
    public $group_approved;
    public $in_event;
    public $event_id;
    public $event_approved;
    public $post_type;
    public $origin_id;
    public $privacy;
    public $text;

    /***  Begin post photo  ***/
    public $post_id;
    public $album_id;
    public $photo_source;
    public $newPhotoSource;
    /***  End post photo  ***/

    /***  Begin post video  ***/
    public $video_post_id;
    public $video_source;
    public $newVideoSource;
    /***  End post photo  ***/

    /***  Begin post file  ***/
    public $file_post_id;
    public $file_source;
    public $newFileSource;
    /***  End post file  ***/

    public $findUrl;
    public $isProfile;
    public $postId;
    public $postTypeDel;

    public $profile_id;
    public $saved;
    public $less_comment;
    public $all_comment;

    public $is_reaction;

    protected $attributes = [
//        'photo_source' => '<b><ins>Foto o Imagen</ins></b>',
        'video_source' => '<b><ins>Video</ins></b>',
        'file_source' => '<b><ins>PDF</ins></b>',
    ];

    protected $rules = [
//        'photo_source' => 'nullable',
        'video_source' => 'nullable|mimes:mp4|max:8400',
        'file_source' => 'nullable|mimes:pdf|max:6400',
    ];


    public function mount($is_profile, $id = null, $saved = false)
    {
        $this->privacy = 'public';
        $this->load = 10;
        $this->post_type = '';
        $this->is_reaction = 0;

        $this->findUrl = [];
        $this->less_comment = 2;

        if ($is_profile) {
            $this->isProfile = $is_profile;
            $this->profile_id = $id;
        }

        if ($saved) {
            $this->saved = true;
        } else {
            $this->saved = false;
        }
    }

    public function render()
    {
        $searchIn = ['post_type', 'text'];

        $data['posts'] = Post::orderBy('created_at', 'desc')
            ->orWhere(function ($query) use ($searchIn) {
                foreach ($searchIn as $in) {
                    $query->orWhere($in, 'LIKE', '%' . $this->keyWord . '%');
                    $query->orWhere(DB::raw("CONCAT(user_firstname, ' ', user_lastname)"), 'LIKE', '%' . $this->keyWord . '%');
                }
            })
            ->when($this->isProfile, function ($query) {
                $query->where('user_id', $this->profile_id);
            })
            ->when($this->isProfile != 1, function ($query) {
                $query->where('privacy', 'public');
            })
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->when($this->saved, function ($query) {
                $query->join('posts_saved_items', 'posts.id', '=', 'posts_saved_items.post_id');
            })
            ->select('posts.*', 'users.username')
            ->selectRaw('CONCAT(users.user_firstname," ",users.user_lastname) as fullname')
            ->paginate($this->load);

        $data['emojis'] = Emojis::all();

        $this->emit('refreshContent');

        return view('livewire.user.posts-component', $data)->layout('layouts.user');
    }

    public function updated($property)
    {
        $this->validateOnly($property, $this->rules, [], $this->attributes);
    }

    public function updatePrivacy($privacy)
    {
        $this->privacy = $privacy;
    }

    public function updatePostType($post_type)
    {
        $this->post_type = $post_type;
    }

    public function updateKeyWord($word)
    {
        $this->keyWord = $word['keyWord'];
    }

    public function loadMore()
    {
        $this->load += 5;
    }

    public function viewCommentAll($post_id)
    {
        $this->all_comment = $post_id;
    }

    public function storePost()
    {
        $this->validate($this->rules, [], $this->attributes);

        $postID = null;
        $is_file = false;
        $postTYPE = '';
//        try {
        if ($this->text || $this->photo_source || $this->video_source || $this->file_source) {

            $post = new Post();

            $post->user_id = auth()->user()->id;
            $post->user_type = 'user';
            $post->in_group = '0';
            $post->group_id = 0;
            $post->group_approved = '1';
            $post->in_event = '0';
            $post->event_id = 0;
            $post->event_approved = '0';
            $post->post_type = $postTYPE = $this->post_type;
//                $post->origin_id = 0;
            $post->privacy = $this->privacy;
            $post->text = $this->text;

            if ($post->save()) {
                $this->emit('closeModalPost');

                $this->postId = $postID = $post->id;
                $this->postTypeDel = $postTYPE;

                if (!$this->photo_source && !$this->video_source && !$this->file_source) {
                    $is_file = true;
                    $this->cleanItems();
                }
            }
            /*** Begin Upload Image/Photo ***/
            if ($this->photo_source) {
                // create an image manager instance with favored driver

                $photoSourceName = Carbon::now()->timestamp . '.' . $this->photo_source->extension();
                $photo_resize = Image::make($this->photo_source->getRealPath());
                $photo_resize->resize(720, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $photo_resize->save('assets/uploads/users/posts-photos/' . $photoSourceName);
//                $this->photo_source->storeAs('uploads/users/posts-photos', $photoSourceName);

                $postPhoto = new PostsPhoto();

                $postPhoto->post_id = $postID;
                $postPhoto->album_id = 0;
                $postPhoto->source = $photoSourceName;

                if ($postPhoto->save()) {
                    $is_file = true;
                    $this->cleanItems();
                }
            }
            /*** End Upload Image/Photo ***/

            /*** Begin Upload Video ***/
            if ($this->video_source) {
                $videoSourceName = Carbon::now()->timestamp . '.' . $this->video_source->extension();
                $this->video_source->storeAs('uploads/users/posts-videos', $videoSourceName);

                $postVideo = new PostsVideo();

                $postVideo->post_id = $postID;
                $postVideo->thumbnail = '';
                $postVideo->source = $videoSourceName;

                if ($postVideo->save()) {
                    $is_file = true;
                    $this->cleanItems();
                }
            }
            /*** End Upload Video ***/

            /*** Begin Upload Video ***/
            if ($this->file_source) {

                $str = substr($this->file_source->getClientOriginalName(), 0, strlen($this->file_source->getClientOriginalName()) - 4);
                $str .= ' ' . Carbon::now()->toDateString();
                $fileSourceName = $str . '.' . $this->file_source->extension();
                $this->file_source->storeAs('uploads/users/posts-files', $fileSourceName);

                $postFile = new PostsFile();

                $postFile->post_id = $postID;
//                $postFile->thumbnail = '';
                $postFile->source = $fileSourceName;

                if ($postFile->save()) {
                    $is_file = true;
                    $this->cleanItems();
                }
            }
            /*** End Upload Video ***/

            if (!$is_file) {
                $is_file = false;
                $this->cleanItems();
                $this->deletePost();
            }
            $this->cleanItemsDel();

        }
//        } catch (Exception $e) {
//            $this->emit('errorException', '¡Algo salió mal! no se publicó el POST.');
//            $this->cleanItems();
//            $this->deletePost();
//            $this->cleanItemsDel();
//        }
    }

    public function postShared($post_id = null)
    {
        try {
            if ($post_id) {
                $this->origin_id = $post_id;
                $this->post_type = 'shared';
            } else {

                $post = new Post();

                $post->user_id = auth()->user()->id;
                $post->user_type = 'user';
                $post->in_group = '0';
                $post->group_id = 0;
                $post->group_approved = '1';
                $post->in_event = '0';
                $post->event_id = 0;
                $post->event_approved = '0';
                $post->post_type = $this->post_type;
                $post->origin_id = $this->origin_id;
                $post->privacy = $this->privacy;
                $post->text = $this->text;
                $post->shares = 0;

                if ($post->save()) {
                    $this->emit('closeModalPostShared');
                    $this->cleanItems();
                }
            }
        } catch (Exception $e) {
            $this->emit('errorException', '¡Algo salió mal! no se compartió la publicación.');
        }
    }

    public function PostSaved($post_id)
    {
        try {
            if ($post_id) {
                $postSaved = new PostsSavedItem();

                $postSaved->post_id = $post_id;
                $postSaved->user_id = auth()->user()->id;

                if ($postSaved->save()) {
                    $this->emit('alertSaved');
                    $this->cleanItems();
                }
            }
        } catch (Exception $e) {
            $this->emit('errorException', '¡Algo salió mal! no se guardó la publicación.');
        }
    }

    public function storePostsReaction($post_id, $user_id, $reaction)
    {
        try {
            if ($post_id && $user_id && $reaction) {

                $is_reaction = PostsReaction::where('post_id', $post_id)->where('user_id', $user_id)->first();

                if (!$is_reaction) {
                    $postsReaction = new PostsReaction();

                    $postsReaction->post_id = $post_id;
                    $postsReaction->user_id = $user_id;
                    $postsReaction->reaction = $reaction;

                    $postsReaction->save();
                }
            }

//        $like = [
//            'like-my' => 'reaction_like_count', 'heart-my' => 'reaction_love_count', 'happy-my' => 'reaction_yay_count'
//        ];
//
//        $cLike = MediaPost::find($post_id);
//
//        foreach ($like as $key => $l) {
//            $cLike[$l] = \App\Models\MediaPostsReaction::where('post_id', $post_id)
//                ->where('reaction', $key)->pluck('reaction')->count();
//        }
//
//        $cLike->save();

        } catch (Exception $e) {
        }
    }

    public function updatePostsReaction($myLike_id, $reaction)
    {
        try {
            if ($myLike_id && $reaction) {

                $postsReaction = PostsReaction::find($myLike_id);

                if ($postsReaction) {
                    $postsReaction->reaction = $reaction;
                    $postsReaction->save();
                }
//            $like = [
//                'like-my' => 'reaction_like_count', 'heart-my' => 'reaction_love_count', 'happy-my' => 'reaction_yay_count'
//            ];
//
//            $cLike = MediaPost::find($postsReaction->post_id);
//
//            foreach ($like as $key => $l) {
//                $cLike[$l] = \App\Models\MediaPostsReaction::where('post_id', $postsReaction->post_id)
//                    ->where('reaction', $key)->pluck('reaction')->count();
//            }
//
//            $cLike->save();
            }
        } catch (Exception $e) {
        }
    }

    public function storePostsCommentsReaction($comment_id, $user_id, $reaction)
    {
        try {
            if ($reaction && $user_id && $comment_id) {

                $is_reaction = PostsCommentsReaction::where('comment_id', $comment_id)->where('user_id', $user_id)->first();

                if (!$is_reaction) {
                    $postsCommentReaction = new PostsCommentsReaction();

                    $postsCommentReaction->comment_id = $comment_id;
                    $postsCommentReaction->user_id = $user_id;
                    $postsCommentReaction->reaction = $reaction;

                    $postsCommentReaction->save();
                }
            }
        } catch (Exception $e) {
        }
    }

    public function updatePostsCommentsReaction($myLike_id, $reaction)
    {
        try {
            if ($myLike_id && $reaction) {

                $postsCommentReaction = PostsCommentsReaction::find($myLike_id);

                $postsCommentReaction->reaction = $reaction;

                $postsCommentReaction->save();
            }
        } catch (Exception $e) {
        }
    }

    public function cleanItems()
    {
        $this->user_id = null;
        $this->user_type = null;
        $this->in_group = null;
        $this->group_id = null;
        $this->group_approved = null;
        $this->in_event = null;
        $this->event_id = null;
        $this->event_approved = null;
        $this->post_type = '';
        $this->origin_id = null;
        $this->privacy = 'public';
        $this->text = null;

        $this->photo_source = null;
        $this->video_source = null;
        $this->file_source = null;
        $this->findUrl = [];

        Cache::flush();

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function cleanItemsDel()
    {
        $this->postId = null;
        $this->postTypeDel = null;

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function deletePostConfirm($post_id, $post_type = '')
    {
        $this->postId = $post_id;
        $this->postTypeDel = $post_type;
        $this->emit('deleteAlert');
    }

    public function deletePost()
    {
        if ($this->postId) {
            $post = Post::find($this->postId);

            if (isset($post->post_type) && filled($post['posts' . ucfirst($post->post_type)])) {
                $file = 'assets/uploads/users/posts-' . $post->post_type . 's/' . $post['posts' . ucfirst($post->post_type)]->source;
            }

            if ($post->delete()) {
                if (isset($post->post_type) && filled($post['posts' . ucfirst($post->post_type)])) {
                    File::delete(
                        public_path($file),
                    );
                }
            }
        }
    }


    public function deletePostsComment($comment_id)
    {
        if ($comment_id) {
            $postsComment = PostsComment::find($comment_id);
            $postsComment->delete();
        }
    }

    public function deleteLike($like_id)
    {
        try {
            if ($like_id) {
                $PostsReaction = PostsReaction::find($like_id);
                if ($PostsReaction) {
                    $PostsReaction->delete();
                }
            }
        } catch (Exception $e) {
        }
    }

    public function deleteCommentsLike($like_id)
    {
        try {
            if ($like_id) {
                $PostsCommentsReaction = PostsCommentsReaction::find($like_id);
                $PostsCommentsReaction->delete();
            }
        } catch (Exception $e) {
        }
    }

    public function deleteFilePost()
    {
        $this->photo_source = null;
        $this->video_source = null;
        $this->file_source = null;
        $this->post_type = '';

        Cache::flush();

        $this->resetErrorBag();
        $this->resetValidation();
    }
}
