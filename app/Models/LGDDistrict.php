<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class LGDDistrict extends Model
{
    use HasUuids;
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
