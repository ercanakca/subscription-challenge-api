<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationClient extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_uid',
        'app_id',
        'phone_number',
        'language',
        'device_os',
        'client_token',
        'start_date',
        'finish_date',
    ];

    public $timestamps = false;
}
