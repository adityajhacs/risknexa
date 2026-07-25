<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\Assessment;
use App\Models\User;

class AssessmentResponse extends Model
{
   protected $fillable = [
    'assessment_id',
    'question_id',
    'answer',
    'evidence_file',
    'updated_by',
    'review_comment',
    'review_status',
    'implementation_status',

    'review_decision',
    'review_score',
    'reviewed_by',
    'reviewed_at',
];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }
    
public function answerUpdatedBy()
{
    return $this->belongsTo(User::class,'answer_updated_by');
}

public function evidenceUploadedBy()
{
    return $this->belongsTo(User::class,'evidence_uploaded_by');
}
}