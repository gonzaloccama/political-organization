<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BaseModel extends Model
{
    public function scopeSearch($query, $findIn, $keyWord, $table = null, $cols = null)
    {
        $concat = null;

        if ($cols) {
            $concat = $this->parseColumns($table, $cols);
        }

        $query->where(function ($query) use ($findIn, $keyWord, $concat) {
            foreach ($findIn as $in) {
                $query->orWhere($in, 'LIKE', '%' . $keyWord . '%');
            }
            $query->when($concat, function ($query) use ($keyWord, $concat) {
                $query->orWhere(DB::raw('CONCAT(' . $concat . ')'), 'LIKE', '%' . $keyWord . '%');
            });
        });
    }

    public function scopeConcatJoinId($query, $table, $cols, $as, $with, $onTable=null)
    {
        if (!$onTable){
            $onTable = $this->table;
        }

        $concat = $this->parseColumns($table, $cols);

        $query->join($table, $table . '.id', '=', $onTable . '.' . $with)
//            ->select($this->table . '.*')
            ->selectRaw('CONCAT(' . $concat . ') as ' . $as);
    }


    private function parseColumns($table, $cols): string
    {
        $concat = '';
        $i = 0;

        foreach ($cols as $col) {
            if ($i < count($cols) - 1) $concat .= $table . '.' . $col . '," ",';
            else $concat .= $table . '.' . $col;
            $i++;
        }

        return $concat;
    }
}
