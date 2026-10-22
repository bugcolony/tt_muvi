<?php

namespace App\Services\Owner;

use Illuminate\Support\Facades\Session;

class OwnerResolver
{
    public static function resolve(): string
    {
        return Session::id();
    }
}
