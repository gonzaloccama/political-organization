<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialContribution extends Model
{
    use HasFactory;

    public function unitM()
    {
        return $this->belongsTo(Unit::class, 'unit');
    }

    public function contributor()
    {
        return $this->belongsTo(Contributor::class, 'contributor_id');
    }
}
