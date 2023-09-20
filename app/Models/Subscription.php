<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_client_id',
        'hash',
        'status',
        'created_at',
        'paid_at',
        'expire_date',
        'device_os',
        'app_id',
    ];

    public $timestamps = false;
}
