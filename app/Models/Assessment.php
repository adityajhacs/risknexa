<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vendor;
use App\Models\Question;
use App\Models\AssessmentQuestion;
use App\Models\EvidenceUpload;

class Assessment extends Model
{
    protected $fillable = [
        'vendor_id',
        'assessment_name',
        'due_date',
        'status',
        'risk_score',
        'risk_level'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
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
}