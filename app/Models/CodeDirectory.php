<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class CodeDirectory extends Model
{
    use HasUuids;
    protected $fillable = [
        'code',
        'name',
        'table_name',
    ];

    public function workerType() {
        return $this->belongsTo(WorkerType::class, 'id', 'code_directory_id');
    }

    public function gender() {
        return $this->belongsTo(Gender::class, 'id', 'code_directory_id');
    }

    public function socialCategory() {
        return $this->belongsTo(SocialCategory::class, 'id', 'code_directory_id');
    }

    public function maritalStatus() {
        return $this->belongsTo(MaritalStatus::class, 'id', 'code_directory_id');
    }
}
