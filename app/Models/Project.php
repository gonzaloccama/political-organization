<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function projectDiscussion()
    {
        return $this->hasMany(ProjectDiscussion::class);
    }

    public function projectBug()
    {
        return $this->hasMany(ProjectBug::class);
    }

    public function projectNote()
    {
        return $this->hasMany(ProjectNote::class);
    }

    public function projectFile()
    {
        return $this->hasMany(ProjectFile::class);
    }

    public function priorityN()
    {
        return $this->belongsTo(Priority::class, 'priority');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'responsible');
    }
}
