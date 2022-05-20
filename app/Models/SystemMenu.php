<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemMenu extends Model
{
    use HasFactory;

    protected $table = 'system_menus';

    public function children()
    {
        return $this->hasMany(SystemMenu::class, 'parent', 'id');
    }
}
