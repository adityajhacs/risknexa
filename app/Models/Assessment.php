<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vendor;
use App\Models\Question;
use App\Models\AssessmentQuestion;
use App\Models\EvidenceUpload;
use App\Models\AssessmentResponse;
use App\Models\Framework;

class Assessment extends Model
{
    protected $fillable = [

        'vendor_id',
        'assessment_name',
        'due_date',
        'status',
        'risk_score',
        'risk_level',
          'questionnaire',
    'priority',
    'assigned_by',
    'reviewer',
    'review_status',
    'framework_id',
'description',
'created_by'

    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
    public function framework()
{
    return $this->belongsTo(Framework::class);
}

    public function questions()
    {
        return $this->belongsToMany(
            Question::class,
            'assessment_questions'
        );
    }

    public function assessmentQuestions()
    {
       return $this->hasMany(
        AssessmentQuestion::class
    );
    }
    public function evidenceUploads()
{
    return $this->hasMany(
        EvidenceUpload::class
    );
}
public function responses()
{
    return $this->hasMany(
        AssessmentResponse::class
    );
}
public function domains()
{
    return Domain::whereHas('questions', function ($query) {
        $query->whereHas('assessments', function ($assessment) {
            $assessment->where('assessment_id', $this->id);
        });
    });
}
}