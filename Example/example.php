<?php
require_once dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . 'autoload.php';

use \sLog\sLog;

// настроить логгеры
sLog::addLogger(
    new \sLog\Loggers\File (
        array('file' => '/tmp/sLog.log'),
        \sLog\Level::DEBUG
    )
);

sLog::addLogger(
    new \sLog\Loggers\Syslog(array(),
        \sLog\Level::DEBUG
    )
);

sLog::addLogger(
    new \sLog\Loggers\Mail (
        array('email' => 'admin@yourdomen.com'),
        \sLog\Level::WARNING
    )
);


sLog::log('Debug message', \sLog\Level::DEBUG);
sLog::log(
    'Warning message',
    \sLog\Level::WARNING,
    array('script'=>'test.php', 'line' => 10) //кроме сообщения послать дополнительные данные
);

