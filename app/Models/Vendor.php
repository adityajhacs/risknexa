<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
