<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insight extends Model
{
    use HasFactory;

    protected $fillables = [
        'device',
        'platform',
        'browser',
        'languages',
        'ip',
        'request',
        'useragent',
    ];
}
