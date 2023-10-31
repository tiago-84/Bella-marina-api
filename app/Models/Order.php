<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'sweepstake_id',
        'quantity',
        'unity_price',
        'participant_id',
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function participant()
    {
        return $this->belongsTo(User::class, 'participant_id');
    }

    public function sweepstake()
    {
        return $this->belongsTo(Sweepstake::class);
    }

    public function quotas()
    {
        return $this->hasMany(Quota::class);
    }
}
