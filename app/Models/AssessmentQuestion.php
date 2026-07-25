<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Assessment;
use App\Models\Question;

class AssessmentQuestion extends Model
{
    protected $fillable = [

    'assessment_id',

    'question_id',

    'response',

    'score',

    'reviewer_comment',

    'review_decision',

];
public function assessment()
{
    return $this->belongsTo(Assessment::class);
}

public function question()
{
    return $this->belongsTo(Question::class);
}
}
