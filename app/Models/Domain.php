<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $fillable = [
        'framework_id',
        'category_id',
        'code',
        'name',
        'description',
        'display_order',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function framework()
{
    return $this->belongsTo(Framework::class);
}
}