<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\AssessmentQuestion;
class AssessmentResponseHistory extends Model
{
    protected $fillable = [

        'assessment_id',

        'question_id',

        'user_id',

        'type',

        'old_answer',

        'new_answer',

        'old_file',

        'new_file'

    ];

    
    public function user()
{
    return $this->belongsTo(
        User::class,
        'user_id'
    );
}
public function question()
{
   return $this->belongsTo(
    AssessmentQuestion::class,
    'question_id'
);
}
}
