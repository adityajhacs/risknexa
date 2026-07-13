<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Framework extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'version',
        'description',
        'status',
        'created_by',
    ];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}