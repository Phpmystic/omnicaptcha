<?php

namespace Phpmystic\OmniCaptcha\Facades;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;

/**
 * OmniCaptcha Facade
 *
 * @method static bool verify(string $token)
 * @method static bool verifyIlluminateRequest(Request $request)
 */
class OmniCaptcha extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Phpmystic\OmniCaptcha\OmniCaptcha::class;
    }
}
