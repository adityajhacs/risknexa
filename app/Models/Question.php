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
        'status'
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
}