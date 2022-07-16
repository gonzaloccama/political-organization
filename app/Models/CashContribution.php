<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashContribution extends BaseModel
{
    use HasFactory;

    protected $table = 'cash_contributions';

    public function contributor()
    {
        return $this->belongsTo(Contributor::class, 'contributor_id');
    }
}
