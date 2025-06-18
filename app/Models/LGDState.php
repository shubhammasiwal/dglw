<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class LGDState extends Model
{
    use HasUuids;
    protected $fillable = [
        'l_g_d_code',
        'name_en',
        'name_local',
        'type',
    ];
}
