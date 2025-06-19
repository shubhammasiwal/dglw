<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Worker extends Model
{
    use HasUuids;
    protected $fillable = [
        'worker_type_id',
        'uan_number',
        'eshram_id',
        'aadhar_photo',
        'aadhar_name',
        'gender_id',
        'aadhar_dob_yob',
        'aadhar_address',
        'hashed_aadhaar',
        'mobile_number',
        'alternate_mobile_number',
        'father_name',
        'husband_name',
        'social_category_id',
        'marital_status_id',
        'is_migrated',
        'is_disabled',
        'is_deseased',
        'date_of_death',
    ];
    
    public function gender() {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function socialCategory() {
        return $this->belongsTo(SocialCategory::class, 'social_category_id');
    }

    public function maritalStatus() {
        return $this->belongsTo(MaritalStatus::class, 'marital_status_id');
    }

    public function workerType() {
        return $this->belongsTo(WorkerType::class, 'worker_type_id');
    }
}
