<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LGDDistrict extends Model
{
    protected $fillable = [
        'state_code',
        'state_name',
        'district_lgd_code',
        'district_name_en',
        'district_name_local',
        'hierarchy',
        'district_short_name',
    ];

    public function state()
    {
        return $this->belongsTo(LGDState::class, 'state_code', 'l_g_d_code');
    }
}
