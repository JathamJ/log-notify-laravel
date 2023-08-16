<?php

namespace Jathamj\LogNotifyLaravel;

use Illuminate\Log\Logger;

class NotifyFormatter
{
    /**
     * 自定义给定的日志实例
     *
     * @param Logger $logger
     *
     * @return void
     */
    public function __invoke(Logger $logger)
    {
        $notifyCfg = config('logging_notify');
        foreach ($logger->getHandlers() as $handler) {
            $handler->pushProcessor(new NotifyProcessor($notifyCfg));
        }
    }

}