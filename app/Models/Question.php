<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Assessment;

class Question extends Model
{
    protected $fillable = [

    'category_id',

    'domain_id',

    'control_code',

    'question',

    'description',

    'response_type',

    'requires_explanation',

    'evidence_mandatory',

    'risk_weight',

    'risk_level',

    'control_guidance',

    'display_order',

    'status',

];

    /**
     * Domain Relationship
     */
    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
    public function category()
{
    return $this->belongsTo(Category::class);
}

    /**
     * Assessment Relationship
     */
    public function assessments()
    {
        return $this->belongsToMany(
            Assessment::class,
            'assessment_questions'
        );
    }
}