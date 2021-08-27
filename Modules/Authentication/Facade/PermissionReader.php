<?php

namespace Authentication\Facade;


use Illuminate\Support\Facades\Facade;
use Authentication\Annotations\PermissionReader as PermissionReaderService;

class PermissionReader extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PermissionReaderService::class;
    }
}
