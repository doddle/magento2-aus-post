<?php
declare(strict_types=1);

namespace AustraliaPost\Returns\Logger\Handler;

use Magento\Framework\Logger\Handler\Base as BaseHandler;
use Monolog\Logger as MonologLogger;

class AustraliaPost extends BaseHandler
{
    /** @var string */
    protected $fileName = '/var/log/australiapost_returns.log';
}
