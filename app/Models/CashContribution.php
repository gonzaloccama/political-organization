<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashContribution extends Model
{
    use HasFactory;

    public function contributor()
    {
        return $this->belongsTo(Contributor::class, 'contributor_id');
    }
}
