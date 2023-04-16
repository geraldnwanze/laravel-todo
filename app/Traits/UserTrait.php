<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UserTrait
{
    public static function bootUserTrait()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}


