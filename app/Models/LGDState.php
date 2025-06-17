<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LGDState extends Model
{
    protected $fillable = [
        'l_g_d_code',
        'name_en',
        'name_local',
        'type',
    ];
}
