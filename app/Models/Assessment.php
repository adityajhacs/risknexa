<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $fillable = [
        'vendor_id',
        'assessment_name',
        'due_date',
        'status'
    ];
    public function vendor()
{
    return $this->belongsTo(Vendor::class);
}
}