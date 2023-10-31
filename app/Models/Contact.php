<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'number',
        'sweepstake',
        'subject',
        'message',
    ];

    protected function number(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => '(' . substr($value, 0, 2) . ') ' . substr($value, 2, 1) . '' . substr($value, 3, 4) . '-' . substr($value, 7, 4),
            set: fn ($value) => str_replace(['(', ')', '-', ' ', '.'], '', $value)
        );
    }
}
