<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodeDirectory extends Model
{
    protected $fillable = [
        'code',
        'name',
        'table_name',
    ];
}
