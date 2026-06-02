<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vendor;

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
}