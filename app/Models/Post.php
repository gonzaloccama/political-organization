<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'user_type',
        'in_group',
        'group_id',
        'group_approved',
        'in_event',
        'event_id',
        'event_approved',
        'post_type',
        'origin_id',
        'privacy',
        'text',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parent()
    {
        return $this->belongsTo(Post::class,'origin_id');
    }

    public function postsVideo()
    {
        return $this->hasOne(PostsVideo::class);
    }

    public function postsFile()
    {
        return $this->hasOne(PostsFile::class);
    }

    public function postsPhoto()
    {
        return $this->hasOne(PostsPhoto::class);
    }

    public function postsComment()
    {
        return $this->hasMany(PostsComment::class, 'node_id')->latest();
    }

    public function shared()
    {
        return $this->hasMany(Post::class, 'origin_id');
    }

    public function getNextId()
    {
        $statement = DB::select("show table status like 'posts'");
        return $statement[0]->Auto_increment;
    }
}
