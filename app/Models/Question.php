<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}