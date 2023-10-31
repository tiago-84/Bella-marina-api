<?php

namespace App\Models;

use App\Models\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'type',
        'amount',
        'provider_id',
        'status',
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function scopeOrders(Builder $builder)
    {
        return $builder->where('type', 'deposit')->where('object_type', 'order');
    }

    public function scopeCaptured(Builder $builder)
    {
        return $builder->where('status', TransactionStatus::CAPTURED);
    }
    public function scopeWaiting(Builder $builder)
    {
        return $builder->where(
            function ($query) {
                return $query->where('status', TransactionStatus::CREATED)
                    ->orWhere('status', TransactionStatus::IN_ANALISYS);
            }
        );
    }

    public function object()
    {
        return $this->morphTo();
    }

    public function responsible()
    {
        return $this->morphTo();
    }

    public function resetQuotas()
    {
        $this->object->quotas()->each(function ($quota) {
            $quota->order_id = null;
            $quota->save();
        });
    }

    protected function amount(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100
        );
    }
}
