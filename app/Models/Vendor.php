<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Assessment;
use App\Models\User;

class Vendor extends Model
{
    protected $fillable = [
    'vendor_name',
    'website',
    'contact_person',
    'email',
    'phone',
    'country',
    'criticality',
    'status'
];
public function assessments()
{
    return $this->hasMany(Assessment::class);
}
public function users()
{
    return $this->hasMany(User::class);
}
}
