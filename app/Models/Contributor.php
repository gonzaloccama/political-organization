<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contributor extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cashContribution()
    {
        return $this->hasMany(CashContribution::class);
    }

    public function materialContribution()
    {
        return $this->hasMany(MaterialContribution::class);
    }
}
