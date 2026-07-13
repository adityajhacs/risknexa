<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Assessment;
class Question extends Model
{
     protected $fillable = [
        'category_id',
        'question',
        'risk_weight',
        'status',
        'control_code',
'framework_reference',
'response_type',
'requires_explanation',
'evidence_mandatory',
'risk_level',
'control_guidance',
    ];
    public function category(){
    return $this->belongsTo(category::class);
}
public function assessments()
{
    return $this->belongsToMany(
        Assessment::class,
        'assessment_questions'
    );
}
public function domain()
{
    return $this->belongsTo(Domain::class);
}
}