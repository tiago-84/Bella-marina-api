<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Quota extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'order_id',
    ];
}
