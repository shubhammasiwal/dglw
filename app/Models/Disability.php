<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disability extends Model
{
    protected $fillable = [
        'name',
        'code_directory_id'
    ];

    public function codeDirectory() {
        return $this->belongsTo(CodeDirectory::class);
    }
}
