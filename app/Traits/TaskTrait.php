<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

trait TaskTrait
{
    public static function bootTaskTrait()
    {
        static::creating(function ($model) {
            $model->user_id = auth()->check() ? auth()->id() : 1;
            $model->uuid = Str::uuid();
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->diffForHumans()
        );
    }

    public function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->diffForHumans()
        );
    }

    public function title(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value)
        );
    }

    public function scopeToday($query)
    {
        return $query->where('date', today());
    }

    public function start(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('g:i A')
        );
    }

    public function end(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('g:i A')
        );
    }
}
