<?php

namespace Transbank\Patpass;

use Transbank\Utils\EnvironmentManager;
use Transbank\Utils\HttpClient;

class PatpassByWebpay extends EnvironmentManager
{
    const DEFAULT_API_KEY =  \Transbank\Webpay\Options::DEFAULT_API_KEY;
    const DEFAULT_COMMERCE_CODE = '597055555550';

    protected static $globalOptions = null;

    public static function configureForTesting()
    {
        self::configureForIntegration(static::DEFAULT_COMMERCE_CODE, static::DEFAULT_API_KEY);
    }
}
