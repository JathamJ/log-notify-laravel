<?php

namespace Jathamj\LogNotifyLaravel;

use Jathamj\LogNotify\Handler;
use Monolog\Processor\ProcessorInterface;

class NotifyProcessor implements ProcessorInterface
{
    protected $handler;

    public function __invoke(array $record)
    {
        $this->handler->do($record['level_name'], $record['message'], $record['context']);
        return $record;
    }

    public function __construct($config)
    {
        $this->handler = new Handler($config);
    }

}