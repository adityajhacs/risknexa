<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'framework_id',
        'code',
        'name',
        'description',
        'display_order',
        'status',
    ];

    /**
     * Framework Relationship
     */
    public function framework()
    {
        return $this->belongsTo(Framework::class);
    }

    /**
     * Questions Relationship
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}