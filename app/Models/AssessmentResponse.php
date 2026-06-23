<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\Assessment;

class AssessmentResponse extends Model
{
    protected $fillable = [
        'assessment_id',
        'question_id',
        'answer',
        'evidence_file'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }
}