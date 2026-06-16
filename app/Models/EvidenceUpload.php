<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Assessment;

class EvidenceUpload extends Model
{
    protected $fillable = [
        'assessment_id',
        'file_name',
        'file_path'
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }
}