<?php

namespace App\Utils;

use Ramsey\Uuid\Uuid as RamseyUuid;

trait Uuid
{
    public static function boot()
    {
        parent::boot();
        static::creating(function ($obj) {
            $obj->uuid = RamseyUuid::uuid4();
        });
    }
}
