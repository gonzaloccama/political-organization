<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanMention extends BaseModel
{
    use HasFactory;

    public function evaluation()
    {
        return $this->hasOne(Evaluation::class);
    }
}
