<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application3rdPassword extends Model
{
    use HasFactory;

    protected $table = 'application_3rd_passwords';

    public $timestamps = false;

    protected $fillable = [
        'application_key',
        'username',
        'password',
        'api',
    ];
}
